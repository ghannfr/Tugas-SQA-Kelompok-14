
<?php 
  include('../template/link.php');
  include('../template/head.php');
?>

<body>
    <?php include('../template/topbar.php'); ?>
    <?php include('../template/sidebar.php'); ?>
    <?php require '../controller/Pintasan.php';
    
        // tampilkan form edit
        $idGet = strip_tags($_GET['id']);
        $hasil = $proses->tampil_data_id('t_pengaduan','id_pengaduan',$idGet);
    ?>
    <main id="main" class="main">

        <div class="pagetitle">
        <h1>Edit Pengaduan</h1>
        <nav>
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item">Forms</li>
            <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
        </div><!-- End Page Title -->

        <section class="section">
        <div class="row">
            <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                <h5 class="card-title">Edit Pengaduan</h5>

                <!-- General Form Elements -->
                <form class="row g-3 needs-validation" novalidate action="<?php echo $url['base_url']?>controller/crud.php?aksi=edit"  method="POST" enctype="multipart/form-data">
                    <input type="hidden" class="form-control" id="id_user" name="id_user" value="<?php echo $user['id_user'] ?>">
                    <input type="hidden" class="form-control" id="id_catatan" name="id_pengaduan" value="<?php echo $hasil['id_pengaduan'] ?>">

                    <div class="row mb-3">
                        <input type="hidden" class="form-control" id="id_user" name="id_user" value="<?php echo $user['id_user'] ?>">
                        <label for="inputDate" class="col-sm-2 col-form-label">Tanggal Pengaduan</label>
                        <div class="col-sm-10">
                            <input type="date" name="tgl_pengaduan" class="form-control" value="<?php echo $hasil['tgl_pengaduan'] ?>">
                            <div class="invalid-feedback">Silahkan masukan tanggal pengaduan!</div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Isi Laporan</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="isi_laporan" style="height: 100px"><?php echo $hasil['isi_laporan'] ?></textarea>
                            <div class="invalid-feedback">Silahkan masukan isi laporan!</div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputNumber" class="col-sm-2 col-form-label">File Foto</label>
                        <div class="col-sm-10">
                            <div class="col-md-4"><img src="<?php echo "../upload/".$hasil['foto'];?>" width="80px" height="80px"/></div>
                        </div>
                    </div>
                    <div class="row mb-3">
  <label for="inputNumber" class="col-sm-2 col-form-label">Upload Ulang Foto</label>
  <div class="col-sm-10">
    <input type="hidden" name="foto_lama" value="<?php echo $hasil['foto']; ?>">
    
    <input class="form-control" type="file" id="formFile" name="foto">
    <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto.</small>
  </div>
</div>

                    <div class="row mb-3">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Edit</button>
                        </div>
                    </div>
                </form><!-- End General Form Elements -->
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->
    <?php include('../template/footer.php') ?>