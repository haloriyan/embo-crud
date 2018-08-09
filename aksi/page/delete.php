<?php
include '../ctrl/controller.php';

$name = $_POST['name'];
$ctrl->removePage($name);