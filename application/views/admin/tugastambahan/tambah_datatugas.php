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
		<form method="POST" action="<?php echo base_url('admin/data_tugastambahan/tambah_data_aksi') ?>"
			enctype="multipart/form-data">

			<div class="form-group">
				<label>Id Tugas</label>
				<input type="number" name="id_tugas" class="form-control">
				<?php echo form_error('id_tugas', '<div class="text-small text-danger"> </div>') ?>
			</div>

			<div class="form-group">
				<label>Nama Tugas</label>
				<input type="text" name="nama_tugas" class="form-control">
				<?php echo form_error('nama_tugas', '<div class="text-small text-danger"> </div>') ?>
			</div>

			<div class="form-group">
				<label>Id Pegawai</label>
				<input type="text" name="id_pegawai" class="form-control">
				<?php echo form_error('id_pegawai', '<div class="text-small text-danger"> </div>') ?>
			</div>

			<div class="form-group">
				<label>Id Jabatan</label>
				<input type="text" name="id_jabatan" class="form-control">
				<?php echo form_error('id_jabatan', '<div class="text-small text-danger"> </div>') ?>
			</div>

			<button type="submit" class="btn btn-success">Simpan</button>
			<button type="reset" class="btn btn-danger">Reset</button>
			<a href="<?php echo base_url('admin/data_tugastambahan') ?>" class="btn btn-warning">Kembali</a>

		</form>
	</div>
</div>
