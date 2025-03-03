<?php
$host = "localhost";
$dbname = "mcpelee";
$username = "mcpelee";
$password = "googsu!2#";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    die("데이터베이스 연결 실패: " . $e->getMessage());
}
