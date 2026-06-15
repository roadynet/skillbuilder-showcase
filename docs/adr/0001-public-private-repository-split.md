# ADR 0001: Keep Public Showcase Separate From Private Application

## Status

Accepted

## Context

SkillBuilder is a real Symfony application with private source code, deployment configuration, credentials, user data boundaries, and business-specific implementation details.

A public portfolio repository needs to prove engineering quality without publishing material that should remain private.

## Decision

Keep `roadynet/skillbuilder-showcase` as a public evidence repository, separate from the private production application.

The public repository may contain:

- architecture notes
- sanitized examples
- screenshots
- public quality evidence
- repeatable public checks
- demo-safe documentation

The public repository must not contain:

- private Symfony source directories
- production `.env` files
- credentials
- user data
- private deployment scripts
- generated exports or uploads

## Consequences

Reviewers cannot inspect the full private codebase here. Instead, they get a safe, repeatable, evidence-oriented view of the project.

The showcase therefore needs stronger public checks than a normal readme-only portfolio repository: local link checks, secret-pattern checks, private-path guards, PHP syntax checks, PHPUnit, and PHPStan.
