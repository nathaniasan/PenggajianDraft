<div class="container-fluid">

	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">
			<?php echo $title ?>
		</h1>

		<div id="date"></div>
		<script>
			var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
			var date = new Date();
			var day = date.getDate();
			var month = date.getMonth();
			var year = date.getFullYear()

			document.getElementById("date").innerHTML = " " + day + " " + months[month] + " " + year;
		</script>
	</div>

	<div class="card shadow mb-4">
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
					<thead class="thead-dark">
						<tr>
							<th>No</th>
							<th>Potongan Gaji</th>
							<th>Jumlah Potongan</th>
							<th colspan='2'>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no = 1;
						foreach ($hasil as $item) {
							?>
							<tr>
								<td>
									<?php echo $no; ?>
								</td>
								<td>
									<?php echo $item->id_potongan; ?>
								</td>
								<td>Rp.
									<?php echo number_format($item->id_pegawai, 0, ',', '.') ?>
								</td>
								<td>
									<button type="button" potongan="<?php echo $item->id_potongan; ?>"
										class="edit btn btn-sm btn-info"><i class="fas fa-edit"></i></button>
									<button type="button" potongan="<?php echo $item->id_potongan; ?>"
										class="hapus btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
								</td>
							</tr>
							<?php
							$no++;
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

</div>