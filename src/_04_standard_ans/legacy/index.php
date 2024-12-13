<?php

session_start();

require __DIR__ . '/auth-middleware.php';

echo 'Welcome ' . $_SESSION['username'] . PHP_EOL;
