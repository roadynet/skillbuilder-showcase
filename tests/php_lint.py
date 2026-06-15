#!/usr/bin/env python3
"""Run PHP syntax checks for all public example/test PHP files."""

from __future__ import annotations

import subprocess
import sys
from pathlib import Path


ROOT = Path(__file__).resolve().parents[1]
SCAN_DIRS = ("examples", "tests")


def main() -> None:
    files = sorted(
        path
        for directory in SCAN_DIRS
        for path in (ROOT / directory).rglob("*.php")
    )

    if not files:
        print("No PHP files found")
        return

    failures = []

    for path in files:
        result = subprocess.run(
            ["php", "-l", str(path)],
            cwd=ROOT,
            text=True,
            stdout=subprocess.PIPE,
            stderr=subprocess.STDOUT,
            check=False,
        )
        print(result.stdout.strip())
        if result.returncode != 0:
            failures.append(path.relative_to(ROOT).as_posix())

    if failures:
        print("PHP syntax check failed for:")
        print("\n".join(failures))
        sys.exit(1)


if __name__ == "__main__":
    main()
