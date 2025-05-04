<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Tempo massimo della sessione php
ini_set('session.gc_maxlifetime', 36600);

//Cookie di sessione
session_set_cookie_params(36600);

//Avvio la sessione di php
session_start();

date_default_timezone_set('Europe/Rome');

define('VERSION', '1.2.0');

?>