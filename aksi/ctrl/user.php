<?php
include 'controller.php';

class user extends controller {
	public function info($u, $kolom) {
		$q = $this->tabel("user")->pilih($kolom)->dimana(["username" => $u])->eksekusi();
		$r = $this->ambil($q);
		return $r[$kolom];
	}

	public function index() {
		return lihat('index');
	}
	public function add() {
		$name 		= $this->pos("name");
		$address 	= $this->pos("address");

		$add = $this->tabel("user")
				 	->tambah([
						 "iduser" => rand(1, 99999),
						 "name" => $name,
						 "address" => $address,
						 "registered" => time()
					 ])->eksekusi();
		return $add;
	}
	public function delete() {
		$id = $this->pos("iduser");
		$del = $this->tabel("user")->hapus()->dimana(["iduser" => $id])->eksekusi();
		return $del;
	}
	public function load() {
		$q = $this->tabel("user")->pilih()->eksekusi();
		if($this->hitung($q) == 0) {
			echo "<h3>Tidak ada user</h3>";
		}else {
			?>
			<table>
				<thead>
					<tr>
						<th>Name</th>
						<th>Address</th>
						<th style='width: 15%'>Act</th>
					</tr>
				</thead>
				<tbody>
				<?php
				while($r = $this->ambil($q)) {
					echo "<tr>".
							"<td>".$r['name']."</td>".
							"<td>".$r['address']."</td>".
							"<td><button class='tbl merah-2' onclick='del(this.value)' value='".$r['iduser']."'><i class='fa fa-trash'></i></button></td>".
						"</tr>";
				}
				?>
				</tbody>
			</table>
			<?php
		}
	}
}

$user = new user();

?>