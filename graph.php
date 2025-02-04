<?php
$servername = "localhost";
$username = "root"; 
$password = "root"; 
$dbname = "fel_data"; //datenbankname

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("❌ Verbindung fehlgeschlagen: " . $conn->connect_error);
}

// Tabellen mit Namen
$tables = [
    "filament_m_volt" => "Filament M Volt",
    "filament_m_curr" => "Filament M Curr",
    "undulator_get_gap" => "Undulator Get Gap",
    "undulator_set_gap" => "Undulator Set Gap",
    "mp_m_curr" => "DA0102MP M Curr",
    "mp_s_curr" => "DA0102MP S Curr"
];

// Benutzerauswahl verarbeiten
$selected_tables = isset($_GET['tables']) ? $_GET['tables'] : [];
$start_date = $_GET['start_date'] ?? '2024-01-01';
$end_date = $_GET['end_date'] ?? date('Y-m-d');
$min_value = $_GET['min_value'] ?? 0;
$max_value = $_GET['max_value'] ?? 1000;

// Standardfarben, Linienstärken und Linienarten
$default_colors = [
    "filament_m_volt" => "#FF0000",
    "filament_m_curr" => "#0000FF",
    "undulator_get_gap" => "#00FF00",
    "undulator_set_gap" => "#FF00FF",
    "mp_m_curr" => "#FFA500",
    "mp_s_curr" => "#800080"
];

$data = [];
$styles = [];

