<?php
$servername = "localhost";
$username = "root"; 
$password = "root"; 
$dbname = "fel_data"; 

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("❌ Verbindung fehlgeschlagen: " . $conn->connect_error);
}

// Tabellenliste
$tables = [
    "filament_m_volt" => "Filament M Volt",
    "filament_m_curr" => "Filament M Curr",
    "undulator_get_gap" => "Undulator Get Gap",
    "undulator_set_gap" => "Undulator Set Gap",
    "mp_m_curr" => "DA0102MP M Curr",
    "mp_s_curr" => "DA0102MP S Curr"
];

$selected_table = $_GET['table'] ?? 'filament_m_volt'; // Standard-Tabelle
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylestwo.css">
    <title>Freie-Elektronen-Laser (FEL) Datenbank-Übersicht</title>
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
<h2 class="center-heading">📊 Freie-Elektronen-Laser (FEL) Datenbank-Übersicht</h2>

    <h4>Verfügbare Tabellen:</h4>
    <h5>1. Filament M Volt (Enthält Spannungsmessungen am Filament der Elektronenkanone)</h5>
    <h5>2. Filament M Curr (Enthält Strommessungen des Filaments in der Elektronenkanone)</h5>
    <h5>3. Undulator Get Gap (Liest die Spaltenweite des Undulators aus)</h5>
    <h5>4. Undulator Set Gap (Setzt die Spaltenweite des Undulators)</h5>
    <h5>5. DA0102MP M Curr (Enthält Strommessungen von DA0102MP mit Zeitstempeln)</h5>
    <h5>6. DA0102MP S Curr (Enthält Strommessungen des S-Sensors mit Zeitstempeln)</h5>

<form method="GET">
    <label for="table">Tabelle auswählen:</label>
    <select name="table" id="table" onchange="this.form.submit()">
        <?php foreach ($tables as $key => $name): ?>
            <option value="<?= $key ?>" <?= ($selected_table == $key) ? 'selected' : '' ?>><?= $name ?></option>
        <?php endforeach; ?>
    </select>
</form>

<h3>Daten aus: <?= $tables[$selected_table] ?></h3>

<table>
    <tr>
        <th>ID</th>
        <th>Datum</th>
        <th>Wert</th>
    </tr>
    <?php
    $result = $conn->query("SELECT * FROM $selected_table ORDER BY datum DESC LIMIT 100");

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>{$row['id']}</td><td>{$row['datum']}</td><td>{$row['wert']}</td></tr>";
        }
    } else {
        echo "<tr><td colspan='3'>Keine Daten gefunden</td></tr>";
    }
    ?>
</table>

<p>Die obige Sammlung stellt die ersten 100 Datensätze in der Tabelle dar.</p>

<!-- Button zum Exportieren der Daten als CSV -->
<form method="GET" action="export.php">
    <input type="hidden" name="table" value="<?= $selected_table ?>" />
    <button type="submit">Daten als CSV herunterladen</button>
</form>
<h4> </h4>

    <nav>
        <ul class="nav-list">
            <li><a href="kontakt.php">Ein Projekt von Shelly Nurul Farhani</a></li>
        </ul>
    </nav>

</body>
</html>

<?php
$conn->close();
?>
