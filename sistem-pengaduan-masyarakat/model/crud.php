<?php
    class crud{
        protected $db;
        function __construct($db){
            $this->db = $db;
        }  

        // FUNGSI BARU: Mengecek apakah email sudah dipakai
        public function cek_email_terdaftar($email)
        {
            $row = $this->db->prepare("SELECT email FROM t_user WHERE email = ?");
            $row->execute(array($email));
            return $row->rowCount() > 0; 
        }

        //model daftar
        public function daftar($tabel, $data)
        {
            $nik = $data['nik'];
            $username = $data['username'];
            $password = md5($data['password']); 
            $nama = $data['nama'];
            $no_tlp = $data['no_tlp'];
            $alamat = $data['alamat']; // Data alamat masuk
            $level = $data['level'];
            $email = $data['email'];
            $otp = $data['otp'];
        
            // Query SQL diupdate untuk memasukkan alamat
            $sql = "INSERT INTO $tabel (nik, username, password, nama, no_tlp, alamat, level, email, otp, is_verified) 
            VALUES ('$nik', '$username', '$password', '$nama', '$no_tlp', '$alamat', '$level', '$email', '$otp', 0)";

            $save = $this->db->prepare($sql);
            return $save->execute();
        }

        //model verifikasi otp
        public function verifikasi_otp($email, $otp)
        {
            $row = $this->db->prepare('SELECT * FROM t_user WHERE email=? AND otp=?');
            $row->execute(array($email, $otp));
            $count = $row->rowCount();

            if($count > 0){
                $update = $this->db->prepare("UPDATE t_user SET is_verified = 1 WHERE email = ?");
                return $update->execute(array($email));
            } else {
                return false;
            }
        }

        //model login 
        function proses_login($username,$password)
        {
            $password_hash = md5($password);
            $row = $this->db->prepare('SELECT * FROM t_user WHERE username=? AND password=?');
            $row->execute(array($username, $password_hash));
            $count = $row->rowCount();

            if($count > 0){
                $hasil = $row->fetch();
                if($hasil['is_verified'] == 0) {
                    return 'belum_verifikasi';
                }
                return $hasil;
            }else{
                return 'gagal';
            }
        }

        //tambah data
        public function tambah_data($tabel, $data)
        {
            $id_user = $data['id_user'];
            $tgl_pengaduan = $data['tgl_pengaduan'];
            $isi_laporan = $data['isi_laporan'];
            $ft = $_FILES['foto']['name'];
            $tmp = $_FILES['foto']['tmp_name'];
            move_uploaded_file($tmp,'../upload/'.$ft);
        
            $sql = "INSERT INTO $tabel (id_user, tgl_pengaduan, isi_laporan, foto, status) 
            VALUES ('$id_user', '$tgl_pengaduan', '$isi_laporan', '$ft', 0)";

            $save = $this->db->prepare($sql);
            return $save->execute();
        }

        //tampil data harian
        function tampil_data_harian($tabel, $user)
        {
            $row = $this->db->prepare("SELECT * FROM $tabel WHERE tgl_pengaduan = DATE(NOW())");
            $row->execute();
            return $hasil = $row->fetchAll();
        }

        //hapus data
        function hapus_data($tabel,$where,$id)
        {
            $sql = "DELETE FROM $tabel WHERE $where = ?";
            $row = $this->db->prepare($sql);
            return $row ->execute(array($id));
        }

        //hapus akun
        function hapus_akun($tabel,$where,$id)
        {
            $sql = "DELETE FROM $tabel WHERE $where = ?";
            $row = $this->db->prepare($sql);
            return $row ->execute(array($id));
        }

        //tampil data berdasarkan id
        function tampil_data_id($tabel,$where,$id)
        {
            $row = $this->db->prepare("SELECT * FROM $tabel WHERE $where = ?");
            $row->execute(array($id));
            return $hasil = $row->fetch();
        }

        //edit
        public function edit_data($data = array(), $tabel, $where, $id)
        {
            $tgl_pengaduan = $data['tgl_pengaduan'];
            $isi_laporan = $data['isi_laporan'];
            
            // Cek apakah user mengunggah foto baru
            if($_FILES['foto']['name'] != '') {
                $ft = $_FILES['foto']['name'];
                $tmp = $_FILES['foto']['tmp_name'];
                move_uploaded_file($tmp, '../upload/'.$ft);
            } else {
                $ft = $_POST['foto_lama'];
            }

            $sql = "UPDATE $tabel SET tgl_pengaduan = '$tgl_pengaduan', isi_laporan = '$isi_laporan', foto = '$ft' WHERE $where = '$id'";
            $result = $this->db->prepare($sql);
            return $result->execute();
        }

        //mingguan
        function tampil_data_mingguan($tabel, $user)
        {
            $nows=strtotime(date('Y-m-d'));
            $start=date('Y-m-d',strtotime('-7 day', $nows));
            $end = date('Y-m-d');
            $row = $this->db->prepare("SELECT * FROM $tabel WHERE tgl_pengaduan between '$start' AND '$end' ORDER BY tgl_pengaduan DESC");
            $row->execute();
            return $hasil = $row->fetchAll();
        }

        //data bulanan
        function tampil_data_bulanan($tabel, $user)
        {
            $nows=strtotime(date('Y-m-d'));
            $start=date('Y-m-01');
            $end = date('Y-m-t');
            $row = $this->db->prepare("SELECT * FROM $tabel WHERE tgl_pengaduan between '$start' AND '$end' ORDER BY tgl_pengaduan DESC");
            $row->execute();
            return $hasil = $row->fetchAll();
        }

        //tampil data seluruhnya
        function tampil_data_pengaduan($tabel, $user)
        {
            $row = $this->db->prepare("SELECT * FROM $tabel WHERE status = 0");
            $row->execute();
            return $hasil = $row->fetchAll();
        }

        //tampil data pengaduan per id
        function tampil_data_pengaduan_id($tabel, $user)
        {
            $row = $this->db->prepare("SELECT * FROM $tabel WHERE id_user=$user");
            $row->execute();
            return $hasil = $row->fetchAll();
        }

        //tambah data tanggapan
        public function tambah_tanggapan($tabel, $data)
        {
            $id_user = $data['id_user'];
            $id_pengaduan = $data['id_pengaduan'];
            $tgl_tanggapan = date('Y-m-d');
            $tanggapan = $data['tanggapan'];
        
            $sql = "INSERT INTO $tabel (tgl_tanggapan, tanggapan, id_pengaduan, id_user) 
            VALUES ('$tgl_tanggapan', '$tanggapan', '$id_pengaduan', '$id_user')";

            $save = $this->db->prepare($sql);
            return $save->execute();
        }

        public function editstatus($tabelubah, $where, $id){
            $sql = "UPDATE $tabelubah SET status = 1 WHERE $where = '$id'";
            $save = $this->db->prepare($sql);
            return $save->execute();
        }

        //tampil data tanggapan per id
        function tampil_data_tanggapan($tabel,$where,$id)
        {
            $row = $this->db->prepare("SELECT * FROM $tabel WHERE $where = ?");
            $row->execute(array($id));
            return $hasil = $row->fetch();
        }
        
        function tampil_data_tang($tabel, $user)
        {
            $row = $this->db->prepare("SELECT * FROM $tabel WHERE id_user=$user");
            $row->execute();
            return $hasil = $row->fetchAll();
        }

        // FUNGSI DASHBOARD
        public function hitung_total_pengaduan()
        {
            $row = $this->db->prepare("SELECT COUNT(id_pengaduan) as total FROM t_pengaduan");
            $row->execute();
            $hasil = $row->fetch();
            return $hasil['total'];
        }

        public function hitung_pengaduan_pending()
        {
            $row = $this->db->prepare("SELECT COUNT(id_pengaduan) as total FROM t_pengaduan WHERE status = 0");
            $row->execute();
            $hasil = $row->fetch();
            return $hasil['total'];
        }

        public function hitung_total_masyarakat()
        {
            $row = $this->db->prepare("SELECT COUNT(id_user) as total FROM t_user WHERE level = 3");
            $row->execute();
            $hasil = $row->fetch();
            return $hasil['total'];
        }
    }
?>