<?php

$scan = scandir("../ctrl");
$tot = count($scan);

if($tot <= 3) {
	echo "You dont have any controller";
}else {

for ($i=2; $i < count($scan); $i++) {
	$c = explode(".", $scan[$i]);
	$namaCtrl = $c[count($c) - 2];
	if($namaCtrl == "controller") {
		//
	}else {
		echo '
		<div class="myCtrl">
			<h3 class="ke-kiri">'.$namaCtrl.'</h3>
			<button id="xCtrl" class="ke-kanan" onclick="del(this.value)" value="'.$namaCtrl.'"><i class="fa fa-close"></i></button>
		</div>
		';
	}
}
}

?>
<script>
	function del(val) {
		pilih("#ctrlWillDel").value = val
		munculPopup("#delCtrl")
	}
</script>