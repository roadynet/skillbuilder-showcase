# PHPStan Baseline Reduction Evidence - 2026-06-05

## Summary

The private SkillBuilder PHPStan baseline was reduced from 56 entries to 17 entries.

```text
Before cleanup: 56 baseline entries
After cleanup:  17 baseline entries
```

## Remaining Entries

All remaining entries are Doctrine generated ID warnings:

```text
Property App\Entity\...\$id (int|null) is never assigned int
```

The remaining count was checked with:

```powershell
(Select-String -Path phpstan-baseline.neon -Pattern 'identifier: property\.unusedType').Count
```

Recorded result:

```text
17
```

## Why These Remain

Doctrine assigns `#[GeneratedValue]` IDs at runtime after persistence. Removing `?int` from entity IDs would weaken the domain model before persistence and would not be the right fix.

The correct next step is Doctrine-aware PHPStan support, so PHPStan can understand generated IDs instead of treating them as ordinary never-assigned properties.

## Fixed Finding Types

The reduction removed findings in these categories:

- invalid or missing imports
- unreachable controller branches
- redundant `method_exists()` compatibility guards
- redundant null-coalescing expressions
- overly broad Symfony user type checks
- direct session flash bag access where controller flash helpers are clearer
- unused constructor dependency in GDPR export logic
- redundant lifecycle fallback for an already initialized Doctrine timestamp

## Audit Position

The current baseline is intentionally narrow. It does not hide broad application risk; it documents one known static-analysis limitation around Doctrine generated IDs.
