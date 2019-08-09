
<?php 
	require '../../config.php';
	require '../../koneksi.php';

	if(!empty($_GET['kategori'])){
		$nama= $_POST['kategori'];
		$tgl= date("j F Y, G:i");
		$data[] = $nama;
		$data[] = $tgl;
		$sql = 'INSERT INTO kategori (nama_kategori,tgl_input) VALUES(?,?)';
		$row = $config -> prepare($sql);
		$row -> execute($data);
		echo '<script>window.location="../../index.php?page=kategori&&success=tambah-data"</script>';
	}
	if(!empty($_GET['peramalan'])){
		// echo "<pre>";
		// print_r($_POST);
		// echo "</pre>";
		// exit();

		$tgl_awal = $_POST['tgl_awal'];
		$tgl_akhir = $_POST['tgl_akhir'];
		$pergerakan = $_POST['pergerakan'];
		$mse = $_POST['mse'];
		$mad = $_POST['mad'];
		$mape = $_POST['mape'];
		$hasil_peramalan = $_POST['hasil_peramalan'];
		$bulan = $_POST['bulan'];
		$tahun = $_POST['tahun'];
		$penjualan = $_POST['penjualan'];
		$prediksi_penjualan = $_POST['prediksi_penjualan'];
		$eror = $_POST['eror'];
		$erorpos = $_POST['erorpos'];
		$erorpangkat = $_POST['erorpangkat'];
		$presentasieror = $_POST['presentasieror'];
		$id_peramalan = $_POST['id_peramalan'];
		$nama_barang = $_POST['nama_barang'];
		$kasir = $_POST['kasir'];



		$sql = "INSERT INTO hasilperamalan VALUES (null, '$tgl_awal','$tgl_akhir','$pergerakan','$mse','$mad','$mape','$hasil_peramalan','$nama_barang','$kasir') ";
		$config->exec($sql);
		// echo $sql;
		// $a=mysqli_query($link,$sql);
		// $row = $config -> prepare($sql);
		// $row -> execute($data);



		$jum = count($bulan);
 
for($x=0;$x<$jum;$x++){
	$query="INSERT INTO detail_peramalan values(null,'$id_peramalan','$bulan[$x]','$tahun[$x]','$penjualan[$x]','$prediksi_penjualan[$x]','$eror[$x]','$erorpos[$x]','$erorpangkat[$x]','$presentasieror[$x]')";
		$config->exec($query);
	
	// echo $query;
		// $b=mysqli_query($link,$query);

}


		echo '<script>window.location="../../index.php?page=peramalan&success=tambah-data"</script>';
	}
	if(!empty($_GET['barang'])){
		$id = $_POST['id'];
		$kategori = $_POST['kategori'];
		$nama = $_POST['nama'];
		$merk = $_POST['merk'];
		$beli = $_POST['beli'];
		$jual = $_POST['jual'];
		$satuan = $_POST['satuan'];
		$stok = $_POST['stok'];
		$tgl = $_POST['tgl'];
		
		$data[] = $id;
		$data[] = $kategori;
		$data[] = $nama;
		$data[] = $merk;
		$data[] = $beli;
		$data[] = $jual;
		$data[] = $satuan;
		$data[] = $stok;
		$data[] = $tgl;
		$sql = 'INSERT INTO barang (id_barang,id_kategori,nama_barang,merk,harga_beli,harga_jual,satuan_barang,stok,tgl_input) 
			    VALUES (?,?,?,?,?,?,?,?,?) ';
		$row = $config -> prepare($sql);
		$row -> execute($data);
		echo '<script>window.location="../../index.php?page=barang&success=tambah-data"</script>';
	}
	if(!empty($_GET['jual'])){
		$no_nota = $_POST['no_nota'];
		$total = $_POST['total'];
		$tgl = $_POST['tgl'];
		

		$sql1 = "INSERT INTO penjualan (id_penjualan,total,tanggal_input) VALUES ('$no_nota','$total','$tgl')";
		$row1 = $config -> prepare($sql1);
		$row1 -> execute($data1);
		// echo '<script>window.location="../../index.php?page=jual&success=tambah-data"</script>';
	}

	if(!empty($_GET['detail_jual'])){
		$no_nota=$_POST['no_nota'];
		$id = $_POST['id'];
		$kasir = $_POST['kasir'];
		$jumlah = '0';
		$total = '0';
		$tgl = $_POST['tgl'];

		$data1[] = $no_nota;
		$data1[] = $id;
		$data1[] = $kasir;
		$data1[] = $jumlah;
		$data1[] = $total;
		$data1[] = $tgl;
		$sql1 = "INSERT INTO detail_penjualan (no_nota,id_barang,id_member,jumlah,total,tanggal_input) VALUES ('$no_nota','$id','$kasir','$jumlah','$total','$tgl')";
		// echo "<pre>";
		// print_r($_POST);
		// echo "</pre>";

		// echo $sql1;
		// exit();
		$row1 = $config -> prepare($sql1);
		$row1 -> execute($data1);
		echo '<script>window.location="../../index.php?page=jual&success=tambah-data"</script>';
	}



	if(!empty($_GET['nota'])){
		$id = $_POST['id'];
		$kasir = $_POST['kasir'];
		$jumlah = $_POST['jumlah'];
		$total = $_POST['total'];
		$tgl = $_POST['tgl'];
		
		$data1[] = $id;
		$data1[] = $kasir;
		$data1[] = $jumlah;
		$data1[] = $total;
		$data1[] = $tgl;
		$sql1 = 'INSERT INTO nota (id_barang,id_member,jumlah,total,tanggal_input) VALUES (?,?,?,?,?)';
		$row1 = $config -> prepare($sql1);
		$row1 -> execute($data1);
		echo '<script>window.location="../../index.php?page=jual&success=tambah-data"</script>';
	}
?>

