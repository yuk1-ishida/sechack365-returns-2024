<?php

session_start();

header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method Not Allowed.']);
    exit;
}

// パラメータを取得
if (!isset($_POST['username']) || !isset($_POST['password'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Username and password are required.']);
    exit;
}

$username = $_POST['username'];
$password = $_POST['password'];

$users = [
    'user' => 'password123',
    'admin' => 'adminpass'
];

if (!array_key_exists($username, $users) || $users[$username] !== $password) {
    http_response_code(401);
    echo json_encode(['error' => 'Invalid username or password.']);
    exit;
}

// セッションにユーザー情報を保存
$_SESSION['username'] = $username;
$_SESSION['logged_in'] = true;

http_response_code(200);
echo json_encode([
    'message' => 'Login successful.',
    'session_id' => session_id()
]);
