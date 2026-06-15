#!/usr/bin/env python3
"""Public live smoke check for the SkillBuilder demo surface."""

from __future__ import annotations

import sys
import urllib.error
import urllib.request


BASE_URL = "https://sb.mcmonaco.de"
PATHS = ("/health", "/login", "/register", "/impressum", "/dsgvo")
TIMEOUT_SECONDS = 15


def fetch(path: str) -> tuple[int, int, bool, bool, bool]:
    request = urllib.request.Request(
        BASE_URL + path,
        headers={"Cache-Control": "no-cache", "User-Agent": "SkillBuilder-showcase-smoke/1.0"},
        method="GET",
    )
    with urllib.request.urlopen(request, timeout=TIMEOUT_SECONDS) as response:
        body = response.read()
        headers = response.headers
        return (
            response.status,
            len(body),
            bool(headers.get("Content-Security-Policy")),
            headers.get("X-Content-Type-Options", "").lower() == "nosniff",
            headers.get("X-Frame-Options", "").upper() == "DENY",
        )


def main() -> None:
    failures: list[str] = []

    print("path,status,bytes,csp,nosniff,frame")
    for path in PATHS:
        try:
            status, size, has_csp, has_nosniff, has_frame = fetch(path)
        except urllib.error.HTTPError as exc:
            print(f"{path},{exc.code},0,false,false,false")
            failures.append(path)
            continue
        except Exception as exc:
            print(f"{path},0,0,false,false,false ({exc})")
            failures.append(path)
            continue

        print(f"{path},{status},{size},{has_csp},{has_nosniff},{has_frame}")
        if status < 200 or status >= 400 or not has_csp or not has_nosniff or not has_frame:
            failures.append(path)

    if failures:
        print("Public smoke check failed for: " + ", ".join(failures))
        sys.exit(1)


if __name__ == "__main__":
    main()
