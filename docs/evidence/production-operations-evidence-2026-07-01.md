# Production Operations Evidence - SkillBuilder

Diese Evidence-Datei dokumentiert praxisnahe Betriebs- und Integrationsarbeit
aus dem privaten SkillBuilder-System. Der öffentliche Showcase enthält bewusst
nur anonymisierte Nachweise, keine Produktionsquellen, keine echten Userdaten
und keine Secrets.

Live-Demo: `https://sb.mcmonaco.de`

## Belegbare Praxis

| Bereich | Evidence | Was es zeigt |
| --- | --- | --- |
| Symfony-Betrieb | Live-Demo, Showcase, Screenshots, Audit-Dokumente | betriebene Webanwendung statt reines Code-Snippet |
| Rollen und Workflows | Nutzer-, Lehrer- und Admin-Flows | fachliche Prozesse sauber modellieren |
| Qualität | öffentliche und private Test-/Audit-Notizen | Tests, Linting, technische Schulden sichtbar machen |
| Datenschutz | DSGVO-orientierte Export-/Grenzlogik | verantwortlicher Umgang mit Userdaten |
| Shopware-Integration | veröffentlichte Lessons werden serverseitig zu Shopware-Produkten | API-Integration ohne Frontend-Secrets |
| Secrets | `.env.example` nur Platzhalter, echte Werte serverseitig/privat | sichere Konfigurationsgrenze |

## Betriebsfälle

### 1. Private Codebasis öffentlich belegbar machen

**Problem:** Die produktive App enthält private Logik, Userdaten und
Zugangsdaten und kann nicht vollständig veröffentlicht werden.

**Lösung:**

- öffentlicher Showcase mit Screenshots und anonymisierten Beispielen
- Evidence-Dateien mit Test- und Audit-Ergebnissen
- kleine repräsentative Codebeispiele statt vollständiger Produktivquellen
- klare Trennung zwischen `public showcase` und `private app`

**Praxis-Signal:** Professionelle Portfolio-Arbeit heißt nicht, private Systeme
blind zu veröffentlichen, sondern belastbare Nachweise sicher aufzubereiten.

### 2. Shopware Admin API serverseitig gekapselt

**Problem:** Lerninhalte sollten im Shop sichtbar werden, ohne sie doppelt in
SkillBuilder und Shopware zu pflegen.

**Lösung:**

```text
published lesson -> stable product number -> Shopware product upsert
```

Die Admin API läuft serverseitig. Zugangsdaten landen nicht im Browser und nicht
im Repository.

**Praxis-Signal:** API-Integration mit stabilen IDs, idempotentem Update und
sauberer Secret-Grenze.

### 3. Qualität und Audits sichtbar machen

**Problem:** Ohne private Quellen ist schwer belegbar, dass die App über Demo-UI
hinaus technisch gepflegt wurde.

**Lösung:**

- private Verification Notes
- PHPStan-/Audit-Evidence
- Demo-Checklisten
- Interview-QA
- Screenshots der relevanten Admin- und Lernflows

**Praxis-Signal:** Reviewer bekommen eine nachvollziehbare Prüfspur, ohne
produktive Interna sehen zu müssen.

## Interview-Demo in 5 Minuten

1. Live-Demo und Screenshots öffnen
2. Lernflow erklären: Lesson -> Fragen -> Wiederholung -> Statistik
3. Admin-Workflow erklären: Inhalte pflegen und veröffentlichen
4. Shopware-Brücke erklären: veröffentlichte Lesson -> Shopware-Produkt
5. Evidence-Index zeigen: Tests, Audit, Datenschutzgrenzen

## Bewusst nicht veröffentlicht

- produktive Datenbankinhalte
- reale Nutzer- oder Lernverlaufsdaten
- private Symfony-Quellen
- Shopware-Zugangsdaten
- Server- oder Deployment-Secrets
