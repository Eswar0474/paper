<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard</title>
</head>
<body>
    <h2>Welcome to the Dashboard</h2>
    <a href="upload.php">Upload Question Paper</a><br>
    <a href="view_questions.php">View Question Papers</a><br>
    <?php if ($_SESSION['is_admin']) { echo '<a href="admin.php">Admin Page</a><br>'; } ?>
    <a href="logout.php">Logout</a>
</body>
</html>
