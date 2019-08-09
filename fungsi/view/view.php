<?php
	/*
	 * PROSES TAMPIL  
	 */ 
	 class view {
		protected $db;
		function __construct($db){
			$this->db = $db;
		}
			
			function member(){
				$sql = "select member.*, login.*
						from member inner join login on member.id_member = login.id_member";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetchAll();
				return $hasil;
			}
			function hasilperamalan(){
				$sql = "select * from hasilperamalan";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetchAll();
				return $hasil;
			}
			function ramalandetail($id){
				$sql = "select * from hasilperamalan dp join detail_peramalan p on dp.id_peramalan=p.id_peramalan where dp.id_peramalan=?";
				// echo $sql;
				$row = $this-> db -> prepare($sql);
				$row -> execute(array($id));
				$hasil = $row -> fetchAll();
				return $hasil;
			}
			function member_edit($id){
				$sql = "select member.*, login.*
						from member inner join login on member.id_member = login.id_member
						where member.id_member= ?";
				$row = $this-> db -> prepare($sql);
				$row -> execute(array($id));
				$hasil = $row -> fetch();
				return $hasil;
			}

			function jual_tanggal($tgl_awal, $tgl_akhir){
				$sql = "SELECT detail_penjualan.* , barang.id_barang, barang.nama_barang, member.id_member,
						member.nm_member from detail_penjualan 
					   left join barang on barang.id_barang=detail_penjualan.id_barang 
					   left join member on member.id_member=detail_penjualan.id_member
					   where detail_penjualan.tanggal_input between '$tgl_awal' and '$tgl_akhir'";
					   // echo $sql;
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetchAll();
				return $hasil;
			}


			function toko(){
				$sql = "select*from toko where id_toko='1'";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetch();
				return $hasil;
			}
			function kategori(){
				$sql = "select*from kategori";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetchAll();
				return $hasil;
			}
			function barang(){
				$sql = "select barang.*, kategori.id_kategori, kategori.nama_kategori
						from barang inner join kategori on barang.id_kategori = kategori.id_kategori";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetchAll();
				return $hasil;
			}
			function barang_edit($id){
				$sql = "select barang.*, kategori.id_kategori, kategori.nama_kategori
						from barang inner join kategori on barang.id_kategori = kategori.id_kategori
						where id_barang=?";
				$row = $this-> db -> prepare($sql);
				$row -> execute(array($id));
				$hasil = $row -> fetch();
				return $hasil;
			}
			function edit_bayar($id){
				$sql = "update detail_penjualan set flag_bayar='Y' where id_detail='$id'";
				// echo $sql;
				// exit();
				$row = $this-> db -> prepare($sql);
				$row -> execute(array($id));
				$hasil = $row -> fetch();
				return $hasil;
			}
			function barang_cari($cari){
				$sql = "select barang.*, kategori.id_kategori, kategori.nama_kategori
						from barang inner join kategori on barang.id_kategori = kategori.id_kategori
						where barang.stok > 0 and id_barang like '%$cari%' or nama_barang like '%$cari%' or merk like '%$cari%'";
						// echo $sql;
						// exit();
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetch();
				return $hasil;
			}
			function barang_id(){
				$sql = 'SELECT * FROM barang ORDER BY id_barang DESC';
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetch();
				
				$urut = substr($hasil['id_barang'], 2, 3);
				$tambah = (int) $urut + 1;
				if(strlen($tambah) == 1){
					 $format = 'BR00'.$tambah.'';
				}else if(strlen($tambah) == 2){
					 $format = 'BR0'.$tambah.'';
				}else{
					 $format = 'BR'.$tambah.'';
				}
				return $format;
			}
			function kategori_edit($id){
				$sql = "select*from kategori where id_kategori=?";
				$row = $this-> db -> prepare($sql);
				$row -> execute(array($id));
				$hasil = $row -> fetch();
				return $hasil;
			}
			function kategori_row(){
				$sql = "select*from kategori";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> rowCount();
				return $hasil;
			}
			function peramalan_row(){
				$sql ="SELECT MAX(id_peramalan) as terakhir from hasilperamalan";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetch();
				return $hasil;
			}
			function id_penjualan(){
				$sql ="SELECT MAX(id_penjualan) as id_penjualan from penjualan";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetch();
				return $hasil;
			}
			function barang_row(){
				$sql = "select*from barang";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> rowCount();
				return $hasil;
			}
			function barang_stok_row(){
				$sql ="SELECT SUM(stok) as jml FROM barang";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetch();
				return $hasil;
			}
			function barang_beli_row(){
				$sql ="SELECT SUM(harga_beli) as beli FROM barang";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetch();
				return $hasil;
			}
			function jual_row(){
				$sql ="SELECT SUM(jumlah) as stok FROM detail_penjualan";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetch();
				return $hasil;
			}
			function jual(){
				$sql ="SELECT * from penjualan p join detail_penjualan dp on p.id_penjualan=dp.no_nota 
					   left join barang on barang.id_barang=detail_penjualan.id_barang 
					   left join member on member.id_member=detail_penjualan.id_member
					   ORDER BY dp.id_penjualan DESC LIMIT 4";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetchAll();
				return $hasil;
			}

			function penjualan($no_nota){
				$sql ="SELECT * from penjualan p join detail_penjualan dp on p.id_penjualan=dp.no_nota left join barang on barang.id_barang=dp.id_barang left join member on member.id_member=dp.id_member where dp.no_nota='$no_nota'";
				// echo $sql;
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetchAll();
				return $hasil;
			}
			function penjualan1(){
				$sql ="SELECT * from penjualan p join detail_penjualan dp on p.id_penjualan=dp.no_nota left join barang on barang.id_barang=dp.id_barang left join member on member.id_member=dp.id_member";
				// echo $sql;
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetchAll();
				return $hasil;
			}
			function detail_penjualan(){
				$sql ="SELECT detail_penjualan.* , barang.id_barang, barang.nama_barang, member.id_member,
						member.nm_member from detail_penjualan 
					   left join barang on barang.id_barang=detail_penjualan.id_barang 
					   left join member on member.id_member=detail_penjualan.id_member where detail_Penjualan.flag_bayar='N'
					   ORDER BY detail_penjualan.no_nota";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetchAll();
				return $hasil;
			}
			function jumlah(){
				$sql ="SELECT SUM(total) as bayar FROM detail_penjualan where flag_bayar='N'";
				$row = $this -> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetch();
				return $hasil;
			}
			function jumlah_nota(){
				$sql ="SELECT SUM(total) as bayar FROM detail_penjualan";
				$row = $this -> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetch();
				return $hasil;
			}
			function jml(){
				$sql ="SELECT SUM(harga_beli*stok) as byr FROM barang";
				$row = $this -> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetch();
				return $hasil;
			}
	 }
