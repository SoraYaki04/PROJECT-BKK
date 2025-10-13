<?php
// Database Setup Script for BKK Project
// This script helps set up the database and test the connection

echo "<h2>BKK Database Setup</h2>";

// Test database connection
$host = "localhost";
$user = "root";
$password = "";
$database = "bkk";

echo "<h3>Testing Database Connection...</h3>";

// First, try to connect without specifying database
$koneksi = mysqli_connect($host, $user, $password);
if (!$koneksi) {
    echo "<p style='color: red;'>❌ Connection failed: " . mysqli_connect_error() . "</p>";
    echo "<p>Please make sure MySQL service is running in XAMPP.</p>";
    echo "<p>Steps to fix:</p>";
    echo "<ol>";
    echo "<li>Open XAMPP Control Panel</li>";
    echo "<li>Start MySQL service</li>";
    echo "<li>Refresh this page</li>";
    echo "</ol>";
    exit;
} else {
    echo "<p style='color: green;'>✅ Connected to MySQL successfully!</p>";
}

// Check if database exists
$result = mysqli_query($koneksi, "SHOW DATABASES LIKE '$database'");
if (mysqli_num_rows($result) == 0) {
    echo "<p>Database '$database' does not exist. Creating...</p>";
    
    if (mysqli_query($koneksi, "CREATE DATABASE $database")) {
        echo "<p style='color: green;'>✅ Database '$database' created successfully!</p>";
    } else {
        echo "<p style='color: red;'>❌ Error creating database: " . mysqli_error($koneksi) . "</p>";
        exit;
    }
} else {
    echo "<p style='color: green;'>✅ Database '$database' already exists!</p>";
}

// Select the database
mysqli_select_db($koneksi, $database);

// Check if tables exist
$tables = ['users', 'alumni', 'berita', 'jurusan', 'lamaran', 'lowker', 'perusahaan', 'survey'];
$missing_tables = [];

foreach ($tables as $table) {
    $result = mysqli_query($koneksi, "SHOW TABLES LIKE '$table'");
    if (mysqli_num_rows($result) == 0) {
        $missing_tables[] = $table;
    }
}

if (empty($missing_tables)) {
    echo "<p style='color: green;'>✅ All tables exist!</p>";
    echo "<p>Your database is ready to use.</p>";
} else {
    echo "<p style='color: orange;'>⚠️ Missing tables: " . implode(', ', $missing_tables) . "</p>";
    echo "<p>You need to import the database structure. Here are your options:</p>";
    echo "<ol>";
    echo "<li><strong>Using phpMyAdmin:</strong>";
    echo "<ul>";
    echo "<li>Open http://localhost/phpmyadmin</li>";
    echo "<li>Select the 'bkk' database</li>";
    echo "<li>Go to Import tab</li>";
    echo "<li>Choose the file: db/bkk_clean.sql</li>";
    echo "<li>Click Go</li>";
    echo "</ul></li>";
    echo "<li><strong>Using Command Line:</strong>";
    echo "<ul>";
    echo "<li>Open Command Prompt as Administrator</li>";
    echo "<li>Navigate to: C:\\xampp\\mysql\\bin</li>";
    echo "<li>Run: mysql -u root -p bkk < C:\\xampp\\htdocs\\PROJECT-BKK-main\\db\\bkk_clean.sql</li>";
    echo "</ul></li>";
    echo "</ol>";
}

// Test the connection with the database
$test_koneksi = mysqli_connect($host, $user, $password, $database);
if ($test_koneksi) {
    echo "<p style='color: green;'>✅ Database connection test successful!</p>";
    echo "<p>You can now run your BKK application.</p>";
} else {
    echo "<p style='color: red;'>❌ Database connection test failed: " . mysqli_connect_error() . "</p>";
}

mysqli_close($koneksi);
?>

<style>
body {
    font-family: Arial, sans-serif;
    max-width: 800px;
    margin: 50px auto;
    padding: 20px;
    background-color: #f5f5f5;
}
h2 {
    color: #333;
    border-bottom: 2px solid #007bff;
    padding-bottom: 10px;
}
h3 {
    color: #555;
}
p {
    line-height: 1.6;
}
ol, ul {
    margin-left: 20px;
}
li {
    margin-bottom: 5px;
}
</style>
