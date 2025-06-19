<?php
session_start();
require 'config.php';

if (!isset($_SESSION['username'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit;
}

$filename = 'profile_photos/' . $_SESSION['username'] . '.jpg';

if (file_exists($filename)) {
    if (unlink($filename)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to delete file']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'File not found']);
}