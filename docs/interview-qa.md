# Interview Q&A

## What is SkillBuilder?

SkillBuilder is a Symfony-based learning platform with lessons, questions, user progress, learning settings, admin workflows, GDPR-oriented export features, deployment evidence, and test coverage.

## What did you build yourself?

I built the practical SkillBuilder system and maintain it as my main PHP/Symfony portfolio project. My work covers controllers, services, Doctrine models, Twig templates, admin workflows, tests, deployment, debugging, documentation, and the Shopware integration workflow.

## Is the Shopware integration real?

Yes. SkillBuilder contains an admin workflow that synchronizes published lessons to Shopware through the Shopware Admin API. The public repository does not contain credentials or private application source code, but the integration is documented with a sanitized code example and a connected live demo.

## What exactly is synchronized to Shopware?

Published SkillBuilder lessons are synchronized as Shopware products.

Chapters are not synchronized as Shopware categories. Chapters stay internal learning-structure data inside SkillBuilder.

## How is duplicate creation avoided?

The integration uses stable product numbers based on SkillBuilder lesson IDs, for example a `SB-COURSE-*` pattern. Re-running the import updates existing products instead of creating duplicates.

## What happens to unpublished lessons?

Lessons that are no longer published should not remain visible as active shop products. The integration deactivates products that no longer belong to the current published lesson set.

## Why is this relevant for a PHP/Symfony role?

It demonstrates practical backend work: service design, data modeling, authentication and role checks, status-driven workflows, integration with an external API, safe handling of environment-specific configuration, deployment, and documentation.

## What should a senior Symfony reviewer inspect first?

Start with the [Senior Symfony review guide](senior-symfony-review.md), then read the architecture page, code walkthrough, quality report, and service examples. The key signal is not that private production code is public. It is that the system has clear boundaries, repeatable checks, operational evidence, and examples of business rules that are testable outside HTTP controllers.

## How are controller and service responsibilities separated?

Controllers are treated as HTTP adapters: routing, form handling, CSRF, redirects, access checks, and response rendering. Scheduling, due-question selection, import decisions, export ownership, and external sync policy belong in services so they can be tested and debugged independently.

## What are the most important trade-offs?

The public showcase trades full source visibility for privacy and safety. To compensate, it includes representative service examples, tests, architecture notes, live-readiness evidence, and a public audit script that guards against accidentally publishing secrets or private application paths.

## Why is this relevant for a Shopware role?

It shows hands-on work with Shopware concepts and the Shopware Admin API: product synchronization, product visibility, category assignment, API authentication, and a demo storefront that makes the result visible.

## What is intentionally not public?

The public showcase does not contain production source code, real user data, credentials, `.env` files, private deployment scripts, or business-specific implementation details.

## What would you improve next?

- automated CI checks for the public examples
- deeper sync-log detail per product
- stronger product metadata mapping
- dedicated end-to-end tests for login and learning flows
- more reporting filters in the admin area
- more voter-level authorization examples
- async retry handling for longer-running imports or external API sync
