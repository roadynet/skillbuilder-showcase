# Project Summary for Recruiters

## One-Sentence Summary

SkillBuilder is a Symfony-based learning platform with a real Shopware Admin API bridge: published SkillBuilder lessons can be synchronized as Shopware products through an admin workflow.

## What This Demonstrates

- PHP/Symfony backend development
- Doctrine and MariaDB data modeling
- Twig-based user and admin interfaces
- role-based access control
- service-layer architecture
- learning progress and scheduling logic
- GDPR-oriented export workflows
- deployment and live operation
- API-based e-commerce integration with Shopware

## My Technical Contribution

I designed and implemented the SkillBuilder platform as a practical backend project. The work includes domain modeling, controllers, services, templates, database work, tests, debugging, deployment, and the Shopware integration workflow.

The Shopware bridge is implemented as an admin-only workflow:

```text
SkillBuilder Admin -> Shopware Demo-Produkte button -> Symfony Import Service -> Shopware Admin API -> Shopware products
```

## Shopware Mapping

| SkillBuilder | Shopware |
| --- | --- |
| Published lesson | Product |
| Lesson title | Product name |
| Lesson description | Product description |
| Lesson ID | Stable product number |
| Publication status | Product visibility |

Important boundary: chapters are not synchronized as Shopware categories. Products are assigned to the single shop category `SkillBuilder Kurse`.

## Why This Is Relevant

The project shows more than a static demo. It connects a Symfony business application with a real Shopware installation and turns a manual content-maintenance task into a repeatable admin workflow.

For employers, the relevant skills are:

- understanding business workflows
- building maintainable Symfony services
- integrating external APIs
- handling status-based synchronization
- documenting a deployed system clearly
- separating demo-safe public code from private production configuration

## Demo Boundaries

The public repositories do not include production credentials, private source code, user data, `.env` files, or deployment secrets.

The connected Shopware storefront is a portfolio demo. It does not process real orders, payments, registrations, contact forms, or customer data.

## Configuration And Secrets

The repository includes [.env.example](../.env.example) with placeholder names only. Real values are configured on the server, in CI secrets, or in a private config file outside the application directory and are not committed to GitHub.

Shopware Admin API credentials are used only by the Symfony backend. They are not exposed in storefront JavaScript.

## Interview Talking Points

- why published lessons are the source of truth
- how the admin-triggered synchronization works
- how repeated imports avoid duplicate products
- how unpublished content is removed from storefront visibility
- why chapters stay inside SkillBuilder instead of becoming Shopware categories
- how credentials and environment-specific configuration are kept out of GitHub
