# Security And Privacy Boundary

This public repository is designed to be safe to share with recruiters, clients, and technical reviewers.

## Public Repository Rules

The showcase must not contain:

- production credentials
- real `.env` files
- real database URLs
- private Symfony source directories
- private deployment scripts
- user data
- generated GDPR exports
- upload directories
- Shopware Admin API credentials

The repository may contain:

- placeholder configuration
- sanitized architecture documentation
- representative example code
- screenshots without private user data
- public quality evidence
- public smoke-check results

## Automated Guards

`composer verify` runs the public safety audit:

```bash
python tests/showcase_audit.py
```

The audit checks:

- private application paths are not tracked
- only `.env.example` is allowed
- obvious secret patterns are absent
- `.env.example` uses placeholders
- local Markdown links resolve
- screenshots exist and are PNG files
- public wording stays consistent
- `phpunit.xml` parses as XML

## Live Demo Boundary

The public live demo URL can be shown, but demo credentials are not published in this repository.

The public smoke script checks only unauthenticated routes:

```bash
composer smoke:public
```

Protected route checks and admin walkthroughs should remain private or be demonstrated live without publishing credentials.

## Shopware Boundary

Shopware Admin API credentials are server-side only.

The connected Shopware storefront is a portfolio demo. It does not process real orders, payments, registrations, contact forms, or customer data.
