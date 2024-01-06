<?php
@include 'includes/config.php';
session_start();

if (!isset($_SESSION['admin_name'])) {
    header('location:login_form.php');
}
?>

<?php

@include 'config.php';
session_start();
session_unset();
session_destroy();

header('location:login_form.php');
?>