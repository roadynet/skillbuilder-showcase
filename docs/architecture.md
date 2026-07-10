# Architecture Overview

SkillBuilder follows a backend-driven Symfony architecture. Controllers handle HTTP concerns, while domain decisions live in services.

This public overview is intentionally abstract. The private codebase, exact entity fields, production configuration, security internals, deployment details, credentials, and user data are not published.

## Public Use-Case View

```mermaid
flowchart LR
    Learner["Learner"] --> Read["Read lessons"]
    Learner --> Practice["Practice questions"]
    Learner --> Profile["Create learning profile"]
    Learner --> Progress["Review progress"]
    Learner --> Export["Request data export"]

    Teacher["Teacher"] --> Content["Manage learning content"]
    Teacher --> Questions["Manage questions"]
    Teacher --> Reports["Review learning statistics"]

    Admin["Admin"] --> Users["Manage users and roles"]
    Admin --> Sync["Trigger Shopware demo sync"]
    Admin --> Ops["Review operational status"]

    Sync --> Storefront["Shopware demo storefront"]
```

## Public System View

```mermaid
flowchart TD
    User["Learner / Teacher / Admin"] --> UI["Twig UI"]
    UI --> Controllers["Symfony controllers"]
    Controllers --> Security["Authentication, roles, access checks"]
    Controllers --> Services["Service layer"]

    Services --> Learning["Learning logic"]
    Services --> Profile["Profile and recommendations"]
    Services --> Content["Content workflows"]
    Services --> Reporting["Progress and statistics"]
    Services --> Privacy["Privacy workflows"]
    Services --> Commerce["Shopware demo bridge"]
    Services --> Persistence["Persistence layer"]

    Commerce --> Storefront["Shopware demo storefront"]
    Persistence --> Database["Relational database"]
```

## Public Domain Areas

- learning content and section navigation
- questions, answers, scheduling, and repetition
- learning profile and recommendation rules
- user roles, admin workflows, and reporting
- GDPR-oriented data export workflow
- Shopware demo synchronization for published lessons

## Service Layer

Representative service responsibilities:

- schedule the next review after an answer
- calculate learning profiles from weighted questionnaire-style answers
- turn profile results into recommendations and learning settings
- select due questions
- calculate progress and stability
- import structured content
- synchronize published lessons to Shopware products
- export user data with the correct request owner
- log sensitive GDPR access

## Shopware Demo Bridge

The portfolio demo includes an admin-only integration path:

```mermaid
sequenceDiagram
    actor Admin
    participant SkillBuilder
    participant Importer as ShopwareDemoProductImporter
    participant API as Shopware Admin API
    participant Storefront as Shopware Storefront

    Admin->>SkillBuilder: Click "Shopware Demo-Produkte"
    SkillBuilder->>Importer: Load published lessons
    Importer->>API: Ensure single SkillBuilder shop category exists
    Importer->>API: Create or update products
    Importer->>API: Deactivate unpublished lesson products
    Importer->>API: Hide obsolete child categories from earlier demo import attempts
    API->>Storefront: Products become visible in the SkillBuilder shop category
```

Mapping:

- Published lesson becomes a Shopware product
- Products are assigned to the `SkillBuilder Kurse` shop category
- Lesson chapters are not synchronized as Shopware categories
- Product numbers use a stable `SB-COURSE-*` format
- Repeated imports update existing products instead of duplicating them
- Unpublished lessons are removed from storefront visibility
- Sync results are shown in the SkillBuilder admin log and status card

## Security Model

The private application uses:

- authenticated sessions
- role-based access for users, teachers, and admins
- explicit admin-only routes
- access checks before sensitive workflows
- login throttling for repeated failed authentication attempts
- runtime host/header guard coverage
- safe GDPR export ownership
