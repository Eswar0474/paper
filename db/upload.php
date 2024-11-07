<?php
include 'db.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $title = $_POST['title'];
    $file = $_FILES['file'];
    $filePath = 'uploads/' . basename($file['name']);
    
    if (move_uploaded_file($file['tmp_name'], $filePath)) {
        $stmt = $db->prepare("INSERT INTO question_papers (title, file_path, uploaded_by) VALUES (:title, :file_path, :uploaded_by)");
        $stmt->bindValue(':title', $title, SQLITE3_TEXT);
        $stmt->bindValue(':file_path', $filePath, SQLITE3_TEXT);
        $stmt->bindValue(':uploaded_by', $_SESSION['user_id'], SQLITE3_INTEGER);
        $stmt->execute();
        echo "File uploaded successfully!";
    } else {
        echo "File upload failed.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Upload Question Paper</title>
</head>
<body>
    <h2>Upload Question Paper</h2>
    <form method="post" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Title" required><br>
        <input type="file" name="file" required><br>
        <button type="submit">Upload</button>
    </form>
</body>
</html>
