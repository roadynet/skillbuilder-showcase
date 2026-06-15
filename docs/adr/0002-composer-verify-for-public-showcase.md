# ADR 0002: Use Composer Verify For Public Showcase Checks

## Status

Accepted

## Context

The showcase has several independent checks:

- PHP syntax checks
- PHPUnit example tests
- PHPStan static analysis
- public safety audit
- optional live smoke checks

Running these as separate ad hoc commands is easy for the maintainer but less helpful for reviewers.

## Decision

Add a minimal `composer.json` with development-only tools and a single repeatable verification command:

```bash
composer verify
```

`composer verify` runs:

- `composer lint:php`
- `composer analyse`
- `composer test`
- `composer audit:showcase`

The live public smoke check stays separate:

```bash
composer smoke:public
```

## Consequences

GitHub Actions and local reviewers use the same entrypoint.

The repository now includes a lock file so the public quality toolchain is reproducible.

Live route checks are not part of required CI because they depend on external network and production availability.
