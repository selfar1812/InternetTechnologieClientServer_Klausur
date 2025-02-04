<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "fel_data"; // Der Name deiner Datenbank

// Verbindung zur Datenbank herstellen
$conn = new mysqli($servername, $username, $password, $dbname);

// Überprüfen, ob die Verbindung erfolgreich war
if ($conn->connect_error) {
    die("❌ Verbindung fehlgeschlagen: " . $conn->connect_error);
}
echo "✅ Erfolgreich mit der Datenbank verbunden!<br>";


//filament_m_volt Tabelle
$filename = "/Applications/MAMP/htdocs/klausur/FHIFELGUNFilamentM_Volt.csv"; // Pfad zur CSV-Datei
$table = "filament_m_volt"; // Tabellenname für die Meldung
$rowCount = 0;

if (($handle = fopen($filename, "r")) !== FALSE) {
    fgetcsv($handle, 1000, ","); // Erste Zeile (Header) überspringen

    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $id = $data[0];
        $datum = $data[1]; 
        $wert = $data[2];   

        $sql = "INSERT INTO $table (id, datum, wert) VALUES ('$id','$datum', '$wert')";

        if ($conn->query($sql) === TRUE) {
            $rowCount++;
        }
    }
    fclose($handle);

    // Meldung für die gesamte Datei ausgeben
    echo "✅ Erfolgreich: $rowCount Datensätze in $table eingefügt.<br><br>";
} else {
    echo "❌ Fehler beim Öffnen der Datei: $filename<br>";
}

//filament_m_curr Tabelle
$filename = "/Applications/MAMP/htdocs/klausur/FHIFELGUNFilamentM_Curr.csv"; // Pfad zur CSV-Datei
$table = "filament_m_curr"; // Tabellenname für die Meldung
$rowCount = 0;

if (($handle = fopen($filename, "r")) !== FALSE) {
    fgetcsv($handle, 1000, ","); // Erste Zeile (Header) überspringen

    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $id = $data[0];
        $datum = $data[1]; 
        $wert = $data[2];   

        $sql = "INSERT INTO $table (id, datum, wert) VALUES ('$id','$datum', '$wert')";

        if ($conn->query($sql) === TRUE) {
            $rowCount++;
        }
    }
    fclose($handle);

    // Meldung für die gesamte Datei ausgeben
    echo "✅ Erfolgreich: $rowCount Datensätze in $table eingefügt.<br><br>";
} else {
    echo "❌ Fehler beim Öffnen der Datei: $filename<br>";
}

//mp_m_curr Tabelle
$filename = "/Applications/MAMP/htdocs/klausur/FHIFELDA0102MPM_Curr.csv"; // Pfad zur CSV-Datei
$table = "mp_m_curr"; // Tabellenname für die Meldung
$rowCount = 0;

if (($handle = fopen($filename, "r")) !== FALSE) {
    fgetcsv($handle, 1000, ","); // Erste Zeile (Header) überspringen

    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $id = $data[0];
        $datum = $data[1]; 
        $wert = $data[2];   

        $sql = "INSERT INTO $table (id, datum, wert) VALUES ('$id','$datum', '$wert')";

        if ($conn->query($sql) === TRUE) {
            $rowCount++;
        }
    }
    fclose($handle);

    // Meldung für die gesamte Datei ausgeben
    echo "✅ Erfolgreich: $rowCount Datensätze in $table eingefügt.<br><br>";
} else {
    echo "❌ Fehler beim Öffnen der Datei: $filename<br>";
}

//mp_s_curr Tabelle
$filename = "/Applications/MAMP/htdocs/klausur/FHIFELDA0102MPS_Curr.csv"; // Pfad zur CSV-Datei
$table = "mp_s_curr"; // Tabellenname für die Meldung
$rowCount = 0;

if (($handle = fopen($filename, "r")) !== FALSE) {
    fgetcsv($handle, 1000, ","); // Erste Zeile (Header) überspringen

    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $id = $data[0];
        $datum = $data[1]; 
        $wert = $data[2];   

        $sql = "INSERT INTO $table (id, datum, wert) VALUES ('$id','$datum', '$wert')";

        if ($conn->query($sql) === TRUE) {
            $rowCount++;
        }
    }
    fclose($handle);

    // Meldung für die gesamte Datei ausgeben
    echo "✅ Erfolgreich: $rowCount Datensätze in $table eingefügt.<br><br>";
} else {
    echo "❌ Fehler beim Öffnen der Datei: $filename<br>";
}

//undulator_get_gap Tabelle
$filename = "/Applications/MAMP/htdocs/klausur/FHIFELUndulatorGetGap.csv"; // Pfad zur CSV-Datei
$table = "undulator_get_gap"; // Tabellenname für die Meldung
$rowCount = 0;

if (($handle = fopen($filename, "r")) !== FALSE) {
    fgetcsv($handle, 1000, ","); // Erste Zeile (Header) überspringen

    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $id = $data[0];
        $datum = $data[1]; 
        $wert = $data[2];   

        $sql = "INSERT INTO $table (id, datum, wert) VALUES ('$id','$datum', '$wert')";

        if ($conn->query($sql) === TRUE) {
            $rowCount++;
        }
    }
    fclose($handle);

    // Meldung für die gesamte Datei ausgeben
    echo "✅ Erfolgreich: $rowCount Datensätze in $table eingefügt.<br><br>";
} else {
    echo "❌ Fehler beim Öffnen der Datei: $filename<br>";
}

//undulator_set_gap Tabelle
$filename = "/Applications/MAMP/htdocs/klausur/FHIFELUndulatorSetGap.csv"; // Pfad zur CSV-Datei
$table = "undulator_set_gap"; // Tabellenname für die Meldung
$rowCount = 0;

if (($handle = fopen($filename, "r")) !== FALSE) {
    fgetcsv($handle, 1000, ","); // Erste Zeile (Header) überspringen

    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $id = $data[0];
        $datum = $data[1]; 
        $wert = $data[2];   

        $sql = "INSERT INTO $table (id, datum, wert) VALUES ('$id','$datum', '$wert')";

        if ($conn->query($sql) === TRUE) {
            $rowCount++;
        }
    }
    fclose($handle);

    // Meldung für die gesamte Datei ausgeben
    echo "✅ Erfolgreich: $rowCount Datensätze in $table eingefügt.<br><br>";
} else {
    echo "❌ Fehler beim Öffnen der Datei: $filename<br>";
}

$conn->close();
?>
