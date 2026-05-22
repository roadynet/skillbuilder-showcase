# SkillBuilder Case Study

## Overview

SkillBuilder is a private Symfony learning platform built to manage structured course content, adaptive practice, user progress, and admin workflows.

The project was developed as a working Symfony application rather than a static demo. It includes authentication, authorization, content workflows, learning logic, statistics, GDPR-oriented data export, deployment, automated tests, and a real Shopware Admin API synchronization workflow.

## Problem

Learning content and questions are difficult to manage when they live in disconnected files, manual lists, or static pages. Learners need guidance on what to do next, while admins need safe tools to edit content and review progress.

The product needed to answer these questions:

- Which lessons can a user access?
- Which question should be repeated next?
- How stable is the user's knowledge?
- Can admins edit questions without losing context?
- Can users export their personal data safely?
- Can the system be operated and tested reliably?
- Can published learning content be synchronized into a commerce storefront without manual product maintenance?

## Solution

SkillBuilder connects lessons, questions, progress, learning settings, and admin workflows in one Symfony application.

Main capabilities:

- structured lessons with section-aware navigation
- adaptive question scheduling
- mistake-review flow
- personal learning settings
- progress and learning statistics
- admin question editing
- Shopware Admin API bridge for synchronizing published lessons into Shopware products
- user and role management
- GDPR data export request/download flow
- automated service-level tests

## My Role

I worked across product, backend, UI, testing, security, and deployment:

- designed and refined user/admin workflows
- implemented Symfony controllers, services, entities, and templates
- improved role and permission boundaries
- removed legacy chapter-limit behavior
- polished dashboard, statistics, and settings UI
- added PHPUnit coverage for core learning rules
- fixed Doctrine mapping validation issues
- deployed and smoke-tested the production instance

## Current Practice Since 2023

SkillBuilder documents ongoing hands-on PHP/Symfony work after the IHK qualification: backend implementation, Doctrine data modeling, Twig UI work, deployment, debugging, testing, and API integration. The project is used as portfolio evidence for current backend development practice rather than as a static learning exercise.

## Technical Highlights

- Symfony 8 application with service-layer domain logic
- Doctrine ORM entities and migrations
- adaptive learning scheduler with stages, streaks, and due dates
- Twig UI with reusable design patterns
- role-aware admin/user navigation
- secure GDPR export context
- API-based Shopware integration that maps published lessons to products
- explicit Shopware mapping: lessons become products, chapters stay inside SkillBuilder and are not synchronized as categories
- product activation/deactivation based on SkillBuilder publication status
- migration hygiene checks
- PHPUnit tests and Symfony lint checks

## Quality Results

```text
14 PHPUnit tests
650 assertions
PHP lint: 180 files
Twig lint: 38 templates
YAML lint: 18 config files
Doctrine mapping: OK
Container lint: OK
Live smoke checks: OK
```

## Lessons Learned

- A learning platform needs explanation, not only numbers.
- Admin interfaces must show risk and context when editing content with existing progress.
- Legacy access rules can quietly distort statistics and should be removed decisively.
- Service-level tests are the fastest way to protect learning logic.
- Production readiness includes deployment, permissions, privacy, and operational checks.
- A portfolio demo becomes much stronger when internal admin workflows create visible output in a second real system.
- Integration work is easier to explain when a recruiter can see the admin button, the API mapping, and the generated storefront result.
