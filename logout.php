<?php
session_start();

// Hapus semua data session
session_unset();

// Hapus session data yang disimpan di server
session_destroy();

// Redirect ke halaman login
header("location: login.php");
exit();
?>

