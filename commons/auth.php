<?php
// Helper functions for admin session checks

function isAdminLoggedIn()
{
    if (session_status() === PHP_SESSION_NONE) session_start();
    return !empty($_SESSION['admin']);
}

function requireAdmin()
{
    if (!isAdminLoggedIn()) {
        header('Location: index.php?act=admin_login');
        exit;
    }
}
