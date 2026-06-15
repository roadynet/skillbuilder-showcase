# ADR 0003: Keep Shopware Sync Admin-Triggered And Server-Side

## Status

Accepted

## Context

SkillBuilder includes a demo workflow that synchronizes published lessons to Shopware products through the Shopware Admin API.

The workflow touches external credentials, product state, publication status, and cross-system consistency.

## Decision

Keep the Shopware synchronization:

- admin-triggered
- server-side
- idempotent through stable product numbers
- documented as a portfolio demo boundary
- separate from storefront JavaScript

Published lessons are synchronized as products. Lesson chapters remain internal SkillBuilder learning structure and are not synchronized as Shopware categories.

## Consequences

The integration stays easy to explain and safe to demo.

Longer-term, if synchronization grows, the next senior step would be to move heavy work behind a queue or retryable job while keeping the admin action as the visible trigger.
