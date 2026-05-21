# Shopware Admin API Bridge

## Goal

The Shopware bridge turns SkillBuilder into a visible cross-system portfolio workflow:

```text
SkillBuilder Admin -> Button -> Shopware Admin API -> Products
```

Instead of describing integration work abstractly, the admin can trigger a real synchronization and then inspect the result in a live Shopware storefront.

## Demo Flow

1. An admin opens the SkillBuilder dashboard.
2. The admin clicks **Shopware Demo-Produkte**.
3. SkillBuilder reads lessons with status `published`.
4. The integration authenticates against the Shopware Admin API.
5. Shopware receives or updates products.
6. Products for unpublished lessons are deactivated.
7. Obsolete child categories from earlier demo imports are hidden.
8. The storefront displays the synchronized SkillBuilder products.

## Mapping

| SkillBuilder | Shopware |
| --- | --- |
| Lesson | Product |
| Lesson title | Product name |
| Lesson description | Product description |
| Lesson ID | Stable product number |
| Lesson status `published` | Product visibility |
| Admin import result | Flash message |

## Design Notes

- The import is admin-only.
- The route uses CSRF protection.
- Shopware credentials are configured through environment variables.
- Product numbers are stable, using a `SB-COURSE-*` pattern.
- Re-running the import updates existing products.
- Products are assigned to the `SkillBuilder Kurse` shop category.
- Obsolete child categories from earlier demo imports are hidden again.
- Products are activated or deactivated based on SkillBuilder publication state.
- Storefront styling was aligned with the SkillBuilder dashboard: navy header, blue accents, compact cards, and clear action buttons.

## Portfolio Value

This feature demonstrates:

- Symfony service design
- API integration with OAuth-style authentication
- idempotent import logic
- status-driven product synchronization
- domain mapping between learning content and commerce entities
- live operational work across two production-style systems
- business-process automation for content-to-commerce workflows
