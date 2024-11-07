<?php
include 'db.php';
session_start();
if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_user'])) {
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $is_admin = isset($_POST['is_admin']) ? 1 : 0;

        $stmt = $db->prepare("INSERT INTO users (username, password, is_admin) VALUES (:username, :password, :is_admin)");
        $stmt->bindValue(':username', $username, SQLITE3_TEXT);
        $stmt->bindValue(':password', $password, SQLITE3_TEXT);
        $stmt->bindValue(':is_admin', $is_admin, SQLITE3_INTEGER);
        $stmt->execute();
    } elseif (isset($_POST['delete_user'])) {
        $user_id = $_POST['user_id'];
        $stmt = $db->prepare("DELETE FROM users WHERE id = :id");
        $stmt->bindValue(':id', $user_id, SQLITE3_INTEGER);
        $stmt->execute();
    }
}

$users = $db->query("SELECT * FROM users");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Page</title>
</head>
<body>
    <h2>Admin Management</h2>
    <h3>Add User</h3>
    <form method="post">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <label><input type="checkbox" name="is_admin"> Admin</label><br>
        <button type="submit" name="add_user">Add User</button>
    </form>

    <h3>Delete User</h3>
    <form method="post">
        <select name="user_id">
            <?php while ($user = $users->fetchArray()) { ?>
                <option value="<?= $user['id'] ?>"><?= $user['username'] ?></option>
            <?php } ?>
        </select>
        <button type="submit" name="delete_user">Delete User</button>
    </form>
</body>
</html>
