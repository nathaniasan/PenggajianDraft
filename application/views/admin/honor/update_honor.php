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
		<form method="POST" action="<?php echo base_url('admin/honor/update_honor_aksi') ?>"
			enctype="multipart/form-data">

			<div class="form-group">
				<label>Jam Honor</label>
				<input type="hidden" name="id_honor" class="form-control" value="<?php echo $honor->id_honor ?>">
				<input type="number" name="jam_honor" value="<?php echo $honor->jam_honor ?>" class="form-control">
				<?php echo form_error('jam_honor', '<div class="text-small text-danger"> </div>') ?>
			</div>

			<div class="form-group">
				<label>Jumlah Honor</label>
				<input type="number" value="<?php echo $honor->jmlh_honor ?>" name="jmlh_honor" class="form-control">
				<?php echo form_error('jmlh_honor', '<div class="text-small text-danger"> </div>') ?>
			</div>

			<div class="form-group">
				<label>Nama Pegawai</label>
				<select name="id_pegawai" class="form-control">
					<option value="">--Pilih Pegawai--</option>
					<?php foreach ($fetch_pegawai as $pegawai): ?>
						<option value="<?php echo $pegawai->id_pegawai ?>">
							<?php echo $pegawai->nama_pegawai ?>
						</option>
					<?php endforeach; ?>
				</select>
			</div>
			<button type="submit" name="update_honor" class="btn btn-success">Simpan</button>
			<button type="reset" class="btn btn-danger">Reset</button>
			<a href="<?php echo base_url('admin/honor') ?>" class="btn btn-warning">Kembali</a>

		</form>
	</div>
</div>