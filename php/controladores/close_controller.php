<?php
require_once('controller.php');
session_start();
unset($_SESSION['user'], $_SESSION['people'], $_SESSION['data']);
session_destroy();
redirect();