<?php
$servername = "localhost";
$username = "root"; 
$password = "root"; 
$dbname = "fel_data"; 

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("❌ Verbindung fehlgeschlagen: " . $conn->connect_error);
}

// Holen der GET-Parameter
$selected_tables = isset($_GET['tables']) ? explode(',', $_GET['tables']) : [];
$start_date = $_GET['start_date'] ?? '2024-01-01';
$end_date = $_GET['end_date'] ?? date('Y-m-d');
$min_value = $_GET['min_value'] ?? 0;
$max_value = $_GET['max_value'] ?? 1000;

$data = [];

// Abrufen der Daten aus den ausgewählten Tabellen
foreach ($selected_tables as $table) {
    $query = "SELECT datum, wert FROM $table WHERE datum BETWEEN '$start_date' AND '$end_date' AND wert BETWEEN $min_value AND $max_value ORDER BY datum ASC";
    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {
        $data[$table][] = [$row['datum'], floatval($row['wert'])];
    }
}

// Setze den Header für den CSV-Download
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="graph_data_export.csv"');

// Öffne den Output-Stream
$output = fopen('php://output', 'w');

// Füge die Kopfzeilen der CSV hinzu
$headers = ['Datum'];
foreach ($selected_tables as $table) {
    $headers[] = $table; // Tabelle als Spaltenname hinzufügen
}
fputcsv($output, $headers);

// Mische die Daten basierend auf dem Datum
$merged_data = [];
foreach ($data as $table => $rows) {
    foreach ($rows as $row) {
        $datum = $row[0];
        $wert = $row[1];
        
        if (!isset($merged_data[$datum])) {
            $merged_data[$datum] = [];
        }
        $merged_data[$datum][$table] = $wert;
    }
}

// Schreibe die Daten in die CSV-Datei
foreach ($merged_data as $datum => $values) {
    $csv_row = [$datum];
    foreach ($selected_tables as $table) {
        $csv_row[] = $values[$table] ?? null; // Wenn kein Wert vorhanden ist, füge NULL hinzu
    }
    fputcsv($output, $csv_row);
}

fclose($output);
$conn->close();
exit;
?>
