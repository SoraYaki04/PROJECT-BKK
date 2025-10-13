<!DOCTYPE html>
<html>
<head>
    <title>Database Structure Check</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .error { color: red; }
        .success { color: green; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Database Structure Check</h2>
    
    <?php
    $koneksi = mysqli_connect('localhost', 'root', '', 'bkk');
    if (!$koneksi) {
        echo '<p class="error">Connection failed: ' . mysqli_connect_error() . '</p>';
        exit;
    }
    
    echo '<p class="success">Database connection successful!</p>';
    
    // Check alumni table structure
    echo '<h3>Alumni Table Structure:</h3>';
    $result = mysqli_query($koneksi, 'DESCRIBE alumni');
    if ($result) {
        echo '<table>';
        echo '<tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th><th>Extra</th></tr>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($row['Field']) . '</td>';
            echo '<td>' . htmlspecialchars($row['Type']) . '</td>';
            echo '<td>' . htmlspecialchars($row['Null']) . '</td>';
            echo '<td>' . htmlspecialchars($row['Key']) . '</td>';
            echo '<td>' . htmlspecialchars($row['Default'] ?? 'NULL') . '</td>';
            echo '<td>' . htmlspecialchars($row['Extra']) . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo '<p class="error">Error describing alumni table: ' . mysqli_error($koneksi) . '</p>';
    }
    
    // Check if survey table exists
    echo '<h3>Survey Table Check:</h3>';
    $result = mysqli_query($koneksi, "SHOW TABLES LIKE 'survey'");
    if (mysqli_num_rows($result) > 0) {
        echo '<p class="success">Survey table exists</p>';
        $result = mysqli_query($koneksi, 'DESCRIBE survey');
        if ($result) {
            echo '<table>';
            echo '<tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th><th>Extra</th></tr>';
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row['Field']) . '</td>';
                echo '<td>' . htmlspecialchars($row['Type']) . '</td>';
                echo '<td>' . htmlspecialchars($row['Null']) . '</td>';
                echo '<td>' . htmlspecialchars($row['Key']) . '</td>';
                echo '<td>' . htmlspecialchars($row['Default'] ?? 'NULL') . '</td>';
                echo '<td>' . htmlspecialchars($row['Extra']) . '</td>';
                echo '</tr>';
            }
            echo '</table>';
        }
    } else {
        echo '<p class="error">Survey table does not exist</p>';
    }
    
    mysqli_close($koneksi);
    ?>
</body>
</html>

