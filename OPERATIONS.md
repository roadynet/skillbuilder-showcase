# OPERATIONS.md - SkillBuilder Showcase

Dieses Runbook dokumentiert den betrieblichen Rahmen von SkillBuilder als
öffentlich teilbare Evidence. Die produktive private Anwendung wird bewusst
nicht vollständig veröffentlicht; dieses Repo zeigt sichere Ausschnitte,
Screenshots, Audit-Notizen und Integrationsbelege.

Live-Demo: `https://sb.mcmonaco.de`

## Umgebung und Serverpfade

| Bereich | Konzept |
| --- | --- |
| Anwendung | private Symfony-Lernplattform |
| öffentliche Evidence | dieses Showcase-Repository |
| Live-Demo | `https://sb.mcmonaco.de` |
| Shopware-Demo | [roadynet/shopware-demo-shop](https://github.com/roadynet/shopware-demo-shop) |
| produktive Pfade | aus Sicherheitsgründen nicht veröffentlicht |
| private Konfiguration | Servervariablen oder private Config-Dateien außerhalb des Repositories |

Der genaue produktive Serverpfad wird nicht öffentlich dokumentiert, weil daraus
Hosting-Struktur, Usernamen oder private Deployment-Details ableitbar wären.

## Deployment-Ablauf

Produktiver Ablauf der privaten Anwendung:

1. Änderungen lokal prüfen.
2. PHP-/Twig-/YAML-/Container-Checks ausführen.
3. PHPUnit-/Domain-Tests ausführen.
4. Dateien auf den produktiven Server synchronisieren.
5. Composer-Abhängigkeiten installieren/optimieren.
6. Doctrine-Migrationen kontrolliert ausführen.
7. Symfony-Prod-Cache leeren und warmen.
8. Live-Smoke-Checks durchführen:

   ```text
   Login
   Dashboard
   Lesson-Flow
   Admin-Cockpit
   Shopware-Sync
   ```

Dieses öffentliche Repo validiert zusätzlich Beispielcode und Showcase-Doku per
GitHub Actions.

## Env- und Secrets-Konzept

- `.env.example` enthält nur Platzhalter.
- echte Werte liegen nicht im Repository.
- produktive Werte liegen serverseitig oder in privaten Config-Dateien.
- Shopware Admin API Credentials werden nur serverseitig verwendet.
- Demo-/Portfolio-Daten sind anonymisiert.

Typische Secret-Klassen:

```text
APP_SECRET
DATABASE_URL
MAILER_DSN
SHOPWARE_ADMIN_BASE_URL
SHOPWARE_ADMIN_CLIENT_ID
SHOPWARE_ADMIN_CLIENT_SECRET
```

## Datenbankmigrationen

Die private SkillBuilder-App nutzt Symfony/Doctrine. Nach Deployments wird
geprüft:

```bash
php bin/console doctrine:migrations:status --env=prod --no-interaction
php bin/console doctrine:migrations:migrate --env=prod --no-interaction
php bin/console doctrine:schema:validate --env=prod --no-interaction
```

Das öffentliche Showcase-Repo enthält keine produktive Datenbank und keine
Nutzerdaten.

## Rollback-Idee

1. vorherigen stabilen Code-Stand deployen
2. Secrets/Servervariablen unverändert lassen
3. Cache neu bauen
4. Datenbankmigrationen nur nach Prüfung zurücknehmen
5. bei Shopware-Sync-Problemen: Sync pausieren statt Produktdaten blind löschen

## Typische Fehlerfälle

| Fehlerbild | Ursache | Prüfung / Fix |
| --- | --- | --- |
| Login oder Dashboard lädt nicht | Cache, Env, Security-Konfiguration | Logs, Cache, Router prüfen |
| Lesson-Fortschritt falsch | Domainlogik oder Datenstand | Tests, DB-Daten, Service prüfen |
| Shopware-Produkte fehlen | Sync nicht gelaufen oder API-Credentials falsch | Admin-Sync, API-Response, Server-Env prüfen |
| Demo zeigt alte Inhalte | Cache oder Deploy nicht vollständig | Prod-Cache leeren, Assets prüfen |
| Showcase wirkt nicht belegbar | private Quellen nicht öffentlich | Evidence-Dateien und Screenshots nutzen |

## Logs und Debugging

Private Anwendung:

```bash
tail -n 100 var/log/prod.log
php bin/console debug:router --env=prod
php bin/console debug:container --env=prod
php bin/console doctrine:migrations:status --env=prod
```

Öffentliches Repo:

```text
GitHub Actions -> Portfolio Audit
docs/evidence -> Audit- und Verification-Notizen
screenshots -> UI-Nachweise
```

## Monitoring-Ansatz

- GitHub Actions für Showcase-Beispiele
- Live-Smoke-Checks der Lernplattform
- manuelle Kontrolle der Shopware-Sync-Ergebnisse
- Audit-/Evidence-Dokumente für nachvollziehbare Qualität
- keine Veröffentlichung von Userdaten oder produktiven Logs

Nächste Ausbaustufe:

- automatisierter Uptime-Check
- Fehlerreporting für Shopware-Syncs
- regelmäßiger anonymisierter Health-Report

## Praxisnachweis

- [Production Operations Evidence](docs/evidence/production-operations-evidence-2026-07-01.md)
- [Evidence Index](docs/evidence/README.md)
- [Shopware Bridge](docs/shopware-bridge.md)
- [Case Study](docs/case-study.md)
