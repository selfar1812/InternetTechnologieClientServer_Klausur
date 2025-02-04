<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles3.css">
    <title>Projektübersicht</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        select { padding: 5px; }
    </style>
</head>
<body>
<header>
    <h1 class="center-heading">PHP-Webanwendung</h1>
    <nav>
        <ul class="nav-list">
            <li><a href="index.php">FEL</a></li>
            <li><a href="projektuebersicht.php">Projektübersicht</a></li>
            <li><a href="table.php">Datenbank-Übersicht</a></li>
            <li><a href="graph.php">Graphen-Übersicht</a></li>
            <li><a href="kontakt.php">Kontakt</a></li>
        </ul>
    </nav>
</header>
<h2 class="center-heading">Projektübersicht</h2>
<h4>Projektziel:</h4>
    <p> Die Aufgabe besteht darin, eine Webanwendung zu entwickeln, die Messdaten aus sechs Datensätzen (CSV-Dateien) visuell darstellt und grundlegende Bearbeitungsfunktionen darauf ermöglicht.
    </p>
<h4>Anforderungen:</h4>
<h5>1. Datenverarbeitung:</h5>
    <p>
    ⚪ Einlesen der sechs CSV-Datensätze in eine Datenbank<br>
    ⚪ Möglichkeit zur Auswahl und Anzeige der Datensätze auf der Webseite<br>
    </p>
<h5>2. Webanwendung:</h5>
    <p>
    ⚪ Entwicklung mit PHP, CSS und JavaScript<br>
    ⚪ Verwendung von Google Charts oder alternativen Tools zur Darstellung der Messwerte<br>
    ⚪ Benutzerfreundliche und ansprechende Gestaltung
    </p>
<h5>3. Funktionalitäten:</h5>
    <p>
    ⚪ Auswahlboxen zur Selektion einzelner Datensätze<br>
    ⚪ Darstellung der Daten als Diagramme (einzeln oder kombiniert)<br>
    ⚪ Interaktive Manipulation der Daten, z. B.: Anpassung von Farben, Linienbreite, Linienart, Entfernung von Ausreißern, Autoskalierung, Min/Max-Berechnung  
    </p>
<h4>Datensätze:</h4>
    <p> 1. FHIFEL:GUN:Filament:M_Volt.csv<br>
        2. FHIFEL:GUN:Filament:M_Curr.csv<br>
        3. FHIFEL:Undulator:GetGap.csv<br>
        4. FHIFEL:Undulator:SetGap.csv<br>
        5. FHIFEL:DA0102MP:M_Curr.csv<br>
        6. FHIFEL:DA0102MP:S_Curr.csv
    </p>  
<h4>Zusätzliche Informationen:</h4>
    <p> Google Charts API kann zur Visualisierung genutzt werden: <a href="https://developers.google.com/chart/interactive/docs">Google Charts</a><br>
        Fachlicher Bezug: Freie-Elektronen-Laser (FEL)<br>
    </p>  
<h5>Projektbetreuer: Prof. Heinz Junkes</h5>

    <nav>
        <ul class="nav-list">
            <li><a href="kontakt.php">Ein Projekt von Shelly Nurul Farhani</a></li>
        </ul>
    </nav>

</body>
</html>