# Roadynet PHP/Symfony Portfolio

This portfolio is strongest when it is read as product work, not as a documentation archive. The projects show practical PHP/Symfony development, Shopware integration, AI/MCP workflows, CI quality gates, operations thinking and careful handling of private production code.

## Quick read

For applications and recruiter messages, use the [Application Link Map](docs/application-link-map.md).

| Project | Product signal | Start here |
| --- | --- | --- |
| [ChatGPT Knowledge MCP](https://github.com/roadynet/chatgpt-knowledge-mcp) | Private ChatGPT backup knowledge base with media import, protected file access and MCP connector | [README](https://github.com/roadynet/chatgpt-knowledge-mcp) |
| [SkillBuilder Showcase](https://github.com/roadynet/skillbuilder-showcase) | Private Symfony learning platform, public evidence, GDPR-aware flows and Shopware bridge | [Live demo](https://sb.mcmonaco.de) - [Architecture](docs/architecture.md) - [Examples](examples/) |
| [Shopware Demo Shop](https://github.com/roadynet/shopware-demo-shop) | Storefront proof for SkillBuilder lessons synchronized through the Shopware Admin API | [Live demo](https://sw.mcmonaco.de) - [Quality Report](https://github.com/roadynet/shopware-demo-shop/blob/main/docs/quality-report.md) |
| [CMS to Commerce Hub](https://github.com/roadynet/CmsToCommerce) | Symfony commerce integration hub for CMS/PIM/ERP input and Shopware/Amazon-ready listings | [Live demo](https://cc.mcmonaco.de/demo) - [README](https://github.com/roadynet/CmsToCommerce) |
| [KursBuchenZoomLink](https://github.com/roadynet/KursBuchenZoomLink) | Course booking, payment confirmation, Zoom automation and webhook integration | [README](https://github.com/roadynet/KursBuchenZoomLink) - [Quality Report](https://github.com/roadynet/KursBuchenZoomLink/blob/main/docs/quality-report.md) |

## What this portfolio should communicate

For PHP, Symfony, Shopware and backend integration roles, the technical work is closer to real application development than a first glance may suggest. The projects include live demos, domain workflows, external integration boundaries, PHPUnit coverage, PHPStan quality gates, GitHub Actions and operations notes.

The newer AI/MCP work adds a privacy-oriented connector story: exported ChatGPT data is made searchable, media-aware and accessible through a protected MCP surface without exposing private backup content in public repositories.

The key improvement is presentation: the portfolio should lead like a product page. A reviewer should immediately understand the product problem, the live surface, the best code path and the quality evidence before entering deeper audit material.

## Strongest story

1. **ChatGPT Knowledge MCP** is the newest signal: a private knowledge workflow for ChatGPT backups, media import, protected file access and MCP-based retrieval.
2. **SkillBuilder** is the product: a learning platform with role-based workflows, learning logic, progress tracking, GDPR-oriented data boundaries and Shopware synchronization.
3. **Shopware Demo Shop** is the visible commerce proof: published lessons become Shopware products through a server-side Admin API integration.
4. **CMS to Commerce Hub** broadens the commerce story: imports, normalization, channel drafts and ERP/PIM-style integration patterns.
5. **KursBuchenZoomLink** shows a smaller automation product: bookings, payment confirmation, Zoom link generation and protected webhooks.

## Technical signals

- PHP 8.4, Symfony, Doctrine, Twig and service-oriented backend structure
- Shopware Admin API and commerce synchronization paths
- MCP connector design, private archive search and protected media access
- PHPUnit and PHPStan Level 3 in public CI where applicable
- GitHub Actions gates for syntax, Composer, Symfony, links, env policy and secret-pattern checks
- Operations documentation, production evidence and explicit privacy boundaries

## Reviewer guidance

Start with ChatGPT Knowledge MCP for the newest AI/MCP signal, then open the live demos, then read the architecture pages, representative examples and quality reports. The audit documents are supporting evidence; the product narrative should come first.
