<div class="container-fluid">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">
			<?php echo $title ?>
		</h1>
	</div>
	<a class="btn btn-sm btn-success mb-3" href="<?php echo base_url('admin/honor/tambah_honor') ?>"><i
			class="fas fa-plus"></i> Tambah Pegawai</a>
	<?php echo $this->session->flashdata('pesan') ?>
</div>

<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead class="thead-dark">
						<tr>
							<th class="text-center">No</th>
							<th class="text-center">NIK</th>
							<th class="text-center">Nama Pegawai</th>
							<th class="text-center">Jabatan</th>
							<th class="text-center">Jam Honor</th>
							<th class="text-center">Jumlah Honor</th>
							<th class="text-center">Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1;
						foreach ($honorer as $h): ?>
							<tr>
								<td class="text-center">
									<?php echo $no++ ?>
								</td>
								<td class="text-center">
									<?php echo $h->nik ?>
								</td>
								<td class="text-center">
									<?php echo $h->nama_pegawai ?>
								</td>
								<td class="text-center">
									<?php echo $h->nama_jabatan ?>
								</td>
								<td class="text-center">
									<?php echo $h->jam_honor ?>
								</td>
								<td class="text-center">
									<?php echo $h->jmlh_honor ?>
								</td>
								<td class="text-center">
									<a class="btn btn-sm btn-info"
										href="<?php echo base_url('admin/honor/update_data/' . $h->id_pegawai) ?>"><i
											class="fas fa-edit"></i></a>
									<a onclick="return confirm('Yakin Hapus?')" class="btn btn-sm btn-danger"
										href="<?php echo base_url('admin/data_pegawai/delete_data/' . $h->id_pegawai) ?>"><i
											class="fas fa-trash"></i></a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>