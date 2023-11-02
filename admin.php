<?php include "header.php" ?>

<?php
if(isset($_POST['bsimpan'])){
  $tgl = date('Y-m-d');

  $nama = htmlspecialchars($_POST['nama'], ENT_QUOTES);
  $kelas = htmlspecialchars($_POST['kelas'], ENT_QUOTES);
  $nis = htmlspecialchars($_POST['nis'], ENT_QUOTES);

  $simpan = mysqli_query($koneksi, "INSERT INTO tpengunjung VALUES ('', '$tgl', '$nama', '$kelas', '$nis')");

  if ($simpan){
    echo "<script>alert('Simpan Data Sukses, Terimakasih');document.location='?'</script>";
  }else{
    echo "<script>alert('Simpan Data Gagal!');document.location='?'</script>";
  }
}
?>

      <!--Head-->
      <div class="head text-center">
        <img src="assets/img/smk.png" width="235" />
        <h2 class="text-white">Data Pengunjung Perpustakaan SMKN 2 Magelang</h2>
      </div>
      <!--End Head-->

      <!--Awal Row-->
      <div class="row mt-2">
        <!--Col-lg-7-->
        <div class="col-lg-7 mb-3">
          <div class="card shadow bg-gradient-light">
            <!--Card-body-->
            <div class="card-body">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Identitas Pengunjung</h1>
              </div>
              <form class="user" method="POST" action="">
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" name="nama" placeholder="Nama" required />
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" name="kelas" placeholder="Kelas" required />
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" name="nis" placeholder="NIS" required />
                </div>

                <button type="submit" name="bsimpan" class="btn btn-primary btn-user btn-block">Simpan Data</button>
                <hr />
              </form>
            </div>
            <!--End Card-Body-->
          </div>
        </div>
        <!--End Col-lg-7-->

        <!--Col-lg-5-->
        <div class="col-lg-5 mb-3">
          <div class="card shadow">
            <div class="card-body">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Statistik Pengunjung</h1>
              </div>
              <?php
              $tgl_sekarang = date('Y-m-d');
              $kemarin = date('Y-m-d', strtotime('-1 day', strtotime(date('Y-m-d'))));
              $seminggu = date('Y-m-d h:i:s', strtotime('-1 week +1 day', strtotime($tgl_sekarang)));
              $sekarang = date('Y-m-d h:i:s');

              $tgl_sekarang = mysqli_fetch_array(mysqli_query($koneksi, "SELECT count(*) FROM tpengunjung WHERE tanggal LIKE '%$tgl_sekarang%'"));
              $kemarin = mysqli_fetch_array(mysqli_query($koneksi, "SELECT count(*) FROM tpengunjung WHERE tanggal LIKE '%$kemarin%'"));
              $seminggu = mysqli_fetch_array(mysqli_query($koneksi, "SELECT count(*) FROM tpengunjung WHERE tanggal BETWEEN '$seminggu' AND '$sekarang'"));
              $bulan_ini = date('m');
              $sebulan = mysqli_fetch_array(mysqli_query($koneksi, "SELECT count(*) FROM tpengunjung WHERE month(tanggal) = '$bulan_ini'"));
              $keseluruhan = mysqli_fetch_array(mysqli_query($koneksi, "SELECT count(*) FROM tpengunjung"));
              ?>
              <table class="table table-bordered">
                <tr>
                  <td>Hari ini</td>
                  <td>: <?= $tgl_sekarang[0] ?></td>
                </tr>
                <tr>
                  <td>Kemarin</td>
                  <td>: <?= $kemarin[0] ?></td>
                </tr>
                <tr>
                  <td>Minggu Ini</td>
                  <td>: <?= $seminggu[0] ?></td>
                </tr>
                <tr>
                <tr>
                  <td>Bulan Ini</td>
                  <td>: <?= $sebulan[0] ?></td>
                </tr>
                <tr>
                  <td>Keseluruhan</td>
                  <td>: <?= $keseluruhan[0] ?></td>
                </tr>
              </table>
            </div>
          </div>
        </div>
        <!--End Col-lg-5-->
      </div>
      <!--End Row-->

       <!-- DataTales Example -->
       <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Pengunjung Hari Ini [<?=date('d-m-Y')?>]</h6>
        </div>
        <div class="card-body">
        <a href="rekapitulasi.php" class="btn btn-success mb-3"><i class="fa fa-table"></i>Rekapitulasi Pengunjung</a>
        <a href="index.php" class="btn btn-danger mb-3"><i class="fa fa-sign-out-alt"></i>Logout</a>

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
                        $tgl = date('Y-m-d');
                        $tampil= mysqli_query($koneksi, "SELECT * FROM tpengunjung WHERE tanggal like '%$tgl%' ORDER BY id DESC");
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
        </div>
    </div>
    <?php include "footer.php" ?>
