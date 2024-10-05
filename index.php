<?php
define('PROTECT','agenda19');

require_once 'config.php';
require_once 'engine/errors.php';
require_once 'engine/db.php';
require_once 'engine/start.php';
require_once 'engine/content.php';
require_once 'engine/decode.php';
require_once 'engine/links.php';

// Errors
Errors::Display();

// Set sessions
Start::Initialize();

// Path
$path = AppConfig::Path();
$lett = $path[0];
$opt1 = $path[1];
$opt2 = $path[2];
$opt3 = $path[3];
$opt4 = $path[4];

// Content output
$content = new Content();

$decode = new Decode;
echo $decode->Output();

?>