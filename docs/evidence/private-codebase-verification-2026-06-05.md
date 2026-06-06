# Private Codebase Verification Notes - 2026-06-05

## Scope

These notes summarize local verification performed against the private SkillBuilder codebase during the PHPStan audit cleanup.

The private repository itself is not published in this showcase.

## Syntax Check

Changed PHP files were checked with PHP syntax validation.

Recorded outcome:

```text
No syntax errors detected
```

## PHPStan Targeted Checks

PHPStan was run without the broad baseline against the command, controller, and service files that were changed during the cleanup.

Recorded outcome:

```text
Command files:    OK
Controller files: OK
Service files:    OK
```

Entity checks were run with the reduced baseline:

```text
[OK] No errors
```

## Private PHPUnit Evidence

The private codebase test evidence recorded for the showcase remains:

```text
PHPUnit 12.5.4
Runtime: PHP 8.4.21

14 tests
650 assertions
OK
```

The public showcase examples remain:

```text
4 tests
7 assertions
OK
```

## Environment Note

The local Windows/P-drive environment required a PHPStan wrapper script that copies the PHPStan PHAR to `%TEMP%` before execution. This avoids local PHAR execution hangs from the network-mounted project path.

The private repository also includes a `Testing` GitHub Actions workflow for running PHPStan in CI.

## Limitation

A full private-codebase PHPStan run in the local Windows/P-drive environment was not used as the primary evidence because the environment can hang on long PHPStan runs. The audit therefore records targeted baseline-free checks plus an entity check with the reduced baseline.

This limitation is documented so the evidence stays honest and repeatable.
