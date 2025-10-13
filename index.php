<?php
// Main entry point for BKK Application
// Redirect to the main BKK application

// Check if the setup script exists and redirect to it if needed
if (file_exists('BKK/tools/setup_database.php')) {
    // You can uncomment the line below to run setup automatically
    // header('Location: BKK/tools/setup_database.php');
    // exit;
}

// Redirect to the main application
header('Location: BKK/Home/HalamanUtama/berandautama.php');
exit;
?>
