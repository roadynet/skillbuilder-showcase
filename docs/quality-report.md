# Quality Report

## Automated Tests

Public showcase examples:

```text
vendor/bin/phpunit

7 tests
15 assertions
OK
```

The public tests cover representative examples for learning scheduling, learning profile scoring, and section-code parsing.

Public static analysis:

```text
vendor/bin/phpstan analyse --memory-limit=1G

PHPStan Level 3
OK
```

Current private test suite:

```text
PHPUnit 12.5.4
Runtime: PHP 8.4.21

14 tests
650 assertions
OK
```

## Test Coverage Areas

### Section Code Parsing

Tests verify that section codes are extracted consistently from imported filenames.

Examples:

- `1_2_10_3_7.csv` becomes `1.2.10.3.7`
- invalid names return `null`

### Learning Scheduler

Tests verify core learning behavior:

- wrong answers in short-term mode become immediately due
- strict mode resets a question to stage 1
- correct long-term streaks promote stages
- wrong long-term answers step back and schedule a short review

### Learning Profile

Tests verify the public version of the new profile flow:

- dominant learning types are detected
- close scores fall back to `mixed`
- speed and repetition results influence recommendation flags

### Migration Hygiene

Tests verify:

- migration classes match their filenames
- legacy chapter-limit terms do not return to runtime code

## Manual / Tool Checks

Performed checks:

- Composer validation
- PHPStan Level 3 for public examples
- PHP syntax check across 180 files
- Twig lint across 38 templates
- YAML lint across 18 config files
- Symfony router check
- Symfony container lint
- Doctrine mapping validation
- live smoke checks against production routes

Detailed evidence:

- [Evidence index](evidence/README.md)
- [PHPStan baseline reduction evidence](evidence/phpstan-baseline-reduction-2026-06-05.md)
- [Private codebase verification notes](evidence/private-codebase-verification-2026-06-05.md)

## Important Finding Fixed

Doctrine validation found an inconsistent mapping between the lesson owner relation and the user lessons collection. The relationship was corrected by adding the inverse side to the owner relation.
