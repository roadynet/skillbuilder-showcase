# Architecture Overview

SkillBuilder follows a backend-driven Symfony architecture. Controllers handle HTTP concerns, while domain decisions live in services.

```mermaid
flowchart TD
    User["Learner"] --> UI["Twig UI"]
    Admin["Admin"] --> UI
    UI --> Controller["Symfony Controllers"]
    Controller --> Security["Security / Voters / Roles"]
    Controller --> Services["Domain Services"]
    Services --> Scheduler["Learning Scheduler"]
    Services --> Stats["Statistics Builder"]
    Services --> Imports["Import Workflows"]
    Services --> Shopware["Shopware API Bridge"]
    Services --> GDPR["GDPR Export Flow"]
    Services --> Doctrine["Doctrine ORM"]
    Shopware --> Storefront["Shopware Storefront"]
    Doctrine --> DB["MySQL / MariaDB"]
```

## Key Domains

- `Lesson`: top-level learning unit
- `LessonSection`: structured content section
- `CourseQuestion`: question assigned to a lesson or section
- `CourseQuestionOption`: answer option for multiple choice
- `CourseQuestionProgress`: user-specific learning state
- `UserLearningSettings`: rhythm and scheduling preferences
- `GdprExportRequest`: user data export request

## Service Layer

Representative service responsibilities:

- schedule the next review after an answer
- select due questions
- calculate progress and stability
- import structured content
- export demo commerce data to Shopware
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
    Importer->>API: Ensure SkillBuilder shop category exists
    Importer->>API: Create or update products
    Importer->>API: Deactivate unpublished course products
    Importer->>API: Hide obsolete child categories from earlier imports
    API->>Storefront: Products become visible in the SkillBuilder shop category
```

Mapping:

- Published lesson becomes a Shopware product
- Products are assigned to the `SkillBuilder Kurse` shop category
- Product numbers use a stable `SB-COURSE-*` format
- Repeated imports update existing products instead of duplicating them
- Unpublished lessons are removed from storefront visibility

## Security Model

The private application uses:

- authenticated sessions
- role-based access for users, teachers, and admins
- explicit admin-only routes
- access checks before sensitive workflows
- safe GDPR export ownership
