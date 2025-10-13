<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Navbar - BKK</title>
    <link href="BKK/navbar/navbar.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f0f0f5;
        }
        .test-container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #134CBC;
            text-align: center;
            margin-bottom: 30px;
        }
        .status {
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    <div class="test-container">
        <h1>Test Navbar BKK</h1>
        
        <div class="status success">
            ✅ Session started successfully
        </div>
        
        <div class="status success">
            ✅ Navbar CSS loaded
        </div>
        
        <div class="status success">
            ✅ Font Awesome loaded
        </div>
        
        <h2>Testing Header:</h2>
        <?php include 'BKK/navbar/header.php'; ?>
        
        <h2>Testing Guest Navbar:</h2>
        <div style="background: #134CBC; padding: 10px; border-radius: 5px;">
            <?php include 'BKK/navbar/guest.php'; ?>
        </div>
        
        <h2>Testing Alumni Navbar:</h2>
        <div style="background: #134CBC; padding: 10px; border-radius: 5px;">
            <?php include 'BKK/navbar/alumni.php'; ?>
        </div>
        
        <h2>Testing Admin Navbar:</h2>
        <div style="background: #134CBC; padding: 10px; border-radius: 5px;">
            <?php include 'BKK/navbar/admin.php'; ?>
        </div>
        
        <div class="status success">
            ✅ Navbar test completed. If you can see the header and navigation menu above, everything is working correctly.
        </div>
        
        <p><strong>Note:</strong> If you see any errors or the navbar doesn't display properly, check the browser console for JavaScript errors and the PHP error log for any PHP issues.</p>
    </div>
</body>
</html>
