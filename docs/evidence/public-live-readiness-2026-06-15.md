# Public Live Readiness Evidence - 2026-06-15

## Scope

This note records portfolio-safe checks performed for the public SkillBuilder showcase and the public surface of the live demo.

The private application source code, credentials, database configuration, and user data are not included in this repository.

## Public Showcase Checks

Repository target:

```text
roadynet/skillbuilder-showcase
```

Local checks performed:

```text
PHP syntax check for examples and tests: OK
PHPUnit 11.5.55 on PHP 8.4.21: OK, 7 tests, 10 assertions
Local Markdown links: OK
Public wording consistency: OK
Environment file policy: OK
Obvious secret patterns: OK
Screenshot existence and PNG signatures: OK
phpunit.xml XML parsing: OK
```

The showcase now includes `tests/showcase_audit.py`, which keeps these public-safety checks repeatable in GitHub Actions.

## Live Demo Public Smoke Check

Public routes checked without publishing credentials:

| Route | Result | Security headers |
| --- | --- | --- |
| `/health` | 200 | CSP and nosniff present |
| `/login` | 200 | CSP and nosniff present |
| `/register` | 200 | CSP and nosniff present |
| `/impressum` | 200 | CSP and nosniff present |
| `/dsgvo` | 200 | CSP and nosniff present |

The canonical public privacy route for this project is `/dsgvo`.

## Notes

- Demo credentials remain unpublished.
- `.env.example` contains placeholders only.
- The public showcase intentionally excludes private Symfony source directories such as `src/`, `config/`, `templates/`, `migrations/`, `var/`, and private config files.
- The live application has additional protected-route checks, but those are summarized only at a high level in public documentation.
