<div class="container-fluid">

	<div class="modal fade" id="myModal">
		<div class="modal-dialog">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title" id="judul"></h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<!-- Modal body -->
				<div class="modal-body">
					<div id="tampil_modal">
						<!-- Data akan di tampilkan disini-->
					</div>
				</div>
				<!-- Modal footer -->
				<div class="modal-footer">
					<button type="button" class="btn btn btn-sm btn-danger" data-dismiss="modal">Batal</button>
				</div>
			</div>
		</div>
	</div>

	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">
			<?php echo $title ?>
		</h1>

		<div id="date"></div>
		<script>
			var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September',
				'Oktober', 'November', 'Desember'];
			var date = new Date();
			var day = date.getDate();
			var month = date.getMonth();
			var year = date.getFullYear()

			document.getElementById("date").innerHTML = " " + day + " " + months[month] + " " + year;
		</script>
	</div>
	<button type="button" class="tambah_rekap btn-sm btn-success mb-3" data-toggle="modal" data-target="#myModal">
		<i class="fas fa-plus"></i> Tambah Potongan
	</button>

	<div id="flash-message-container"></div>

	<div class="card shadow mb-4">
		<div class="card-body">

			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead class="thead-dark">
						<tr>
							<th class="text-center">No</th>
							<th class="text-center">Nama Pegawai</th>
							<th class="text-center">Jenis Potongan</th>
							<th class="text-center">Aksi </th>

						</tr>
					</thead>
					<tbody>
						<?php $no = 1;
						foreach ($hasil as $item): ?>
							<tr>
								<td class="text-center">
									<?php echo $no++ ?>
								</td>
								<td class="text-center">
									<?php echo $item->nama_pegawai ?>
								</td>
								<td class="text-center">
									<?php echo $item->potongan ?>
								</td>
								<td>
									<center>
										<a class="btn btn-sm btn-info"
											href="<?php echo base_url('admin/rekap_potongan/update_data/' . $item->id_rekap) ?>"><i
												class="fas fa-edit"></i></a>
										<a onclick="return confirm('Yakin Hapus?')" class="btn btn-sm btn-danger"
											href="<?php echo base_url('admin/rekap_potongan/delete_data/' . $item->id_rekap) ?>"><i
												class="fas fa-trash"></i></a>
									</center>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

</div>


<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
	$(document).ready(function () {
		$("#myInput").on("keyup", function () {
			var value = $(this).val().toLowerCase();
			$("#myTable tr").filter(function () {
				$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		});
	});
</script>

<script>
	$(document).ready(function () {

		$('.tambah_rekap').click(function () {
			var aksi1 = 'Tambah Potongan Gaji';
			$.ajax({
				url: '<?php echo base_url(); ?>admin/rekap_potongan/tambahpotongan',
				method: 'post',
				data: { aksi1: aksi1 },
				success: function (data) {
					$('#myModal').modal("show");
					$('#tampil_modal').html(data);
					document.getElementById("judul").innerHTML = 'Tambah Potongan';

				}
			});
		});

		

		
	});
</script>
