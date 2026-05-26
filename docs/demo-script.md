# Demo Script

## Goal

Show SkillBuilder as the main Symfony learning-platform project and explain how the Shopware bridge turns published lessons into visible Shopware products.

## 2-Minute Demo

1. Open the SkillBuilder live demo.
2. Show the dashboard: progress, current lesson, and learning state.
3. Open the admin cockpit screenshot or live admin area if credentials are available.
4. Point to the **Shopware Demo-Produkte** admin action.
5. Explain the core flow:

```text
SkillBuilder Admin -> published lessons -> Symfony Import Service -> Shopware Admin API -> Shopware products
```

6. State the important boundary clearly: chapters are not synchronized as Shopware categories.
7. Open the connected Shopware demo and show the synchronized products.

## 5-Minute Demo

1. Start with the problem: learning content should not be maintained twice in a learning platform and in a shop.
2. Show SkillBuilder as the source system:
   - lessons
   - progress tracking
   - learning settings
   - admin workflows
3. Explain the backend focus:
   - Symfony controllers
   - service-layer logic
   - Doctrine data model
   - role checks
   - tests
4. Show the Shopware bridge:
   - admin-only button
   - published lessons only
   - stable product numbers
   - update instead of duplicate creation
   - deactivation of unpublished lesson products
5. Open the Shopware storefront and show the result.
6. Explain the demo protection:
   - no real orders
   - no payment
   - no registration
   - no contact form
   - no customer-data collection
7. Close with the technical value: Symfony business application plus API-based e-commerce integration.

## Key Sentences

- "SkillBuilder is the source of truth for learning content."
- "Published lessons are synchronized as Shopware products through the Admin API."
- "Chapters stay inside SkillBuilder and are not mapped to Shopware categories."
- "The storefront is intentionally demo-only: no orders, payments, registration, or contact forms."
- "The public repository is a showcase; private credentials and production source code are not published."

## Questions To Expect

### Which Shopware API endpoints are relevant?

The public example shows Admin API requests for product search, product create/update, category assignment, category cleanup, sales-channel context, and OAuth authentication.

### How do you avoid duplicate products?

The integration uses stable product numbers derived from SkillBuilder lesson IDs. Re-running the import updates the matching product.

### What happens to unpublished lessons?

Products that no longer match the published lesson set are deactivated so they do not remain active in the storefront.

### What is demo-safe and what is private?

The public repos contain documentation, screenshots, sanitized examples, and checks. Credentials, private application source code, user data, and deployment secrets remain private.
