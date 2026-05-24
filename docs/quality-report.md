# Quality Report

## Automated Tests

Public showcase examples:

```text
phpunit

4 tests
7 assertions
OK
```

The public tests cover representative examples for learning scheduling and section-code parsing.

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

### Migration Hygiene

Tests verify:

- migration classes match their filenames
- legacy chapter-limit terms do not return to runtime code

## Manual / Tool Checks

Performed checks:

- Composer validation
- PHP syntax check across 180 files
- Twig lint across 38 templates
- YAML lint across 18 config files
- Symfony router check
- Symfony container lint
- Doctrine mapping validation
- live smoke checks against production routes

## Important Finding Fixed

Doctrine validation found an inconsistent mapping between the lesson owner relation and the user lessons collection. The relationship was corrected by adding the inverse side to the owner relation.
