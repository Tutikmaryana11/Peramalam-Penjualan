<?php 
	require 'config.php';
	include $view;
	$lihat = new view($config);
	$toko = $lihat -> toko();
	// $no_nota=$_POST['no_nota'];
	
	

	$no = $lihat -> id_penjualan();  

	// echo "<pre>";
	// print_r($_POST);
	// echo "</pre>";
$a = $lihat -> id_penjualan();


		$no_nota = $a['id_penjualan']+1;

		$total = $_POST['total'];
		$bayar = $_POST['bayar'];
		$kembali = $_POST['kembali'];
		$link = mysqli_connect("localhost", "root", "","db_toko");

		$sql1 = "INSERT INTO penjualan (id_penjualan,total) VALUES ('$no_nota','$total')";
		// echo $sql1;
		$c=mysqli_query($link,$sql1);

$hsl = $lihat -> penjualan($no_nota);
		// $tgl = cu;
		
		
		// $row1 = $config -> prepare($sql1);


?>
<html>
	<head>
		<title>print</title>
		<link rel="stylesheet" href="assets/css/bootstrap.css">
	</head>
	<body>
		<script>window.print();</script>
		<div class="container-fluid">
			<p>VIJETOYS</p>
			<p>Pedan, Klaten</p>
			<p>Tanggal&nbsp;&nbsp;&nbsp;: <?php  echo date("j F Y, G:i");?></p>
			<!-- <p>Kasir &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	    : <?php  echo $_GET['nm_member'];?></p> -->
			<table class="table table-bordered" style="width:20%;font-size:13px;">
				<tr>
					<td>No.</td>
					<td>Barang</td>
					<td>Jumlah</td>
					<td>Total</td>
				</tr>
				
				<?php
				$total=0;
				 $no=1; foreach($hsl as $isi){
// $id=$isi['id_detail']+1;
	// $a = $lihat -> edit_bayar($id);
					?>

				<tr>
					<td><?php echo $no;?></td>
					<td><?php echo $isi['nama_barang'];?></td>
					<td><?php echo $isi['jumlah'];?></td>
					<td><?php echo $isi['total'];?></td>
				</tr>
				<?php $no++; 

				$total=$total+$isi['total'];}
				?>
			</table>
			<p>Kasir &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	    : <?php  echo $isi['nm_member'];?></p>
			<?php $hasil = $lihat -> jumlah(); ?>
			Total&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : Rp.<?php echo number_format($total);?>,-
			<br/>
			Bayar&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : Rp.<?php echo number_format($bayar);?>,-
			<br/>
			Kembali&nbsp; : Rp.<?php echo number_format($kembali);?>,-
		</div>
		<a href="index.php?page=jual">Kembali</button></a>
		

	</body>
</html>
