<?php

require_once 'functions_h.php';
require_once 'database_handler_h.php';

cookiesRemoveCookie($conn);

session_start();
session_unset();
session_destroy();

header("location: ../home.php?error=logged_out");
exit();
