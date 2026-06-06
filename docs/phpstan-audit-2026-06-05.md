# PHPStan Audit - 2026-06-05

This audit documents the current static-analysis setup and cleanup state from the private SkillBuilder application.

## Scope

- Added PHPStan as a private-codebase audit tool.
- Added a GitHub Actions workflow named `Testing` for the private application branch.
- Reduced the PHPStan baseline from 56 findings to 17 findings.
- Kept the remaining 17 baseline entries limited to Doctrine generated ID properties.

## Implemented In Private Codebase

Private audit commit:

```text
b5fd3f2 Add PHPStan audit workflow
```

Main files added or changed in the private application:

- `composer.json`
- `composer.lock`
- `phpstan.neon`
- `phpstan-baseline.neon`
- `scripts/run-phpstan.ps1`
- `.github/workflows/testing.yml`
- targeted PHPStan cleanups in commands, controllers, services, tests, and one Doctrine entity callback

## Findings Reduced

Before cleanup:

```text
56 PHPStan baseline entries
```

After cleanup:

```text
17 PHPStan baseline entries
```

The removed findings covered:

- invalid or missing imports
- unreachable code
- redundant `method_exists()` guards
- redundant null-coalescing expressions
- overly broad user type checks
- direct session flash bag calls where controller flash helpers are clearer
- unused constructor dependency in GDPR export logic
- redundant lifecycle fallback for an initialized Doctrine timestamp

## Remaining Baseline

The remaining 17 entries are all Doctrine generated ID warnings of this form:

```text
Property App\Entity\...\$id (int|null) is never assigned int
```

These are intentionally kept because Doctrine assigns `#[GeneratedValue]` IDs at runtime. They should be removed later with a Doctrine-aware PHPStan setup, not by weakening entity ID types.

## Verification

Checks performed locally:

```text
php -l across changed PHP files: OK
PHPStan on changed command/controller/service files without baseline: OK
PHPStan on src/Entity with reduced baseline: OK
```

Supporting evidence:

- [PHPStan baseline reduction evidence](evidence/phpstan-baseline-reduction-2026-06-05.md)
- [Private codebase verification notes](evidence/private-codebase-verification-2026-06-05.md)

The full private-codebase PHPStan run is wired through the `Testing` workflow. The local Windows/P-drive environment required a PowerShell wrapper that copies the PHPStan PHAR to `%TEMP%` before execution.

## Current Quality Impact

This audit turns PHPStan from a one-off scan into repeatable project evidence:

- static analysis is now part of the private repository setup
- real PHPStan findings were fixed rather than hidden
- the baseline is narrow and explainable
- the remaining debt has a clear next step: add Doctrine-aware PHPStan support
