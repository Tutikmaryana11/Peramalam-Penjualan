 <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <div class="bg-shadow" style="background:rgba(0,0,0,0.3);z-index:99999;position:fixed;width:100%;height:6000px;"></div>
      <section id="main-content">
          <section class="wrapper">

              <div class="row">
                  <div class="col-lg-12 main-chart">
						<h3>Data Barang</h3>
						<?php if(isset($_GET['success-stok'])){?>
						<div class="alert alert-success">
							<p>Tambah Stok Berhasil !</p>
						</div>
						<?php }?>
						<?php if(isset($_GET['success'])){?>
						<div class="alert alert-success">
							<p>Tambah Data Berhasil !</p>
						</div>
						<?php }?>
						<?php if(isset($_GET['remove'])){?>
						<div class="alert alert-danger">
							<p>Hapus Data Berhasil !</p>
						</div>
						<?php }?>
						<form  action="" method="POST">
					Tanggal Awal&nbsp;&nbsp;&nbsp;&nbsp;<input type="date" name="tgl_awal"> &nbsp;&nbsp;&nbsp;&nbsp;Tanggal Akhir &nbsp;&nbsp;&nbsp;&nbsp;<input type="date" name="tgl_akhir">&nbsp;&nbsp;&nbsp;&nbsp;Pergerakan &nbsp;&nbsp;&nbsp;&nbsp;
					
					<select name="pergerakan">
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>

					</select>&nbsp;&nbsp;&nbsp;&nbsp; Nama Barang &nbsp;&nbsp;&nbsp;&nbsp; 
					<select name="kategori">
						<?php
			// include "koneksi.php";
						$con = mysqli_connect("localhost","root","","db_toko");
           
						$result = mysqli_query($con,"SELECT * FROM barang ORDER BY nama_barang");
						while($row = mysqli_fetch_assoc($result))
						{
							echo "<option value=$row[id_barang]>$row[nama_barang]</option>";

						} 
						?>
					</select>&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="submit" name="submit" value="Hasil Peramalan" class="btn btn-primary">
				</form><br><br>
				<?php
				$cari = $_POST['submit'];
				if($cari) {
					$tgl_awal=$_POST['tgl_awal'];
					$tgl_akhir=$_POST['tgl_akhir'];
					$pergerakan=$_POST['pergerakan'];
					// print_r($_POST);
					?>
					<div class="modal-view">
            <form method="POST" action="fungsi/tambah/tambah.php?peramalan=tambah">
						<table class="table table-bordered" id="example1">
              
							<tr style="background:#DFF0D8;color:#333;">
								<th>Tanggal Awal</th>
								<td style="border-style:none"><input type="text" name="tgl_awal" value="<?php echo $tgl_awal; ?>" readonly></td>
								<td style="background:white;color:#333;"><font color="white"> gfhfdhfdhfdhdfmvnbvnbvnbvvnbvnbvnbvnbvbnvnnbvnbvnbvnbvbnv</font></td>
							</tr>
							<tr style="background:#DFF0D8;color:#333;">
								<td>Tanggal Akhir</td>
								<td><input type="text" name="tgl_akhir" value="<?php echo $tgl_akhir; ?>" readonly>
                </td>
							</tr>
							<tr style="background:#DFF0D8;color:#333;">
								<td>Pergerakan</td>
								<td><input type="text" name="pergerakan" value="<?php echo $pergerakan; ?>" readonly></td>
							</tr>
          <?php $idakhir = $lihat -> peramalan_row();?>

              <tr style="background:#DFF0D8;color:#333;">
                <td>Nomor Peramalan</td>
                <td><input type="text" name="id_peramalan" value="<?php echo $idakhir['terakhir']+1 ; ?>" readonly></td>
              </tr>

						</table><br><br>
						<table>
							
						</table>
						<br/>
						<!-- view barang -->	
						<div class="modal-view">
						<table class="table table-bordered" id="example1">
							<thead>
								<tr style="background:#DFF0D8;color:#333;">
									<!-- <th>ID Data</th> -->
									<th>Nama Barang</th>
									<th>Bulan</th>
									<th>Tahun</th>
									<th>Penjualan</th>
									<th>Prediksi Penjualan</th>
									<td>Eror</td>
									<td>|Error|</td>
									<td>|Error|^</td>
									<td>% Eror</td>
								</tr>
							</thead>
							<tbody>
								<?php 
								$tgl_awal=$_POST['tgl_awal'];
								$tgl_akhir=$_POST['tgl_akhir'];
								$pergerakan=$_POST['pergerakan'];
								$kategori=$_POST['kategori'];
								$jumeror=0;
								$jumperamalan=0;
								$jumerorpos=0;
								$jumerorpangkat=0;
								$jumperseneror=0;
								$jumprediksi=0;
								$jumpenjualan=0;

								// echo "Pergerakan :"; echo $pergerakan; echo "<br>";
								$link = mysqli_connect("localhost", "root", "","db_toko");
								$sql =  "SELECT month(tanggal_input) as bulan , year(tanggal_input) as tahun , sum(jumlah) as stok , barang.nama_barang from detail_penjualan JOIN barang on detail_penjualan.id_barang=barang.id_barang JOIN kategori on barang.id_kategori=kategori.id_kategori WHERE barang.id_barang='$kategori' and tanggal_input BETWEEN '$tgl_awal' and '$tgl_akhir' GROUP by bulan, tahun, barang.nama_barang order by tahun asc, bulan asc";
								$hasil=mysqli_query($link,$sql);
									// tampilkan query
								// echo $sql;
								if($hasil){
									$prediksi_kategori = ''; 
									$prediksi_bulan = '';
									$prediksi_tahun = '';
									$pred = [];
									$actual = [];
									$ordo = $pergerakan;
									for ($i = 0; $i < $ordo; $i++) {
              $stok_before[$i] = 0; //i = 0; 0 < 3 inisialisasi sebanyak ordo jumlah 3 array index 0,1,2 
          } 

          $count = 0;
            while($data = mysqli_fetch_assoc($hasil)){//rumus nya 
              $count++; //data di looping yg data terjual 
            if ($count >= $ordo+1) { //dimulai data ke 4
            	$PrediksiStok = (array_sum($stok_before))/$ordo;

            } else {
              $PrediksiStok = 0; //dimulai dari data ke 4 sebelum data ke empat dibuat 0
          } 
             for ($i = 0; $i < $ordo-1; $i++) { //i = 0; 0 < 2 karena 2 data yaitu index 0 dan index 1 jadi penjelasan bawah ini 
              $stok_before[$i] = $stok_before[$i+1]; //[0] = data [1], [1] = data [2]
              //looping terus

          }
              $stok_before[$ordo-1] = (int)$data['stok'];// [2] = data 3, kalau di looping lagi (int)$data['stok']; bakalan jadi dat ke 4 dan seterus nya 

              $pred['value'][] = $PrediksiStok;
              $actual[] = (int)$data['stok'];
              $prediksi_kategori = $data['id_barang'];
              $prediksi_bulan = $data['bulan'];
              $prediksi_tahun = $data['tahun'];

            $pred['label'][] = substr($prediksi_bulan, 0, 3) . ' \'' . substr($prediksi_tahun, 2); //substr => buat ambil berapa karakter


            ?>
            <tr>
            	<!-- <td><?php echo $no; ?></td> -->
            	<td><input type="text" name="nama_barang" value="<?php echo $data['nama_barang'] ?>" size="20" readonly ></td>
              <?php
              $bulan=$data['bulan'];
              if ($bulan==1) {
                $a="Januari";
              }elseif ($bulan==2) {
                $a="Februari";
              }
              elseif ($bulan==3) {
                $a="Maret";
              }elseif ($bulan==4) {
                $a="April";
              }elseif ($bulan==5) {
                $a="Mei";
              }elseif ($bulan==6) {
                $a="Juni";
              }elseif ($bulan==7) {
                $a="Juli";
              }elseif ($bulan==8) {
                $a="Agustus";
              }elseif ($bulan==9) {
                $a="September";
              }elseif ($bulan==10) {
                $a="Oktober";
              }elseif ($bulan==11) {
                $a="November";
              }elseif ($bulan==12) {
                $a="Desember";
              }
              else{
                $a="Bulan salah";
              }
              ?>
            	<td><input type="text" name="bulan[]" value="<?php echo $a ?>" size="15" readonly></td>
            	<td><input type="text" name="tahun[]" value="<?php echo $data['tahun'] ?>" size="7" readonly></td>
            	<td><input type="text" name="penjualan[]" value="<?php echo $data['stok'] ?>"  size="7" readonly></td>
            	<?php $jumpenjualan=$jumpenjualan+$data['stok'];  ?>
            	<td><input type="text" name="prediksi_penjualan[]" value="<?php echo $PrediksiStok ?>" size="7" readonly></td>
            	<td><?php 
                    if ($count >= $ordo+1) { //dimulai data ke 4
                    	$eror =($data['stok'])-$PrediksiStok;

                    } else {
              $eror = 0; //dimulai dari data ke 4 sebelum data ke empat dibuat 0
          } 

           ?><input type="text" name="eror[]" value="<?php echo $eror ?>" size="7" readonly></td>
          <td><?php 
                    if ($count >= $ordo+1) { //dimulai data ke 4
                    	$erorpos =abs($eror);


                    } else {
              $erorpos = 0; //dimulai dari data ke 4 sebelum data ke empat dibuat 0
          } 

           ?> <input type="text" name="erorpos[]" value="<?php echo $erorpos ?>" size="7" readonly></td>
           <input type="hidden" value="<?php echo $_SESSION['admin']['id_member'];?>" name="kasir">
          <td><?php 
          if ($count >= $ordo+1) { //dimulai data ke 4
          	$erorpangkat =pow($eror,2);

          } else {
              $erorpangkat = 0; //dimulai dari data ke 4 sebelum data ke empat dibuat 0
          } 

          ?> <input type="text" name="erorpangkat[]" value="<?php echo $erorpangkat  ?>" size="7" readonly></td>
          <td><?php 

          if ($count >= $ordo+1) { //dimulai data ke 4
          	$presentasieror =$erorpos*100/$data['stok'];

          } else {
              $presentasieror = 0; //dimulai dari data ke 4 sebelum data ke empat dibuat 0
          } 

           ?> <input type="text" name="presentasieror[]" value="<?php echo $presentasieror ?>" size="7" readonly></td>
          </tr>
          <?php $no++; 

                    	$jumprediksi=$jumprediksi+$PrediksiStok;
                    	$jumeror=$jumeror+$eror;
                    	$jumerorpos=$jumerorpos+$erorpos;
                    	$jumerorpangkat=$jumerorpangkat+$erorpangkat;
                    	$jumperseneror=$jumperseneror+$presentasieror;
      }
      $total_record = mysqli_num_rows(mysqli_query($link,$sql));
      if($total_record<=$ordo){
      	echo "Data tidak mencukupi";
      } else {

      	?>

      	<tr>
      		<td>Hasil Peramalan</td>

      		<td><?php 
      		$next_month = '';
      		if ($prediksi_bulan == '1') {
      			$next_month = 'Februari';

      		} else if ($prediksi_bulan == '2') {
      			$next_month = 'Maret';

      		} else if ($prediksi_bulan == '3') {
      			$next_month = 'April';

      		} else if ($prediksi_bulan == '4') {
      			$next_month = 'Mei';

      		} else if ($prediksi_bulan == '5') {
      			$next_month = 'Juni'; 
      		} else if ($prediksi_bulan == '6') {
      			$next_month = 'Juli'; 
      		} else if ($prediksi_bulan == '7') {
      			$next_month = 'Agustus';
      		} else if ($prediksi_bulan == '8') {
      			$next_month = 'September'; 
      		} else if ($prediksi_bulan == '9') {
      			$next_month = 'Oktober'; 
      		} else if ($prediksi_bulan == '10') {
      			$next_month = 'November';
      		} else if ($prediksi_bulan == '11') {
      			$next_month = 'Desember';   
      		} else if ($prediksi_bulan == '12') {
      			$next_month = 'Januari';
      		}
      		echo $next_month;
      		?></td>

      		<td><?php 
      		$next_year = '';
      		if ($prediksi_bulan == "Desember") {
      			$next_year = $prediksi_tahun+1;
      		} else {
      			$next_year = $prediksi_tahun;
      		}
      		echo $next_year;
      		?></td>
      		<td><?php 
      		echo (array_sum($stok_before))/$ordo; 
      		?></td>
      		<?php 
      		$MSE=$jumerorpangkat/($count-$ordo);
      		$MAD=$jumerorpos/($count-$ordo);

      		?>
      		<td><?php echo $jumprediksi;?></td>
      		<td><?php echo $jumeror;?></td>
      		<td><?php echo $jumerorpos;?></td>
      		<td><?php echo $jumerorpangkat;?></td>
      		<td><?php echo $jumperseneror;?></td>
      	</tr>
      	<tr>
      		<td>MSE</td>
      		<td><input type="text" name="mse" value="<?php  echo $MSE;?>" readonly></td>
      	</tr>
      	<tr>
      		<td>MAD</td>
      		<td><input type="text" name="mad" value="<?php  echo $MAD;?>" readonly></td>
      	</tr>
      	<?php 
      	
      }
  } 
  else {
  	echo "Gagal :". mysqli_error();
  }

  ?>
</tbody>
</table>
<br>
<div>
	<?php
	if($total_record<=$ordo){
		echo "Data tidak mencukupi";
	} else {
		?>
		<h4> Peramalan Penjualan <b><?php echo $kat_row['nama_kategori']?> </b>Menggunakan Metode Moving Average adalah : <b> <input type="text" name="hasil_peramalan" value="<?php echo (array_sum($stok_before))/$ordo; ?> " size="3"> </h4>

			<br>
			<div>
				<?php

				$MAPE = 0;
				$MAD = 0;

            for ($i = $ordo; $i < count ($pred['value']) ;$i++ ) { //ordo 3 nah ordo 3 kurang dari jumlah data prediksi kalau bener masuk ke rumus. ini dimulai data ke 4 karena yang ordo 3 itu dijadikan index i jadi index ke 3 adalah data ke 4 

              $MAPE = $MAPE+abs(($pred['value'][$i]-$actual[$i])/$actual[$i]); //ini merupakan penjumlahan variabel mape + variabel mape di perulangan sebelumnya 
              // $MAD=$MAD+$DA
              // $mape = 0
              // perulangan 1 = $mape = 0 + 0,1111111(ini hasil mape data ke 4 ) = ...
              // perulangan 2 = $mape = 0,11111 + .... (ini hasil mape data ke 5) = ...
              //dan seterusnya 

              //$MAPE + ... Ini adalah mulai dari $mape=0, 0 itu index terus data nya disimpan di $MAPE = ... terus $mape + .... $mape=1, itu index 1 terus data nya disimpan di $MAPE = ... dan seterusnya 

               //abs nilai negatif jadi positif dan nilai positif tetap positif
          }
          ?>

          <h4> Mean Absolute Percentage Error (MAPE)</b> Peramalan Penjualan adalah : <b> <input type="text" name="mape" value="<?php echo $MAPE/(count($pred['value'])-$ordo)*100; ?>" size="5"> </h4> 
          	
<input type="submit" name="submit" value="SIMPAN" class="btn btn-primary">
          </div> 
          <?php 
      } 
      ?>
  </div>
</div>

</div>
</form>
<?php

      //untuk grafik juga
if (isset($pred) && $total_record > $ordo) { 
	$actual[] = 0;
	$pred['value'][] = (array_sum($stok_before))/$ordo;
	$pred['label'][] = substr($next_month, 0, 3) . ' \'' . substr($next_year, 2);
        $dt = array('pred' => $pred, 'actual' => $actual); //value sama label disimpan di array dt
        $params = base64_encode(json_encode($dt)); //base64 fungsi bawaan, data array nya banyak jadi dibuat json terus di encode karena json memuat tanda petik ganda. // dari bentuk array diubah jadi karakter base64 tampil di url coba buka tab baru
        ?>             
        <img src="admin/module/peramalan/chart.php?data=<?php echo $params?>">

    <?php }?>
</tbody>
</table>
												<!-- end view barang -->
					<!-- tambah barang MODALS-->
					<div class="modal-create" style="z-index:9999999;position:absolute;margin:0 auto;padding:0;top:0;width:85%;">
						<div class="panel panel-default" style="border:0px;">
							<div class="panel-heading">
								<h4><i class="fa fa-user-plus"></i>  Tambah Barang
									<a class="pull-right">
										<button type="submit" class="btn btn-danger" onclick="cancelModals()" id="batal">Batal</button>
									</a>
								</h4>
							</div>
							<div class="panel-body">
								<div class="box-content">
									<table class="table table-striped bordered">
										<form action="fungsi/tambah/tambah.php?barang=tambah" method="POST">
											
											<?php
												$format = $lihat -> barang_id();
											?>
											<tr>
												<td>ID Barang</td>
												<td><input type="text" readonly="readonly" value="<?php echo $format;?>" class="form-control"  name="id"></td>
											</tr>
											<tr>
												<td>Kategori</td>
												<td>
												<select name="kategori" class="form-control">
													<option value="#">Pilih Kategori</option>
													<?php  $kat = $lihat -> kategori(); foreach($kat as $isi){ 	?>
													<option value="<?php echo $isi['id_kategori'];?>"><?php echo $isi['nama_kategori'];?></option>
													<?php }?>
												</select>
												</td>
											</tr>
											<tr>
												<td>Nama Barang</td>
												<td><input type="text" placeholder="Nama Barang" class="form-control" name="nama"></td>
											</tr>
											<tr>
												<td>Merk Barang</td>
												<td><input type="text" placeholder="Merk Barang" class="form-control"  name="merk"></td>
											</tr>
											<tr>
												<td>Harga Beli</td>
												<td><input type="number" placeholder="Harga beli" class="form-control" name="beli"></td>
											</tr>
											<tr>
												<td>Harga Jual</td>
												<td><input type="number" placeholder="Harga Jual" class="form-control"  name="jual"></td>
											</tr>
											<tr>
												<td>Satuan Barang</td>
												<td>
													<select name="satuan" class="form-control">
														<option value="#">Pilih Satuan</option>
														<option value="PCS">PCS</option>
													</select>
												</td>
											</tr>
											<tr>
												<td>Stok</td>
												<td><input type="number" Placeholder="Stok" class="form-control"  name="stok"></td>
											</tr>
											<tr>
												<td>Tanggal Input</td>
												<td><input type="text" readonly="readonly" class="form-control" value="<?php echo  date("j F Y, G:i");?>" name="tgl"></td>
											</tr>
											<tr>
												<td></td>
												<td><button class="btn btn-primary"><i class="fa fa-plus"></i> Insert Data</button></td>
											</tr>
										</form>
									</table>
								</div>
							</div>
						<!-- end tambah barang -->
					</div>
				  </div>
              </div>
          </section>
													<?php } ?></section>

	
