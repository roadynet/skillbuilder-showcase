# Senior Symfony Review Guide

This guide is written for experienced Symfony reviewers who want to evaluate the engineering shape behind SkillBuilder without access to the private production repository.

The public showcase is intentionally evidence-oriented: it does not publish private source code, credentials, deployment scripts, user data, or database configuration.

## Fast Review Path

Start here:

1. [Architecture overview](architecture.md)
2. [Code walkthrough](code-walkthrough.md)
3. [Quality report](quality-report.md)
4. [Shopware bridge](shopware-bridge.md)
5. [Public live readiness evidence](evidence/public-live-readiness-2026-06-15.md)
6. Representative examples in [`examples/`](../examples/)

The fastest technical read is the combination of the architecture page, the service examples, and the PHPUnit tests.

## What A Senior Reviewer Should Look For

SkillBuilder is positioned as a backend-driven Symfony business application, not as a frontend mockup. The relevant review questions are:

- Are HTTP concerns kept out of domain policy?
- Are learning rules testable without a browser or database?
- Are admin-only workflows explicit and protected?
- Are external API credentials kept server-side?
- Is synchronization idempotent instead of click-and-duplicate?
- Are privacy workflows treated as sensitive operational paths?
- Is public portfolio evidence separated from private implementation details?

## Architecture Decisions

| Decision | Reason | Evidence |
| --- | --- | --- |
| Controllers stay thin | Keeps routing, request parsing, CSRF, redirects, and forms separate from learning policy | [Architecture overview](architecture.md), [Code walkthrough](code-walkthrough.md) |
| Learning rules live in services | Scheduling, question selection, and section parsing are easier to test and review when not mixed into controllers | [`LearningSchedulerExample.php`](../examples/learning-scheduler/LearningSchedulerExample.php), [`NextDueQuestionServiceExample.php`](../examples/question-selection/NextDueQuestionServiceExample.php) |
| Doctrine is the persistence boundary | Entities represent learning state and relations; service logic decides transitions | [Case study](case-study.md), [Quality report](quality-report.md) |
| Shopware sync is admin-triggered and idempotent | Repeated imports should update existing products and deactivate obsolete ones, not create duplicates | [Shopware bridge](shopware-bridge.md) |
| Secrets stay outside Git | Public showcase has placeholders only; production values live in environment or private config outside the repo tree | [README](../README.md), [.env.example](../.env.example) |
| Public repository has its own safety audit | The showcase should prove it is safe to publish, not merely claim it | [`tests/showcase_audit.py`](../tests/showcase_audit.py) |
| Static analysis is part of the public proof | PHPStan runs at `level: max` for the representative PHP examples without requiring private code | [`phpstan.neon`](../phpstan.neon), [Quality report](quality-report.md) |

## Symfony-Specific Signals

The private application work represented here includes:

- Symfony controllers for user, lesson, admin, legal, GDPR, and integration routes
- Symfony Security with role-based access and explicit admin-only workflows
- Symfony Forms and validation for account, registration, learning settings, lessons, KDP/export-style configuration, and data requests
- Twig templates for learner and admin workflows
- Doctrine ORM entities, repositories, mapping validation, and migration hygiene
- service-layer business rules for learning progress, due-question selection, imports, statistics, exports, and external API synchronization
- PHPUnit tests for core learning behavior
- PHPStan for public example static analysis
- production smoke checks for public and authenticated routes

The public examples are reduced, but they mirror the shape of the real implementation: small services with deterministic inputs, explicit state transitions, and tests around business rules.

## Operational Reality

The project also documents non-glamorous production concerns:

- shared-hosting deployment constraints
- MariaDB/Doctrine mapping verification
- live smoke checks after cache and configuration changes
- external secrets file pattern for server-only credentials
- public/private repository split
- evidence notes for checks that are safe to publish

This matters because many Symfony failures are operational rather than syntactic: stale containers, miswired services, environment drift, wrong cache state, or credentials leaking into the wrong layer.

## Honest Boundaries

This public repository is not a complete code review substitute. It deliberately omits:

- production Symfony source code
- database schema and migrations
- credentials and `.env` files
- private deployment scripts
- user data and export payloads
- full admin implementation details

The value of the showcase is therefore not "read every private line of code". It is: inspect the architecture story, verify the public examples, review the repeatable checks, and use the live walkthrough to discuss the real system.

## Senior Discussion Prompts

Good interview questions for this project:

- How would you move more learning rules from ad hoc controller flows into services?
- Where would transaction boundaries belong in the Shopware synchronization?
- Which routes should require voters instead of simple role checks?
- How would you model retries and partial failure for external API sync?
- Which Doctrine relations should be lazy, eager, or projected into DTOs for admin statistics?
- How would you add browser-level regression tests without leaking demo credentials?
- How would you tighten CSP once inline scripts are fully removed?
- What should become asynchronous if lesson imports or Shopware sync grow?

These are intentionally senior-level questions. They make the showcase a starting point for a technical conversation rather than a static brochure.
