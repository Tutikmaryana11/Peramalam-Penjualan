<?php 
	require 'config.php';
	include $view;
	$lihat = new view($config);
	// $toko = $lihat -> toko();
	// $hsl = $lihat -> penjualan();
	// $id = $_GET['barang'];
	
	$tgl_awal=$_POST['tanggal_awal'];
	$tgl_akhir=$_POST['tanggal_akhir'];
	// $hasil = $lihat -> jual_tanggal($tgl_awal,$tgl_akhir);

	// echo $tgl_awal;
?>
<html>
	<head>
		<title>print</title>
		<link rel="stylesheet" href="assets/css/bootstrap.css">
	</head>
	<body>
		<script>window.print();</script>
		<div class="container-fluid">
			<br><br>
			<p align="center">Laporan Penjualan VIJETOYS</p>
			<p align="center">Pedan, Klaten</p>
			<p>Tanggal Awal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php  echo $tgl_awal;?></p>
			<p>Tanggal Akhir &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	    : <?php echo $tgl_akhir; ?></p>
			<table class="table table-bordered" align="center">
				<tr>
					<td> No</td>
										<td> ID Barang</td>
										<td> Nama Barang</td>
										<td style="width:10%;"> Jumlah</td>
										<td style="width:20%;"> Total</td>
										<td> Kasir</td>
										<td> Tanggal Input</td>
				</tr>
				
				<?php $no=1; 
				$total_semua=0;
				$hasil = $lihat -> jual_tanggal($tgl_awal,$tgl_akhir);
				// var_dump($hasil);
				// exit();
				// echo $hasil;
				?>

				<?php foreach($hasil as $isi){ ?>
				<tr>
					<td><?php echo $no;?></td>
										<td><?php echo $isi['id_barang'];?></td>
										<td><?php echo $isi['nama_barang'];?></td>
										<td><?php echo $isi['jumlah'];?> </td>
										<td>Rp.<?php echo number_format($isi['total']);?>,-</td>
										<td><?php echo $isi['nm_member'];?></td>
										<td><?php echo $isi['tanggal_input'];?></td>
				</tr>
				<?php $no++; 
				$total_semua=$total_semua+$isi['total'];;


			}?>
			</table>
			<!-- <?php $hasil = $lihat -> jumlah(); ?> -->
			Total&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : Rp.<?php echo $total_semua;?>,-
			<br/>
			
		</div>
	</body>
</html>
