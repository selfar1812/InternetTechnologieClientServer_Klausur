<?php
$servername = "localhost";
$username = "root"; 
$password = "root"; 
$dbname = "fel_data"; 

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("❌ Verbindung fehlgeschlagen: " . $conn->connect_error);
}

$selected_table = $_GET['table'] ?? 'filament_m_volt'; // Standard-Tabelle

// Setze den Content-Type für CSV-Download
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="data_export.csv"');

// Öffne den Output-Stream
$output = fopen('php://output', 'w');

// Hole die Daten aus der Tabelle
$result = $conn->query("SELECT * FROM $selected_table");

if ($result->num_rows > 0) {
    // Schreibe die Kopfzeilen der Tabelle in die CSV
    $columns = $result->fetch_fields();
    $headers = [];
    foreach ($columns as $column) {
        $headers[] = $column->name;
    }
    fputcsv($output, $headers);

    // Schreibe die Datensätze in die CSV
    while ($row = $result->fetch_assoc()) {
        fputcsv($output, $row);
    }
}

fclose($output);
$conn->close();
exit;
?>
