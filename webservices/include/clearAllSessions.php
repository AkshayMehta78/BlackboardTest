<?php
// Initialize the session.
// If you are using session_name("something"), don't forget it now!
session_start();

unset($_SESSION['user']);

// Finally, destroy the session.
session_destroy();
?>