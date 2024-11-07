<?php
// db.php
$db = new SQLite3('eswar.db');

$db->exec("CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL,
    is_admin INTEGER DEFAULT 0
)");

$db->exec("CREATE TABLE IF NOT EXISTS question_papers (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title TEXT NOT NULL,
    file_path TEXT NOT NULL,
    uploaded_by INTEGER,
    FOREIGN KEY (uploaded_by) REFERENCES users(id)
)");
?>
