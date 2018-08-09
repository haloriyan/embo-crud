<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale = 1">
	<title>Pages</title>
	<link href="aset/fw/build/fw.css" rel="stylesheet">
	<link href="aset/fw/build/font-awesome.min.css" rel="stylesheet">
	<link href="aset/css/style.controller.css" rel="stylesheet">
	<script src="aset/js/jquery-3.1.1.js"></script>
</head>
<body>

<div class="atas merah-2">
	<h1 class="judul">Control your pages</h1>
</div>

<div class="container">
	<div class="wrap">
		<h2>List of your pages
			<div class="ke-kanan">
				<button id="newPage" class="tbl merah-2"><i class="fa fa-plus"></i> &nbsp; New Page</button>
			</div>
		</h2>
		<div id="listPage"></div>
		<div class="rata-tengah" style="margin-top: 35px;">
			<a href='./controller'>wanna create controller ?</a>
		</div>
	</div>
</div>

<div class="bg"></div>
<div class="popupWrapper" id="createPage">
	<div class="popup">
		<div class="wrap">
			<h3>Create new page
				<div id="xCreate" class="ke-kanan"><i class="fa fa-close"></i></div>
			</h3>
			<form id="formCreate">
				<input type="text" class="box" id="pageName" placeholder="Page name">
				<input type="checkbox" id="generate" data="1" checked="checked" onchange="check()"> <label for="generate">generate css and js file?</label>
				<div class="bag-tombol">
					<button class="merah-2" id="create">CREATE</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="popupWrapper" id="delPage">
	<div class="popup">
		<div class="wrap">
			<h3>Delete page</h3>
			<form id="formDelPage">
				<input type="hidden" id="pageWillDel">
				<p>
					Sure you want delete this page?
				</p>
				<div class="bag-tombol">
					<button class="merah-2" id="yaDelPage">Yes, delete this!</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script src="aset/js/embo.js"></script>
<script>
	function load() {
		$.get("aksi/page/load.php", function(res) {
			$("#listPage").html(res)
		})
	}
	load()

	function check() {
		let checkBox = pilih("#generate")
		if(checkBox.checked) {
			checkBox.setAttribute("data", "1")
		}else {
			checkBox.setAttribute("data", "0")
		}
	}

	klik("#newPage", function() {
		munculPopup("#createPage")
	})
	klik("#xCreate", function() {
		hilangPopup("#createPage")
	})
	tekan("Escape", function() {
		hilangPopup("#createPage")
	})

	submit("#formCreate", function() {
		let name = pilih("#pageName")
		let generate = pilih("#generate").getAttribute("data")
		let crt = "name="+name.value+"&generate="+generate
		if(name == "") {
			return false
		}
		pos("aksi/page/create.php", crt, function() {
			name.value = ""
			hilangPopup("#createPage")
			load()
		})
		return false
	})
	submit("#formDelPage", function() {
		let name = pilih("#pageWillDel").value
		let del = "name="+name
		pos("aksi/page/delete.php", del, function() {
			hilangPopup("#delPage")
			load()
		})
		return false
	})

</script>
</body>
</html>