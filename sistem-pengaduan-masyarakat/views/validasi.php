
<?php 
  require "../controller/pintasan.php";
  include('../template/link.php');
  include('../template/head.php');
?>

<body>
    <?php include('../template/topbar.php'); ?>
    <?php include('../template/sidebar.php'); ?>
    <main id="main" class="main">

        <div class="pagetitle">
        <h1>Pengaduan</h1>
        <nav>
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item">Data</li>
            <li class="breadcrumb-item active">Pengaduan</li>
            </ol>
        </nav>
        </div><!-- End Page Title -->

        <section class="section">
        <div class="row">
            <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                <h5 class="card-title">Data Pengaduan</h5>

                <!-- Default Table -->
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Isi Laporan</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Aksi | Status</th>
                  </tr>
                </thead>
                <tbody>
                    <?php

                    $no=1;
                    $hasil = $proses->tampil_data_pengaduan('t_pengaduan', $user['id_user']);

                    foreach($hasil as $isi){
                    ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $isi['tgl_pengaduan']?></td>
                        <td><?php echo $isi['isi_laporan'];?></td>
                        <td><img src="<?php echo "../upload/".$isi['foto'];?>" width="80px" height="80px" /></td>
                        <td style="text-align: left;">
                            
                            <a onclick="return confirm('Apakah yakin data akan di hapus?')" href="<?php echo $url['base_url'];?>controller/crud.php?aksi=hapus&hapusid=<?php echo $isi['id_pengaduan'];?>" 
                            class="btn btn-danger btn-md"><span class="bi bi-trash"></span></a>
                            <a href="addtanggapan.php?id=<?php echo $isi['id_pengaduan'];?>" class="btn btn-warning btn-md">
                            <span class="bi bi-pencil-square"></span></a>
                        </td>
                    </tr>
                    <?php
                    $no++;
                    }
                    ?>
                </tbody>
              </table>
              <!-- End Default Table Example -->
                
                </div>
            </div>

            </div>
        </div>
        </section>

    </main><!-- End #main -->
    <?php include('../template/footer.php') ?>