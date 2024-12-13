<?php

if (!isset($_SESSION['username'])) {
    header('Content-Type: application/json');
    http_response_code(401);
    echo (string)json_encode(['error' => 'Unauthorized']);
    exit;
}
