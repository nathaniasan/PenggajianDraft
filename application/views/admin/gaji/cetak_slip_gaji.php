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
		<h1>SMA YP UNILA</h1>
		<h2>Daftar Gaji Guru dan S</h2>
		<hr style="width: 50%; border-width: 5px; color: black">
	</center>

	<?php
	$no = 1;
	foreach ($potongan as $p) {
		$potongan = $p->jml_potongan;
	} ?>


	<?php foreach ($print_slip as $ps): ?>


		<?php $honor_pokok = $ps->hadir * $ps->honor;

		$tj_piket = 80000 * $ps->piket;
		?>

		<table style="width: 100%">
			<tr>
				<td width="20%">Nama Pegawai</td>
				<td width="2%">:</td>
				<td>
					<?php echo $ps->nama_pegawai ?>
				</td>
			</tr>
			<tr>
				<td>NIK</td>
				<td>:</td>
				<td>
					<?php echo $ps->nik ?>
				</td>
			</tr>
			<tr>
				<td>Jabatan</td>
				<td>:</td>
				<td>
					<?php echo $ps->nama_jabatan ?>
				</td>
			</tr>
			<tr>
				<td>Bulan</td>
				<td>:</td>
				<td>
					<?php echo substr($ps->bulan, 0, 2) ?>
				</td>
			</tr>
			<tr>
				<td>Tahun</td>
				<td>:</td>
				<td>
					<?php echo substr($ps->bulan, 2, 4) ?>
				</td>
			</tr>
		</table>

		<table class="table table-striped table-bordered mt-3">
			<tr>
				<th class="text-center" width="5%">No</th>
				<th class="text-center">Keterangan</th>
				<th class="text-center">Jumlah</th>
			</tr>
			<tr>
				<td>1</td>
				<td>Honor Pokok</td>
				<td>Rp.
					<?php echo number_format($honor_pokok, 0, ',', '.') ?>
				</td>
			</tr>
			<tr>
				<td>2</td>
				<td>Tj Struktural</td>
				<td>Rp.
					<?php echo number_format($ps->tj_struktural, 0, ',', '.') ?>
				</td>
			</tr>

			<tr>
				<td>3</td>
				<td>Tunjangan Transportasi</td>
				<td>Rp.
					<?php echo number_format($ps->tj_transport, 0, ',', '.') ?>
				</td>
			</tr>

			<tr>
				<td>4</td>
				<td>Tj. Staff</td>
				<td>Rp.
					<?php echo number_format($ps->uang_makan, 0, ',', '.') ?>
				</td>
			</tr>
			<tr>
				<td>5</td>
				<td>Insentif MGMP</td>
				<td>Rp.
					<?php echo number_format($ps->insentif_mgmp, 0, ',', '.') ?>
				</td>
			</tr>
			<tr>
				<td>6</td>
				<td>Tunjangan Yayasan</td>
				<td>Rp.
					<?php echo number_format($ps->tunjangan_yayasan, 0, ',', '.') ?>
				</td>
			</tr>
			<tr>
				<td>7</td>
				<td>Tunjangan Yayasan</td>
				<td>Rp.
					<?php echo number_format($ps->tunjangan_yayasan, 0, ',', '.') ?>
				</td>
			</tr>
			<tr>
				<td>8</td>
				<td>Piket</td>
				<td>Rp.
					<?php echo number_format($tj_piket, 0, ',', '.') ?>
				</td>
			</tr>
			<tr>
				<td>9</td>
				<td>Rincian Jenis Potongan</td>
				<td>

				</td>
			</tr>

			<tr>
				<td></td>
				<td>
					<?php $jenis = $ps->JenisPotongan;
					$jenis_potongan = explode(',', $jenis);
					foreach ($jenis_potongan as $jp) {

						echo '<p>' . $jp . '</p>';

					} ?>
				</td>
				<td>
					<?php
					$result = $ps->besarPotongan;
					$potonganArray = explode(', ', $result);
					foreach ($potonganArray as $potongan) {
						echo '<p>' . $potongan . '</p>';
					}
					?>

				</td>
			</tr>
			<tr>
				<td>9</td>
				<td>Total Potongan</td>
				<td>Rp.
					<?php echo number_format($ps->total_jumlah_potongan, 0, ',', '.') ?>
				</td>
			</tr>

			<tr>
				<th colspan="2" style="text-align: right;">Total Gaji : </th>
				<th>Rp.
					<?php echo number_format($ps->tj_struktural + $ps->tj_transport + $ps->uang_makan + $tj_piket + $honor_pokok - $ps->total_jumlah_potongan, 0, ',', '.') ?>
				</th>
			</tr>
		</table>

		<table width="100%">
			<tr>
				<td></td>
				<td>
					<p>Pegawai</p>
					<br>
					<br>
					<p class="font-weight-bold">
						<?php echo $ps->nama_pegawai ?>
					</p>
				</td>

				<td width="200px">
					<p>Bandar Lampung,
						<?php echo date("d M Y") ?> <br> Bendahara,
					</p>
					<br>
					<br>
					<p>_______________________________</p>
				</td>
			</tr>
		</table>

	<?php endforeach; ?>

</body>

</html>

<script type="text/javascript">
	window.print();
</script>