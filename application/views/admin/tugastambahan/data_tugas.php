<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php echo $title?></h1>
  </div>
  <a class="btn btn-sm btn-success mb-3" href="<?php echo base_url('admin/data_tugastambahan/tambah_data') ?>"><i class="fas fa-plus"></i> Tambah Tugas</a>
  <?php echo $this->session->flashdata('pesan')?>
</div>

<div class="container-fluid">
  <div class="card shadow mb-4">
   <div class="card-body">
     <div class="table-responsive">
       <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
         <thead class="thead-dark">
           <tr>
           <th class="text-center">Nomor</th>
              <th class="text-center">Id Tugas</th>
              <th class="text-center">Nama Tugas</th>
              <th class="text-center">Id Pegawai</th>
              <th class="text-center">Id Jabatan</th>
              <th class="text-center">Aksi</th>
           </tr>
         </thead>
         <tbody>
           <?php $no=1; foreach($tugas as $p) : ?>
            <tr>
              <td class="text-center"><?php echo $no++ ?></td>
              <td class="text-center"><?php echo $p->id_tugas ?></td>
              <td class="text-center"><?php echo $p->nama_tugas ?></td>
              <td class="text-center"><?php echo $p->id_pegawai ?></td>
              <td class="text-center"><?php echo $p->id_jabatan ?></td>
              <td>
                <center>
                  <a class="btn btn-sm btn-info" href="<?php echo base_url('admin/data_tugastambahan/update_data/'.$p->id_tugas) ?>"><i class="fas fa-edit"></i></a>
                  <a onclick="return confirm('Yakin Hapus?')" class="btn btn-sm btn-danger" href="<?php echo base_url('admin/data_tugastambahan/delete_data/'.$p->id_tugas) ?>"><i class="fas fa-trash"></i></a>
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