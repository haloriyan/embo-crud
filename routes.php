<?php

// error_reporting(1);
$role = $_GET['role'];
$bag = $_GET['bag'];

/* lama
// pake controller
$control = $role;
$controller = "aksi/ctrl/".$control;
$fungsi = $_GET['bag'];
include $controller.'.php';
$$control->$fungsi();
*/


if($role == "" and $bag == "") {
	include 'index.php';
}else if($role == "") {
	$lokasi = 'pages/'.$bag.'.php';
	if(file_exists($lokasi)) {
		include $lokasi;
	}else {
		header("location: ./error/404");
	}
}else if($bag == "") {
	$lokasi = 'pages/'.$role.'/dasbor.php';
	if(file_exists($lokasi)) {
		include $lokasi;
	}else {
		$lokasi = 'pages/'.$role.'/index.php';
		if(file_exists($lokasi)) {
			include $lokasi;
		}else {
			header("location: ../error/404");
		}
	}
}else {
	$lokasi = 'pages/'.$role.'/'.$bag.'.php';
	if(file_exists($lokasi)) {
		include $lokasi;
	}else {
		$control = $role;
		$controller = "aksi/ctrl/".$control;
		$fungsi = $_GET['bag'];
		include $controller.'.php';
		$$control->$fungsi();
		// header("location: ../error/404");
	}
}