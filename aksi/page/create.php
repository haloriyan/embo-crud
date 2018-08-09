<?php
include '../ctrl/controller.php';

$name = $_POST['name'];
$generate = $_POST['generate'];

$ctrl->newPage($name, $generate);