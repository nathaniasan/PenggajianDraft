<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">
			<?php echo $title ?>
		</h1>
	</div>
	<div class="table-responsive">
		<table class="table table-striped table-bordered">
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
				<th class="text-center">Tj Piket</th>
				<th class="text-center">Honor Pokok</th>
				<th class="text-center">Jam Kehadiran</th>
				<th class="text-center">Jumlah Potongan Gaji</th>
				<th class="text-center">Total Gaji</th>
				<th class="text-center">Cetak</th>
			</tr>
			<?php $no = 1;
			// var_dump($gaji);
			echo PHP_EOL;
			echo PHP_EOL . `<br><br><br><br>`;

			// var_dump($potongan);
			
			// die();
			foreach ($gaji as $g): ?>
				<?php $total_honorer = $g->honor * $g->hadir;
				$tj_piket = 80000 * $g->piket;

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
						<?php echo number_format($tj_piket, 0, ',', '.') ?>
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
						<?php echo number_format($g->tj_struktural + $g->tj_transport + $g->uang_makan + $tj_piket + $total_honorer - $g->total_jumlah_potongan, 0, ',', '.') ?>
					</td>
					<td>
						<center>
							<a class="btn btn-sm btn-primary"
								href="<?php echo base_url('pegawai/data_gaji/cetak_slip/' . $g->id_kehadiran) ?>"><i
									class="fas fa-print"></i></a>
						</center>


					</td>
				</tr>
				</tr>

				</tr>
			<?php endforeach; ?>
		</table>
	</div>
</div>
<!-- /.container-fluid -->
