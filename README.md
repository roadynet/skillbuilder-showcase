# SkillBuilder Showcase

[![Portfolio Audit](https://github.com/roadynet/skillbuilder-showcase/actions/workflows/portfolio-audit.yml/badge.svg)](https://github.com/roadynet/skillbuilder-showcase/actions/workflows/portfolio-audit.yml)

Public portfolio evidence for **SkillBuilder**, a private Symfony learning platform with role-based workflows, learning logic, GDPR-oriented features, tests, deployment evidence, and a real Shopware Admin API bridge.

Live demo: `https://sb.mcmonaco.de`

Connected Shopware demo: [roadynet/shopware-demo-shop](https://github.com/roadynet/shopware-demo-shop)

## Best place to start

1. **Live-Demo:** `https://sb.mcmonaco.de`
2. **Portfolio map:** [PORTFOLIO.md](PORTFOLIO.md)
3. **Produktbild:** Lernplattform mit Rollen, Uebungen, Fortschritt, Admin-Workflows und Shopware-Sync.
4. **Architektur:** [docs/architecture.md](docs/architecture.md)
5. **Bester Codepfad:** [Representative examples](examples/) mit Lernlogik, Sectionscode und Role Checks
6. **Qualitaet:** [Quality Report](docs/quality-report.md), Public PHPUnit, Public PHPStan und private Production Evidence

## Produktpositionierung

SkillBuilder wird hier als Produkt praesentiert, nicht als Aktenordner: erst das geloeste Lernplattform-Problem, dann Live-Demo und Screenshots, danach Architektur, Quality Gates und Evidence. Die private Produktionslogik bleibt geschuetzt, aber die oeffentliche Showcase-Schicht zeigt genug, um echte Symfony-/Shopware-Entwicklungsarbeit nachvollziehbar zu machen.

## Audit & Evidence

- [Portfolio Audit Report](docs/audit-report-2026-05-23.md)
- [Quality Report](docs/quality-report.md)
- [Evidence Index](docs/evidence/README.md)
- [Production Operations Evidence](docs/evidence/production-operations-evidence-2026-07-01.md)
- [Operations Runbook](OPERATIONS.md)

## Tests & Quality Gates

[![Public PHPUnit + Portfolio Audit](https://img.shields.io/github/actions/workflow/status/roadynet/skillbuilder-showcase/portfolio-audit.yml?branch=main&label=Public%20PHPUnit%20%2B%20Portfolio%20Audit)](https://github.com/roadynet/skillbuilder-showcase/actions/workflows/portfolio-audit.yml)

- **Public PHPUnit:** Beispieltests für Lernlogik und Sectionscode laufen im öffentlichen Portfolio-Workflow.
- **Public PHPStan:** Level 3 läuft im Showcase-Repo über Composer und GitHub Actions.
- **Private PHPUnit Evidence:** 14 Tests / 650 Assertions sind als private Produktions-Evidence dokumentiert.
- **Private PHPStan Evidence:** Baseline wurde von 56 auf 17 Findings reduziert und mit Audit-Notizen belegt.
- **Portfolio-Schutz:** Syntaxcheck, Markdown-Linkcheck, Env-Policy, Secret-Pattern-Scan und Wording-Check laufen bei jedem Push.

## Auf einen Blick

- **Was ist es?** Eine Symfony-Lernplattform mit Lessons, Fragen, Fortschritt, Lernstatistik, Admin-Workflows und Shopware-Sync.
- **Tech-Stack:** PHP 8.4, Symfony, Doctrine, Twig, MariaDB, PHPUnit, GitHub Actions.
- **Warum interessant?** Das Projekt zeigt Produktentwicklung, Backend-Architektur, DSGVO-nahe Datenflüsse und E-Commerce-Integration in einem real betriebenen System.
- **Öffentlich hier:** Case Study, Screenshots, Architekturhinweise, Test-/Audit-Evidence und kleine anonymisierte Beispiele.
- **Nicht öffentlich:** private Produktionslogik, Userdaten, Deployment-Skripte, Zugangsdaten, generierte Uploads.

## Senior-Level Review-Pfad

| Frage | Einstieg |
| --- | --- |
| Welches Produktproblem wird gelöst? | Lernplattform mit Rollen, Übungen, Fortschritt, Statistik, DSGVO-Export |
| Wo liegt der Senior-Nachweis? | Service-orientiertes Symfony-Backend, Datenschutz, Tests, Betrieb, Shopware-Bridge |
| Welche Praxis ist belegbar? | [Production Operations Evidence](docs/evidence/production-operations-evidence-2026-07-01.md) |
| Wie wird Betrieb dokumentiert? | [OPERATIONS.md](OPERATIONS.md) |
| Was ist bewusst geschützt? | keine Produktionsquellen, keine Kundendaten, keine Secrets |
| Wie wird Commerce angebunden? | veröffentlichte Lessons werden serverseitig als Shopware-Produkte synchronisiert |

Senior-Signale:

- Business-Workflows liegen in Services statt in Controller-Monolithen.
- Öffentliche Beispiele sind klein, anonymisiert und sicher teilbar.
- Produktive Secrets bleiben außerhalb des Repositories.
- Die Shopware Admin API läuft serverseitig, niemals aus Frontend-JavaScript.
- Portfolio-Evidence enthält Screenshots, Tests, Audit-Notizen und Demo-Skripte.

## Kleine Codebeispiele

Lernflow:

```text
Lesson lesen -> Fragen üben -> Fehler wiederholen -> Fortschritt auswerten
```

Shopware-Bridge:

```text
published lesson -> stable product number -> Shopware product upsert
```

Datenschutzgrenze:

```text
public showcase: screenshots + anonymized examples
private app: user data + production source + secrets
```

## Was gebaut wurde

- role-based Login für Nutzer, Lehrer und Admins
- Lesson-Dashboard mit Onboarding
- Lese-, Test- und Fehlerwiederholungsflows
- adaptive Lernlogik und Lernstatistik
- Admin-Fragenpflege
- GDPR-/DSGVO-orientierter Datenexport
- Shopware Admin API Bridge für veröffentlichte Lessons
- Live-Betrieb auf Shared Hosting
- öffentlicher Showcase mit Evidence, Screenshots und kleinen Beispielen

## Screenshots

![Login](screenshots/01-login.png)

![Dashboard](screenshots/02-dashboard.png)

![Combined learning](screenshots/03-combined-learning.png)

![Learning statistics](screenshots/04-learning-statistics.png)

![Learning settings](screenshots/05-learning-settings.png)

![Admin cockpit with Shopware import](screenshots/06-admin-cockpit.png)

## Qualität und Evidence

Public showcase checks:

```text
4 tests / 7 assertions / OK
PHPStan Level 3 / OK
```

Private codebase evidence:

```text
14 tests / 650 assertions / OK
```

Zusätzlich dokumentiert:

- PHP syntax check
- Twig/YAML lint
- Symfony container lint
- Doctrine mapping validation
- Router checks
- live smoke checks
- PHPStan audit evidence

## Sicherheit und Grenzen

- `.env.example` enthält nur Platzhalter.
- echte Werte wie `APP_SECRET`, `DATABASE_URL` und Shopware-Zugangsdaten liegen serverseitig oder in privaten Config-Dateien.
- Demo-Zugangsdaten werden nicht öffentlich im Repository veröffentlicht.
- Dieses Repository ist ein Showcase, nicht die produktive App-Quelle.

## Weiterführende Doku

- [Case study](docs/case-study.md)
- [Architecture overview](docs/architecture.md)
- [Quality and test report](docs/quality-report.md)
- [Interview summary](docs/interview-summary.md)
- [Recruiter project summary](docs/project-summary-for-recruiters.md)
- [Evidence index](docs/evidence/README.md)
- [Production operations evidence](docs/evidence/production-operations-evidence-2026-07-01.md)
- [Operations runbook](OPERATIONS.md)
- [Demo script](docs/demo-script.md)
- [Shopware bridge](docs/shopware-bridge.md)
- [Representative examples](examples/)

## Portfolio-Positionierung

SkillBuilder demonstriert produktorientierte Symfony-Entwicklung: Domain Modeling, Service-Layer-Architektur, rollenbasierte Zugriffe, datenschutzbewusste Workflows, testbare Lernlogik, UI-Polish, Betrieb und API-basierte E-Commerce-Integration.
