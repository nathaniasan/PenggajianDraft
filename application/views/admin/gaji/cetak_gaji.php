<!DOCTYPE html>
<html>

<head>
	<title>
		<?php echo $title ?>
	</title>
	<style type="text/css">
		body {
			font-family: Arial;
			color: black;
		}
	</style>
</head>

<body>
	<center>
		<h1>SMA YP Unila</h1>
		<h2>Daftar Gaji Guru dan Staff</h2>
	</center>

	<?php
	if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
		$bulan = $_GET['bulan'];
		$tahun = $_GET['tahun'];
		$bulantahun = $bulan . $tahun;
	} else {
		$bulan = date('m');
		$tahun = date('Y');
		$bulantahun = $bulan . $tahun;
	}
	?>
	<table>
		<tr>
			<td>Bulan</td>
			<td>:</td>
			<td>
				<?php echo $bulan ?>
			</td>
		</tr>
		<tr>
			<td>Tahunn</td>
			<td>:</td>
			<td>
				<?php echo $tahun ?>
			</td>
		</tr>
	</table>
	<table class="table table-bordered table-triped" id="dataTable" width="100%" cellspacing="0">
		<thead class="thead-dark">
			<tr>
				<th class="text-center">No</th>
				<th class="text-center">NIK</th>
				<th class="text-center">Nama Pegawai</th>
				<th class="text-center">Jenis Kelamin</th>
				<th class="text-center">Jabatan</th>
				<th class="text-center">Tj Struktural</th>
				<th class="text-center">Tj. Transport</th>
				<th class="text-center">Tj. Staff</th>
				<th class="text-center">Insentif MGMP</th>
				<th class="text-center">Tj Yayasan</th>
				<th class="text-center">Honor Pokok</th>
				<th class="text-center">Jam Kehadiran</th>
				<th class="text-center">Jumlah Potongan Gaji</th>
				<th class="text-center">Total Gaji</th>
			</tr>
		</thead>
		<tbody>

			<?php $no = 1;
			// var_dump($gaji);
			echo PHP_EOL;
			echo PHP_EOL . `<br><br><br><br>`;

			// var_dump($potongan);
			
			// die();
			foreach ($cetak_gaji as $g): ?>
				<?php $total_honorer = $g->honor * $g->hadir;
				// echo ($total_honorer . "    " . $g->honor . "    " . $g->hadir);
				// die();
				?>
				<tr>
					<td class="text-center">
						<?php echo $no++ ?>
					</td>
					<td class="text-center">
						<?php echo $g->nik ?>
					</td>
					<td class="text-center">
						<?php echo $g->nama_pegawai ?>
					</td>
					<td class="text-center">
						<?php echo $g->jenis_kelamin ?>
					</td>
					<td class="text-center">
						<?php echo $g->nama_jabatan ?>
					</td>
					<td class="text-center">Rp.
						<?php echo number_format($g->tj_struktural, 0, ',', '.') ?>
					</td>
					<td class="text-center">Rp.
						<?php echo number_format($g->tj_transport, 0, ',', '.') ?>
					</td>
					<td class="text-center">Rp.
						<?php echo number_format($g->uang_makan, 0, ',', '.') ?>
					</td>
					<td class="text-center">Rp.
						<?php echo number_format($g->insentif_mgmp, 0, ',', '.') ?>
					</td>
					<td class="text-center">Rp.
						<?php echo number_format($g->tunjangan_yayasan, 0, ',', '.') ?>
					</td>
					<td class="text-center">Rp.
						<?php echo number_format($total_honorer, 0, ',', '.') ?>
					</td>

					<td class="text-center">
						<?php echo $g->hadir ?>
					</td>

					<td class="text-center">Rp.
						<?php echo number_format(
							$g->total_jumlah_potongan
							,
							0,
							',',
							'.'
						) ?>
					</td>
					<!-- <td class="text-center">Rp.
										<?php echo number_format($potongan, 0, ',', '.') ?>
									</td> -->

					<td class="text-center">Rp.
						<?php echo number_format($g->tj_struktural + $g->tj_transport + $g->uang_makan + $total_honorer - $g->total_jumlah_potongan, 0, ',', '.') ?>
					</td>
				</tr>
				</tr>


			<?php endforeach; ?>
		</tbody>
	</table>

	<table width="100%">
		<tr>
			<td></td>
			<td width="200px">
				<p>Yogyakarta,
					<?php echo date("d M Y") ?> <br> Finance
				</p>
				<br>
				<br>
				<p>_____________________</p>
			</td>
		</tr>
	</table>
</body>

</html>

<script type="text/javascript">
	window.print();
</script>