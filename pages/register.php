<!DOCTYPE html>
<html>
<head>
	<meta charset='UTF-8'>
	<meta name='viewport' content='width=device-width, initial-scale = 1'>
	<title>register</title>
	<link href='aset/fw/build/fw.css' rel='stylesheet'>
	<link href='aset/fw/build/font-awesome.min.css' rel='stylesheet'>
	<link href='aset/css/style.register.css' rel='stylesheet'>
</head>
<body>

<div class='wrap'>
	<form id='regist'>
		<input type="text" id='name'>
		<button>Submit</button>
	</form>
</div>

<script src='aset/js/embo.js'></script>

<script>
	submit("#regist", () => {
		let name = pilih("#name").value
		pos("ctrl/user/register", "name="+name, () => {
			alert('registered!')
		})
		return false
	})
</script>

</body>
</html>