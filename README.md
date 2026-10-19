# 🍕 Pizzaservice

Webanwendung für einen Pizza-Lieferdienst mit vier Ansichten: **Bestellung**, **Kunde**, **Bäcker** und **Fahrer**. Entstanden im Modul *Entwicklung webbasierter Anwendungen (EWA)* an der Hochschule Darmstadt.

## Funktionen

- **Bestellung:** Pizzen per Klick auf das Bild in den Warenkorb legen, der Gesamtpreis wird live berechnet. Bestellen erst möglich, wenn Warenkorb und Lieferadresse ausgefüllt sind.
- **Kunde:** den Status der eigenen Bestellung verfolgen (bestellt → im Ofen → fertig → unterwegs). Die Seite fragt den Status alle 2 Sekunden per Fetch-API ab.
- **Bäcker:** den Status jeder bestellten Pizza setzen.
- **Fahrer:** fertige Bestellungen mit Adresse und Gesamtpreis sehen und als unterwegs oder ausgeliefert markieren.
- **JSON-API** (`/api`) für den Bestellstatus.

## Technik

| Bereich | Umsetzung |
|---|---|
| Backend | PHP 8 mit `strict_types`, schlankes **MVC** (Controller, Model, View) mit eigenem Router und sauberen URLs per `.htaccess` |
| Datenbank | MariaDB, alle Nutzereingaben über **Prepared Statements** (Schutz vor SQL-Injection) |
| Frontend | HTML, modulares CSS mit Variablen und Responsive Design, Vanilla JavaScript |
| Sicherheit | Ausgaben mit `htmlspecialchars` bzw. Escaping in JavaScript gegen XSS, Ordner `App/` von außen gesperrt |
| Infrastruktur | Docker Compose mit PHP/Apache, MariaDB und phpMyAdmin |

## Starten

Voraussetzung: [Docker](https://docs.docker.com/get-docker/)

```bash
docker compose up -d --build
```

| Dienst | Adresse |
|---|---|
| Pizzaservice | http://localhost:8080 |
| phpMyAdmin | http://localhost:8085 |

Die Datenbank wird beim ersten Start automatisch aus `database/` angelegt und mit Beispieldaten gefüllt. Stoppen mit `docker compose down`, komplett zurücksetzen mit `docker compose down -v`.

> Die Zugangsdaten in `docker-compose.yml` sind nur für die lokale Entwicklung gedacht.

## Projektstruktur

```
├── app/
│   ├── App/
│   │   ├── Controller/   # Order, Customer, Baker, Driver, Api
│   │   ├── Core/         # Router, BaseController, BaseModel
│   │   ├── Model/        # ArticleModel, OrderingModel
│   │   └── View/         # Templates je Seite und gemeinsame Partials
│   ├── assets/           # CSS, JavaScript, Bilder, Schriften
│   └── index.php         # Einstiegspunkt und Routing
├── database/             # SQL-Skripte: Schema, Beispieldaten, Berechtigungen
├── docker/               # Dockerfile und Apache-Konfiguration
└── docker-compose.yml
```

## Hinweis

Das MVC-Grundgerüst stammt aus der Vorlage des Moduls EWA der Hochschule Darmstadt. Die Pizzaservice-Anwendung habe ich darauf aufbauend entwickelt.
