# Shopware Bridge

## Goal

The Shopware bridge turns the private SkillBuilder demo into a visible cross-system portfolio workflow:

```text
SkillBuilder Admin -> Button -> Shopware products and categories
```

Instead of describing integration work abstractly, the admin can trigger a real export and then inspect the result in a live Shopware storefront.

## Demo Flow

1. An admin opens the SkillBuilder dashboard.
2. The admin clicks **Shopware Demo-Produkte**.
3. SkillBuilder reads lessons and their sections.
4. The integration calls the Shopware Admin API.
5. Shopware receives or updates demo products and categories.
6. The storefront displays the generated commerce structure.

## Mapping

| SkillBuilder | Shopware |
| --- | --- |
| Lesson | Product |
| Lesson title | Product name |
| Lesson description | Product description |
| Lesson section | Category |
| Lesson ID | Stable product number |
| Admin import result | Flash message |

## Design Notes

- The import is admin-only.
- Product numbers are stable, using a `SB-COURSE-*` pattern.
- Re-running the import updates existing products.
- Categories are created from the course structure.
- Storefront styling was aligned with the SkillBuilder dashboard: navy header, blue accents, compact cards, and clear action buttons.

## Portfolio Value

This feature demonstrates:

- Symfony service design
- API integration with OAuth-style authentication
- idempotent import logic
- domain mapping between learning content and commerce entities
- live operational work across two production-style systems

