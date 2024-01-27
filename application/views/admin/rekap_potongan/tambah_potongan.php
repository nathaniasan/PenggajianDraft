<form method="post" id="form">

	<div class="form-group">
		<label>Nama Pegawai</label>
		<select name="id_pegawai" class="form-control">
			<option value="">--Pilih pegawai--</option>
			<?php foreach ($pegawai as $j): ?>
				<option value="<?php echo $j->id_pegawai ?>">
					<?php echo $j->nama_pegawai ?>
				</option>
			<?php endforeach; ?>
		</select>
	</div>

	<div class="form-group">
		<label>Jenis Potongan</label>
		<select name="id_potongan" class="form-control">
			<option value="">--Pilih potongan--</option>
			<?php foreach ($potongan as $j): ?>
				<option value="<?php echo $j->id ?>">
					<?php echo $j->potongan ?>
				</option>
			<?php endforeach; ?>
		</select>
	</div>


	<div class="form-group">
		<label for="email">Jumlah</label>
		<input type="text" class="form-control" name="jml_potongan" placeholder="Masukan Jumlah Potongan">
	</div>
	<button id="tombol_tambah" type="button" class="btn btn-primary" data-dismiss="modal"
		data-redirect="<?php echo base_url(); ?>admin/potongan_gaji/tampilPotongan">Simpan</button>

</form>
<script type="text/javascript">
	$("#tombol_tambah").click(function () {
		var data = $('#form').serialize();
		$.ajax({
			type: 'POST',
			url: "<?php echo base_url(); ?>admin/rekap_potongan/simpanPotongan",
			data: data,
			cache: false,
			success: function (data) {
				window.location.href = "<?php echo base_url(); ?>admin/rekap_potongan/";
			}
		});
	});

</script>