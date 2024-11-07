<?php
include 'db.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

$papers = $db->query("SELECT * FROM question_papers");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>View Question Papers</title>
</head>
<body>
    <h2>Previous Question Papers</h2>
    <?php while ($paper = $papers->fetchArray()) { ?>
        <p>
            <?= htmlspecialchars($paper['title']) ?> - 
            <a href="<?= htmlspecialchars($paper['file_path']) ?>" download>Download</a>
        </p>
    <?php } ?>
</body>
</html>
