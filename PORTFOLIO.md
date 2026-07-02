# Roadynet PHP/Symfony Portfolio

This portfolio is strongest when it is read as product work, not as a documentation archive. The projects show practical PHP/Symfony development, Shopware integration, CI quality gates, operations thinking and careful handling of private production code.

## Quick read

| Project | Product signal | Start here |
| --- | --- | --- |
| [SkillBuilder Showcase](https://github.com/roadynet/skillbuilder-showcase) | Private Symfony learning platform, public evidence, GDPR-aware flows and Shopware bridge | [Live demo](https://sb.mcmonaco.de) · [Architecture](docs/architecture.md) · [Examples](examples/) |
| [Shopware Demo Shop](https://github.com/roadynet/shopware-demo-shop) | Storefront proof for SkillBuilder lessons synchronized through the Shopware Admin API | [Live demo](https://sw.mcmonaco.de) · [Quality Report](https://github.com/roadynet/shopware-demo-shop/blob/main/docs/quality-report.md) |
| [CMS to Commerce Hub](https://github.com/roadynet/CmsToCommerce) | Symfony commerce integration hub for CMS/PIM/ERP input and Shopware/Amazon-ready listings | [Live demo](https://cc.mcmonaco.de/demo) · [README](https://github.com/roadynet/CmsToCommerce) |
| [KursBuchenZoomLink](https://github.com/roadynet/KursBuchenZoomLink) | Course booking, payment confirmation, Zoom automation and webhook integration | [README](https://github.com/roadynet/KursBuchenZoomLink) · [Quality Report](https://github.com/roadynet/KursBuchenZoomLink/blob/main/docs/quality-report.md) |

## What this portfolio should communicate

For PHP, Symfony and Shopware roles, the technical work is closer to real application development than a first glance may suggest. The projects include live demos, domain workflows, external integration boundaries, PHPUnit coverage, PHPStan quality gates, GitHub Actions and operations notes.

The key improvement is presentation: the portfolio should lead like a product page. A reviewer should immediately understand the product problem, the live surface, the best code path and the quality evidence before entering deeper audit material.

## Strongest story

1. **SkillBuilder** is the product: a learning platform with role-based workflows, learning logic, progress tracking, GDPR-oriented data boundaries and Shopware synchronization.
2. **Shopware Demo Shop** is the visible commerce proof: published lessons become Shopware products through a server-side Admin API integration.
3. **CMS to Commerce Hub** broadens the commerce story: imports, normalization, channel drafts and ERP/PIM-style integration patterns.
4. **KursBuchenZoomLink** shows a smaller automation product: bookings, payment confirmation, Zoom link generation and protected webhooks.

## Technical signals

- PHP 8.4, Symfony, Doctrine, Twig and service-oriented backend structure
- Shopware Admin API and commerce synchronization paths
- PHPUnit and PHPStan Level 3 in public CI where applicable
- GitHub Actions gates for syntax, Composer, Symfony, links, env policy and secret-pattern checks
- Operations documentation, production evidence and explicit privacy boundaries

## Reviewer guidance

Start with the live demos, then read the architecture pages, then inspect representative examples and quality reports. The audit documents are supporting evidence; the product narrative should come first.
