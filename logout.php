<?php
include($_SERVER["DOCUMENT_ROOT"] . "/projects/klain/app_config.php");
unset($_COOKIE['login_cookies']);
unset($_COOKIE['role_cookies']);
unset($_COOKIE['name_cookies']);
header('Location:'.APP_URL.'login');
?>