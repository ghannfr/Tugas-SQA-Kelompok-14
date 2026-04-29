<?php 
  if (session_status() === PHP_SESSION_NONE) {
      session_start();
  }

  // Jika tidak ada session email (belum daftar), lempar kembali
  if(!isset($_SESSION['temp_email'])) {
      header("Location: ../index.php");
      exit;
  }
  include('../template/link.php');
  include('../template/head.php');
?>
<body>
  <main>
    <div class="container">
      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Verifikasi OTP</h5>
                    <p class="text-center small">Masukkan kode 6 digit yang telah dikirim ke email <b><?= $_SESSION['temp_email'] ?></b></p>
                  </div>

                  <form class="row g-3 needs-validation" novalidate action="../controller/crud.php?aksi=verifikasi" method="POST">
                    <div class="col-12">
                      <input type="hidden" name="email" value="<?= $_SESSION['temp_email'] ?>">
                      <label for="otp" class="form-label">Kode OTP</label>
                      <input type="number" name="otp" class="form-control" placeholder="123456" required>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Verifikasi</button>
                    </div>
                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </main>
<?php include('../template/footer.php') ?>