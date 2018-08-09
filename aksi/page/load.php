<?php

$scan = scandir("../../pages");

error_reporting(1);
$t = count($scan);
if($t <= 6) {
	echo "You dont have any page";
}else {
for ($i=2; $i < count($scan); $i++) {
	$c = explode(".", $scan[$i]);
	$tot = count($c);
	$namaPage = $c[$tot - 2];
	if($tot == 1 or $namaPage == "migrate" or $namaPage == "controller" or $namaPage == "page") {

	}else {
		echo '
		<div class="myCtrl">
			<h3 class="ke-kiri"><a href="./'.$namaPage.'" target="_blank">'.$namaPage.'</a></h3>
			<button id="xCtrl" class="ke-kanan" onclick="del(this.value)" value="'.$namaPage.'"><i class="fa fa-close"></i></button>
		</div>
		';
	}
}

}
?>
<script>
	function del(val) {
		pilih("#pageWillDel").value = val
		munculPopup("#delPage")
	}
</script>