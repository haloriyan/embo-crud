<?php
include 'aksi/ctrl/controller.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale = 1">
	<title>'Controllers' Controller</title>
	<link href="aset/fw/build/fw.css" rel="stylesheet">
	<link href="aset/fw/build/font-awesome.min.css" rel="stylesheet">
	<link href="aset/css/style.controller.css" rel="stylesheet">
	<script src="aset/js/jquery-3.1.1.js"></script>
</head>
<body>

<div class="atas merah-2">
	<h1 class="judul">Control your controllers</h1>
</div>

<div class="container">
	<div class="wrap">
		<h2>List of your controllers
			<div class="ke-kanan">
				<button id="newCtrl" class="tbl merah-2"><i class="fa fa-plus"></i> &nbsp; New Controller</button>
			</div>
		</h2>
		<div id="listCtrl"></div>
		<div class="rata-tengah" style="margin-top: 35px;">
			<a href='./page'>wanna create page ?</a>
		</div>
	</div>
</div>

<div class="bg"></div>
<div class="popupWrapper" id="formNewCtrl">
	<div class="popup">
		<div class="wrap">
			<h3>New Controller
				<div id="xNew" class="ke-kanan"><i class="fa fa-close"></i></div>
			</h3>
			<form id="formCreateCtrl">
				<input type="text" class="box" placeholder="Controllers name" id="ctrlName">
				<div class="bag-tombol">
					<button class="merah-2">CREATE</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="popupWrapper" id="delCtrl">
	<div class="popup">
		<div class="wrap">
			<h3>Delete controller
				<div id="xDel" class="ke-kanan"><i class="fa fa-close"></i></div>
			</h3>
			<form id="formDelCtrl">
				<input type="hidden" class="box" id="ctrlWillDel">
				<p>
					Sure you want delete this controller?
				</p>
				<div class="bag-tombol">
					<button class="merah-2" id="yaDelCtrl">Yes, delete this!</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script src="aset/js/embo.js"></script>
<script>
	function loadCtrl() {
		$.get("aksi/controller/load.php", function(res) {
			$("#listCtrl").html(res)
		})
	}

	loadCtrl()
	
	klik("#xNew", function() {
		hilangPopup("#formNewCtrl")
	})
	klik("#xDel", function() {
		hilangPopup("#delCtrl")
	})
	klik("#newCtrl", function() {
		munculPopup("#formNewCtrl")
	})

	tekan("Escape", function() {
		hilangPopup("#formNewCtrl")
		hilangPopup("#delCtrl")
	})

	submit("#formCreateCtrl", function() {
		let name = pilih("#ctrlName")
		let crt = "name="+name.value
		if(name == "") {
			return false
		}
		pos("aksi/controller/create.php", crt, function() {
			name.value = ""
			hilangPopup("#formNewCtrl")
			loadCtrl()
		})
		return false
	})
	submit("#formDelCtrl", function() {
		let name = pilih("#ctrlWillDel").value
		let del = "name="+name
		pos("aksi/controller/delete.php", del, function() {
			hilangPopup("#delCtrl")
			loadCtrl()
		})
		return false
	})
</script>
</body>
</html>