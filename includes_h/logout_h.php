<?php

session_start();
session_unset();
session_destroy();

header("location: ../home.php?error=logged_out");
exit();