foreach ($selected_tables as $table) {
    $color = $_GET["color_$table"] ?? $default_colors[$table];
    $line_width = $_GET["width_$table"] ?? 3;
    $line_style = $_GET["style_$table"] ?? "0,0";

    $styles[$table] = [
        "color" => $color,
        "lineWidth" => (int) $line_width,
        "lineDashStyle" => array_map('intval', explode(',', $line_style))
    ];

    $query = "SELECT datum, wert FROM $table WHERE datum BETWEEN '$start_date' AND '$end_date' AND wert BETWEEN $min_value AND $max_value ORDER BY datum ASC";
    $result = $conn->query($query);
    
    while ($row = $result->fetch_assoc()) {
        $data[$table][] = [$row['datum'], floatval($row['wert'])];
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freie-Elektronen-Laser (FEL) Graphen-Übersicht</title>
    <link rel="stylesheet" href="stylestwo.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var dataTable = new google.visualization.DataTable();
            dataTable.addColumn('string', 'Datum');

            var datasets = <?= json_encode($data) ?>;
            var styles = <?= json_encode($styles) ?>;
            var tableNames = <?= json_encode($tables) ?>;

            Object.keys(datasets).forEach(function(table) {
                dataTable.addColumn('number', tableNames[table]);
            });

            var mergedData = {};
            Object.keys(datasets).forEach(function(table) {
                datasets[table].forEach(function(row) {
                    var datum = row[0];
                    var wert = row[1];

                    if (!mergedData[datum]) {
                        mergedData[datum] = {};
                    }
                    mergedData[datum][table] = wert;
                });
            });

            var finalRows = [];
            Object.keys(mergedData).sort().forEach(function(datum) {
                var row = [datum];
                Object.keys(datasets).forEach(function(table) {
                    row.push(mergedData[datum][table] || null);
                });
                finalRows.push(row);
            });

            dataTable.addRows(finalRows);

            var options = {
                title: 'Vergleich der Messwerte',
                curveType: 'function',
                legend: { position: 'bottom' },
                height: 500,
                series: Object.keys(datasets).reduce((acc, table, index) => {
                    acc[index] = {
                        color: styles[table].color,
                        lineWidth: styles[table].lineWidth,
                        lineDashStyle: styles[table].lineDashStyle
                    };
                    return acc;
                }, {})
            };

            var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
            chart.draw(dataTable, options);
        }
    </script>
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

<h2>📊 Freie-Elektronen-Laser (FEL) Graphen-Übersicht</h2>

<div class="container">
    <form method="GET" id="filterForm">
        <h4>Daten auswählen:</h4>
        <h5>1. Filament M Volt (Enthält Spannungsmessungen am Filament der Elektronenkanone)</h5>
        <h5>2. Filament M Curr (Enthält Strommessungen des Filaments in der Elektronenkanone)</h5>
        <h5>3. Undulator Get Gap (Liest die Spaltenweite des Undulators aus)</h5>
        <h5>4. Undulator Set Gap (Setzt die Spaltenweite des Undulators)</h5>
        <h5>5. DA0102MP M Curr (Enthält Strommessungen von DA0102MP mit Zeitstempeln)</h5>
        <h5>6. DA0102MP S Curr (Enthält Strommessungen des S-Sensors mit Zeitstempeln)</h5><br>
        <?php foreach ($tables as $key => $name): ?>
            <input type="checkbox" name="tables[]" value="<?= $key ?>" <?= in_array($key, $selected_tables) ? 'checked' : '' ?>> <?= $name ?><br>
            
            <label for="color_<?= $key ?>">Farbe:</label>
            <input type="color" name="color_<?= $key ?>" value="<?= $_GET["color_$key"] ?? $default_colors[$key] ?>">

            <label for="width_<?= $key ?>">Linienstärke:</label>
            <input type="number" name="width_<?= $key ?>" value="<?= $_GET["width_$key"] ?? 3 ?>" min="1" max="10">

            <label for="style_<?= $key ?>">Linienart:</label>
            <select name="style_<?= $key ?>">
                <option value="0,0" <?= ($_GET["style_$key"] ?? '0,0') == '0,0' ? 'selected' : '' ?>>Durchgezogen</option>
                <option value="4,4" <?= ($_GET["style_$key"] ?? '0,0') == '4,4' ? 'selected' : '' ?>>Gestrichelt</option>
                <option value="2,2" <?= ($_GET["style_$key"] ?? '0,0') == '2,2' ? 'selected' : '' ?>>Strichpunkt</option>
            </select>
            <br><br>
        <?php endforeach; ?>

        <!-- Startdatum und Enddatum mit Werten -->
        <label for="start_date">Startdatum:</label>
        <input type="date" name="start_date" value="<?= htmlspecialchars($start_date) ?>">

        <label for="end_date">Enddatum:</label>
        <input type="date" name="end_date" value="<?= htmlspecialchars($end_date) ?>">

        <!-- Min- und Max-Wert -->
        <br><br>
        <label for="min_value">Minimale Wert:</label>
        <input type="number" name="min_value" value="<?= htmlspecialchars($min_value) ?>">

        <label for="max_value">Maximale Wert:</label>
        <input type="number" name="max_value" value="<?= htmlspecialchars($max_value) ?>">

        <br><br>

        <button type="submit">Graphen aktualisieren</button>
    </form>

    <!-- Button zum Exportieren der gefilterten Graphdaten als CSV -->
    <form method="GET" action="export_graph_data.php">
        <input type="hidden" name="tables" value="<?= implode(',', $selected_tables) ?>" />
        <input type="hidden" name="start_date" value="<?= htmlspecialchars($start_date) ?>" />
        <input type="hidden" name="end_date" value="<?= htmlspecialchars($end_date) ?>" />
        <input type="hidden" name="min_value" value="<?= htmlspecialchars($min_value) ?>" />
        <input type="hidden" name="max_value" value="<?= htmlspecialchars($max_value) ?>" />
        <button type="submit">Graph-Daten als CSV herunterladen</button>
    </form>

    <div id="chart_div"></div>
</div><br>

    <nav>
        <ul class="nav-list">
            <li><a href="kontakt.php">Ein Projekt von Shelly Nurul Farhani</a></li>
        </ul>
    </nav>

</body>
</html>
