<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">
			<?php echo $title ?>
		</h1>
	</div>

</div>
<!-- /.container-fluid -->

<div class="card" style="width: 60% ; margin-bottom: 100px">
	<div class="card-body">

		<?php foreach ($pegawai as $p): ?>
			<form method="POST" action="<?php echo base_url('admin/data_pegawai/update_data_aksi') ?>"
				enctype="multipart/form-data">

				<div class="form-group">
					<label>Jabatan</label>
					<select name="jabatan" class="form-control">
						<option value="<?php echo $p->jabatan ?>">
							<?php echo $p->jabatan ?>
						</option>
						<?php foreach ($jabatan as $j): ?>
							<option value="<?php echo $j->nama_jabatan ?>">
								<?php echo $j->nama_jabatan ?>
							</option>
						<?php endforeach; ?>
					</select>
				</div>

				

				<div class="form-group">
					<label>Hak Akses</label>
					<select name="hak_akses" class="form-control">
						<option value="<?php echo $p->hak_akses ?>">
							<?php if ($p->hak_akses == '1') {
								echo "Admin";
							} else {
								echo "Pegawai";
							} ?>
						</option>
						<option value="1">Admin</option>
						<option value="2">Pegawai</option>
					</select>
				</div>

				<div class="form-group">
					<label>Photo</label>
					<input type="file" name="photo" class="form-control">
				</div>

				<button type="submit" class="btn btn-success">Simpan</button>
				<a href="<?php echo base_url('admin/data_pegawai') ?>" class="btn btn-warning">Kembali</a>

			</form>
		<?php endforeach; ?>
	</div>
</div>
