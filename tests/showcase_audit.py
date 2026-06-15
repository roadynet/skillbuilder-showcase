#!/usr/bin/env python3
"""Portfolio-safety checks for the public SkillBuilder showcase."""

from __future__ import annotations

import re
import subprocess
import sys
import xml.etree.ElementTree as ET
from pathlib import Path
from urllib.parse import unquote


ROOT = Path(__file__).resolve().parents[1]
TEXT_SUFFIXES = {".md", ".php", ".svg", ".txt", ".yml", ".yaml", ".xml"}
ALLOWED_ENV_FILES = {Path(".env.example")}
IGNORED_SCAN_DIRS = {".git", "vendor", ".phpunit.cache"}


def fail(message: str) -> None:
    print(message)
    sys.exit(1)


def tracked_files(*patterns: str) -> list[Path]:
    cmd = ["git", "ls-files", *patterns]
    output = subprocess.check_output(cmd, cwd=ROOT, text=True)
    return [Path(line) for line in output.splitlines() if line.strip()]


def read_text(path: Path) -> str:
    return (ROOT / path).read_text(encoding="utf-8", errors="ignore")


def check_no_private_project_files() -> None:
    forbidden_roots = {
        "config",
        "migrations",
        "private-config",
        "src",
        "templates",
        "var",
    }
    failures: list[str] = []

    for path in tracked_files():
        normalized = path.as_posix()
        first_part = path.parts[0] if path.parts else ""
        if first_part in forbidden_roots or normalized.startswith("public/uploads/"):
            failures.append(f"{path}: private application path must not be tracked")

    if failures:
        fail("\n".join(failures))

    print("OK private application paths are not tracked")


def check_env_file_policy() -> None:
    failures: list[str] = []

    for path in tracked_files():
        if path.name.startswith(".env") and path not in ALLOWED_ENV_FILES:
            failures.append(f"{path}: only .env.example is allowed")

    for path in ROOT.rglob(".env*"):
        relative = path.relative_to(ROOT)
        if any(part in IGNORED_SCAN_DIRS for part in relative.parts):
            continue
        if relative not in ALLOWED_ENV_FILES:
            failures.append(f"{relative}: real env files must stay outside the showcase")

    if failures:
        fail("\n".join(failures))

    print("OK environment file policy")


def check_secret_patterns() -> None:
    patterns = [
        re.compile(r"github_pat_[A-Za-z0-9_]+"),
        re.compile(r"gh[pousr]_[A-Za-z0-9_]{20,}"),
        re.compile(r"sk-[A-Za-z0-9]{20,}"),
        re.compile(r"-----BEGIN (?:RSA |EC |OPENSSH |DSA )?PRIVATE KEY-----"),
        re.compile(r"gpt@sb\.local", re.IGNORECASE),
        re.compile(r"sb\.local", re.IGNORECASE),
    ]
    failures: list[str] = []

    for path in tracked_files():
        if path.suffix.lower() not in TEXT_SUFFIXES and path.name != ".env.example":
            continue
        text = read_text(path)
        for pattern in patterns:
            if pattern.search(text):
                failures.append(f"{path}: possible private credential or key pattern")

    if failures:
        fail("\n".join(failures))

    print("OK obvious secret patterns")


def check_placeholder_env() -> None:
    text = (ROOT / ".env.example").read_text(encoding="utf-8")
    required_placeholders = [
        "APP_SECRET=change-me-in-server-environment",
        "DATABASE_URL=mysql://db_user:db_password@localhost:3306/db_name",
        "SHOPWARE_ADMIN_BASE_URL=https://example-shop.test",
        "SHOPWARE_ADMIN_USERNAME=your-admin-user",
        "SHOPWARE_ADMIN_PASSWORD=your-admin-password",
    ]
    missing = [line for line in required_placeholders if line not in text]

    if missing:
        fail(".env.example is missing expected placeholder values:\n" + "\n".join(missing))

    print("OK env placeholders are explicit examples")


def check_markdown_links_and_images() -> None:
    pattern = re.compile(r"(?P<image>!)?\[[^\]]*]\(([^)]+)\)")
    failures: list[str] = []

    for path in tracked_files("*.md"):
        text = read_text(path)
        for match in pattern.finditer(text):
            target = match.group(2).strip()
            if not target or target.startswith(("http://", "https://", "mailto:", "#")):
                continue

            clean = unquote(target.split("#", 1)[0])
            if not clean:
                continue

            resolved = (ROOT / path.parent / clean).resolve()
            try:
                resolved.relative_to(ROOT)
            except ValueError:
                failures.append(f"{path}: local link escapes repository: {target}")
                continue

            if not resolved.exists():
                failures.append(f"{path}: missing local link target {target}")
                continue

            if match.group("image") and resolved.suffix.lower() == ".png":
                data = resolved.read_bytes()
                if len(data) < 1024:
                    failures.append(f"{path}: screenshot {target} is unexpectedly small")
                if not data.startswith(b"\x89PNG\r\n\x1a\n"):
                    failures.append(f"{path}: screenshot {target} is not a PNG")

    if failures:
        fail("\n".join(failures))

    print("OK local markdown links and screenshots")


def check_public_wording() -> None:
    forbidden = [
        "Kapitel als " + "Kategorien",
        "Kategorien " + "exportieren",
        "Kapitel werden " + "Kategorien",
        "chapters become " + "categories",
        "Lessons als Produkte, " + "Kapitel",
        "/datenschutz",
    ]
    failures: list[str] = []

    for path in tracked_files("*.md", "*.php", "*.svg", "*.txt", "*.yml", "*.yaml"):
        text = read_text(path).lower()
        for phrase in forbidden:
            if phrase.lower() in text:
                failures.append(f"{path}: outdated or non-canonical public wording found")

    if failures:
        fail("\n".join(failures))

    print("OK public wording consistency")


def check_phpunit_config() -> None:
    ET.parse(ROOT / "phpunit.xml")
    print("OK phpunit.xml is valid XML")


def main() -> None:
    check_no_private_project_files()
    check_env_file_policy()
    check_secret_patterns()
    check_placeholder_env()
    check_markdown_links_and_images()
    check_public_wording()
    check_phpunit_config()


if __name__ == "__main__":
    main()
