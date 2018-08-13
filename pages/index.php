<!DOCTYPE html>
<html>
<head>
	<meta charset='UTF-8'>
	<meta name='viewport' content='width=device-width, initial-scale = 1'>
	<title>User Management</title>
	<link href='../aset/fw/build/fw.css' rel='stylesheet'>
	<link href='../aset/fw/build/font-awesome.min.css' rel='stylesheet'>
	<link href='../aset/css/style.index.css' rel='stylesheet'>
</head>
<body>

<div class='wrap'>
	<h1>User Management System
		<button class='ke-kanan tbl merah-2' id='new'><i class='fa fa-plus'></i> &nbsp; User</button>
	</h1>
	<div id='load' style='margin-top: 55px;'></div>
</div>

<div class='bg'></div>
<div class='popupWrapper' id='bagAdd'>
	<div class='popup'>
		<div class='wrap'>
			<h3>Add User
				<div class='ke-kanan' id='xAdd'><i class='fa fa-close'></i></div>
			</h3>
			<form id='formAdd'>
				<div>Name :</div>
				<input type="text" id='name' class='box'>
				<div>Address :</div>
				<textarea id="address" class='box'></textarea>
				<div class='bag-tombol'>
					<button class='merah-2'>Add</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class='popupWrapper' id='successAdd'>
	<div class='popup'>
		<div class='wrap'>
			<h3><i class='fa fa-info'></i> Alert!
				<div class='ke-kanan' id='xSuccess'><i class='fa fa-close'></i></div>
			</h3>
			<p>
				User was added!
			</p>
		</div>
	</div>
</div>

<script src='../aset/js/embo.js'></script>
<script src='../aset/js/script.index.js'></script>

</body>
</html>