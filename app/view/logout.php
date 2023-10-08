<?php
session_start();
// Clear all session data
session_unset(); // Unset all session variables
session_destroy(); // Destroy the session

echo '<script>window.location.href = "app/view/authpage.php";</script>';
exit; // Make sure to exit after redirecting
?>