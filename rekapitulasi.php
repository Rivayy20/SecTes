<?php include "header.php"; ?>
<div class="row">
  <div class="col-md-12">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Rekapitulasi Pengunjung</h6>
      </div>
      <div class="card-body">
        <form method="POST" action="" class="text-center">
          <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Dari Tanggal </label>
                <input class="form-control" type="date" name="tanggal1" value="<?= isset($_POST['tanggal1'])?$_POST['tanggal1']: date('Y-m-d') ?>" required />
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Dari Tanggal </label>
                <input class="form-control" type="date" name="tanggal2" value="<?= isset($_POST['tanggal2'])?$_POST['tanggal2']: date('Y-m-d') ?>" required />
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-2">  
              <button class="btn btn-primary form-control" name="btampilkan"><i class="fa fa-search"></i>Tampilkan</button>
            </div>
            <div class="col-md-2">  
              <a href="admin.php" class="btn btn-danger form-control"><i class="fa fa-backward"></i>Kembali</a>
            </div>
          </div>

        </form>

        <?php
        if(isset($_POST['btampilkan'])) :
        ?>

        <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Tanggal</th>
                            <th>Nama Pengunjung</th>
                            <th>Kelas</th>
                            <th>NIS</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php
                        $tgl1 = $_POST['tanggal1'];
                        $tgl2 = $_POST['tanggal2'];

                        $tgl = date('Y-m-d');
                        $tampil= mysqli_query($koneksi, "SELECT * FROM tpengunjung WHERE tanggal BETWEEN '$tgl1' AND '$tgl2' ORDER BY id DESC");
                        $no = 1;

                        while ($data= mysqli_fetch_array($tampil)){
                        ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $data['tanggal'] ?></td>
                            <td><?= $data['nama'] ?></td>
                            <td><?= $data['kelas'] ?></td>
                            <td><?= $data['nis'] ?></td>
                        </tr>
                      <?php } ?>
                    </tbody>
                </table>
            </div>
            <?php endif;?>
      </div>
    </div>
  </div>
</div>

<?php include "footer.php"; ?>
