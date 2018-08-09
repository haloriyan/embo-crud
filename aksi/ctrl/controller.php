<?php

/*
	* EMBO JS-PHP FRAMEWORK
	* Created by Riyan Satria. Yeah.. just me...
	* (C) 2018
*/

// error_reporting(1);
$inc = include 'database/config.php';
if(!$inc) {
	include '../../database/config.php';
}

function lihat($param) {
	if(!file_exists('./pages/'.$param.'.php')) {
		include './pages/error/404.php';
	}else {
		include './pages/'.$param.".php";
	}
}

class controller {
	public function __construct() {
		$this->koneksi();
	}
	
	public function koneksi() {
		/* You can edit this on /database/config.php */
		global $dbHost,$dbUsername,$dbPassword,$dbName;
		$this->konek = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
	}
	
	/*
		This is a query builder. For usage, check the documentation
	*/
	public function tabel($tbl) {
		global $tabel;
		$tabel = $tbl;
		return $this;
	}
	public function pilih($sel = NULL) {
		global $tabel;
		global $query;
		if($sel == "") {
			$query = "SELECT * FROM ".$tabel;
		}else {
			$query = "SELECT $sel FROM ".$tabel;
		}
		return $this;
	}
	public function hapus() {
		global $tabel;
		global $query;

		$query = "DELETE FROM ".$tabel;
		return $this;
	}
	public function tambah($kolom) {
		global $tabel;
		global $query;

		$query = "INSERT INTO ".$tabel." (";
		$i = 0;
		foreach ($kolom as $key => $value) {
			if($i++ == count($kolom) - 1) {
				$query .= $key;
			}else {
				$query .= $key.", ";
			}
		}
		$query .= ") VALUES (";

		$a = 0;
		foreach ($kolom as $key => $value) {
			if($a++ == count($kolom) - 1) {
				$query .= "'".$value."'";
			}else {
				$query .= "'".$value."', ";
			}
		}

		$query .= ")";
		return $this;
	}
	public function ubah($opt) {
		global $tabel;
		global $query;

		$query = "UPDATE ".$tabel;
		foreach ($opt as $key => $value) {
			$key = $key;
			$val = $value;
		}
		$totKey = count($opt);
		if($totKey == 1) {
			$query .= " SET $key = '".$val."'";
		}else {
			$query .= " SET ";
			foreach ($opt as $key => $value) {
				$query .= $key . " = '".$value."', ";
			}
		}
		return $this;
	}

	public function dimana($opt = NULL, $like = NULL) {
		global $query;
		if($opt == "") {
			$query .= " WHERE 1";
		}else {
			foreach ($opt as $key => $value) {
				$key = $key;
				$val = $value;
			}
			$totKey = count($opt);
			if($totKey == 1) {
				if($like == "") {
					$query .= " WHERE $key = '$val'";
				}else {
					$query .= " WHERE $key LIKE '%$val%'";
				}
			}else {
				$query .= " WHERE ";
				$i = 0;
				foreach ($opt as $key => $value) {
					if($i++ == count($opt) - 1) {
						$and = "";
					}else {
						$and = "AND";
					}
					if($like == "") {
						$query .= $key . " = '" . $value. "' ".$and." ";
					}else {
						$query .= $key . " LIKE '%" . $value. "%' ".$and." ";
					}
				}
			}
		}
		return $this;
	}

	public function urutkan($kolom, $urut) {
		global $query;

		$query .= " ORDER BY ".$kolom." ".$urut;
		return $this;
	}
	public function batas($pos, $bts) {
		global $query;
		$query .= "LIMIT ".$pos.",".$bts;
		return $this;
	}
	
	public function eksekusi() {
		global $query;
		return mysqli_query($this->konek, $query);
		// return $query;
	}
	public function ambil($q) {
		return mysqli_fetch_array($q);
	}
	public function hitung($q) {
		return mysqli_num_rows($q);
	}
	public function query($q) {
		return mysqli_query($this->konek, $q);
	}

	// PLEASE DONT EDIT THIS
	public function new($name) {
		$file = fopen("../ctrl/".$name.".php", "w");
		$y = "<?php
include 'controller.php';

class ".$name." extends controller {
	public function test() {
		return 'Hello embo!';
	}
}

$".$name." = new ".$name."();

?>";
		fwrite($file, $y);
		fclose($file);
	}
	public function remove($name) {
		$del = unlink("../ctrl/".$name.".php");
		return $del;
	}

	public function newPage($name, $generate = NULL) {
		$file = fopen("../../pages/".$name.".php", "w");
		$y = "<!DOCTYPE html>
<html>
<head>
	<meta charset='UTF-8'>
	<meta name='viewport' content='width=device-width, initial-scale = 1'>
	<title>".$name."</title>
	<link href='aset/fw/build/fw.css' rel='stylesheet'>
	<link href='aset/fw/build/font-awesome.min.css' rel='stylesheet'>
	<link href='aset/css/style.".$name.".css' rel='stylesheet'>
</head>
<body>

<div class='wrap'>
	<h2 class='rata-tengah'>".$name."'s page created</h2>
</div>

<script src='aset/js/embo.js'></script>
<script src='aset/js/script.".$name.".js'></script>

</body>
</html>";
		fwrite($file, $y);
		fclose($file);
		if($generate == "1") {
			$css = fopen("../../aset/css/style.".$name.".css", "w");
			fwrite($css, "");
			fclose($css);

			$js = fopen("../../aset/js/script.".$name.".js", "w");
			fwrite($js, "console.log('" . $name . " page created')");
			fclose($js);
		}
	}
	public function removePage($name) {
		$del = unlink("../../pages/".$name.".php");
		$css = unlink("../../aset/css/style.".$name.".css");
		$js = unlink("../../aset/js/script.".$name.".js");
	}

	// gapenting
	public function pos($param) {
		return @$_POST[$param];
	}
	public function dapat($param) {
		return $_GET[$param];
	}
}

$ctrl = new controller();