<?php
include 'database/config.php';

$get = file_get_contents("database/migration.json");
$db = json_decode($get, true);

$namaDb = $dbName;

$conn = mysqli_connect($dbHost, $dbUsername, $dbPassword);

// cek

$cek = mysqli_connect($dbHost, $dbUsername, $dbPassword, $namaDb);
if($cek) {
	$drop = mysqli_query($conn, "DROP DATABASE ".$namaDb);
}else {
foreach ($db['tabel'] as $key => $value) {
	$namaTabel= $key;
	$queryDatabase = "CREATE DATABASE ".$namaDb;

	$queryTable = "CREATE TABLE ".$namaTabel." (";
	foreach ($value as $q => $val) {
		$hai = explode(" ", $val);
		$struktur = $hai[0];
		$tipe = $hai[1];
		$queryTable .= $struktur." ".$tipe." not null,";
	}
	$queryTable .= " dummy int(1) not null);";
	$createDb = mysqli_query($conn, $queryDatabase);
	$conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $namaDb);
	$createTable = mysqli_query($conn, $queryTable);
	$delDummy = mysqli_query($conn, "ALTER TABLE ".$namaTabel." DROP dummy");
}

foreach ($db['atribut'] as $key => $value) {
	foreach ($value as $kunci => $isi) {
		$t = explode(".", $isi);
		$tabel = $t[0];
		$struktur = $t[1];
		$queryAttr = "ALTER TABLE ".$tabel." ADD ".$key. "( ".$struktur." )";
		mysqli_query($conn, $queryAttr);
	}
}

echo "SUCCESS!!!";
}