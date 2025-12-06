<?php require_once "../includes/headers/admin_header.php"; requireAdmin(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
</head>
<body>
<div class="container">
    <h1>Generate Reports</h1>
    
    <div class="card">
        <h2>Inventory Report</h2>
        <a href="../includes/functions/generate_report.php" target="_blank">
            <button>Generate Report</button>
        </a>
    </div>
</div>

<?php require_once "../includes/footer.php"; ?>
</body>