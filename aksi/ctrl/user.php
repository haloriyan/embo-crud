<?php
include 'controller.php';

class user extends controller {
	public function test() {
		return 'Hello embo!';
	}
	public function register() {
		$name = $_POST['name'];
		$this->tabel("hotel")->tambah(["nama" => $name])->eksekusi();
	}
	public function hello() {
		return lihat('register');
	}
}

$user = new user();

?>