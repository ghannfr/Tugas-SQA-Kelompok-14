# Software Requirements Specification (SRS)
**Proyek:** Simple Multi-Vendor Website
**Versi:** 1.0

## 1. Pendahuluan
### 1.1 Tujuan
Dokumen ini bertujuan untuk memberikan deskripsi komprehensif mengenai spesifikasi kebutuhan perangkat lunak untuk aplikasi Simple Multi-Vendor Website. Dokumen ini akan menjadi acuan bagi tim pengembang dan tim QA (*Quality Assurance*) dalam proses perancangan dan pengujian sistem.

### 1.2 Ruang Lingkup
Perangkat lunak ini adalah sebuah website *e-commerce multi-vendor* yang dibangun menggunakan *framework* Django (Python). Sistem ini memfasilitasi tiga jenis interaksi utama:
- **Vendor (Toko):** Dapat mendaftar, mengelola profil, dan menambahkan produk mereka ke platform.
- **User (Pembeli):** Dapat melihat produk, melakukan *checkout*, dan membayar pesanan menggunakan Kartu Debit/Kredit.
- **Admin:** Memiliki hak akses penuh untuk mengelola master data (kategori, produk, pengguna, dan pesanan keseluruhan).

### 1.3 Definisi, Istilah, dan Singkatan
- **Vendor:** Pemilik toko atau penjual independen yang menawarkan produk di dalam website.
- **Stripe:** Layanan *payment gateway* pihak ketiga yang digunakan untuk memproses transaksi kartu kredit/debit secara aman.
- **Django:** *Framework* pengembangan web yang ditulis menggunakan bahasa pemrograman Python.
- **Virtual Environment (venv):** Lingkungan virtual terisolasi untuk menginstal pustaka perangkat lunak.

### 1.4 Referensi
- Repositori Proyek: `https://github.com/vijaythapa333/simple-multivendor-site`
- File `README.md` dokumentasi proyek.

### 1.5 Teknologi yang Digunakan
- **Bahasa Pemrograman:** Python (versi terbaru)
- **Web Framework:** Django
- **Payment Processor:** Stripe
- **Package Manager:** Pip
- **Version Control:** Git

### 1.6 Gambaran Umum Dokumen
#### 1.6.1 Deskripsi Gambaran Umum
Dokumen ini dibagi menjadi dua bagian utama. Bagian pertama berisi pendahuluan yang mencakup tujuan, ruang lingkup, dan teknologi proyek. Bagian kedua menjabarkan deskripsi umum sistem, termasuk perspektif antarmuka, karakteristik pengguna, dan batasan perangkat lunak.

#### 1.6.2 Kebutuhan Fungsional
Berikut adalah rincian kebutuhan fungsional utama berdasarkan hak akses pengguna:

**A. Kebutuhan Fungsional Admin:**
1. Sistem harus memungkinkan Admin untuk mengelola kategori produk (Tambah, Perbarui, Filter, dan Hapus).
2. Sistem harus memungkinkan Admin untuk mengelola produk yang ada di platform (Tambah, Perbarui, Filter, dan Hapus).
3. Sistem harus memungkinkan Admin untuk mengelola data pengguna/Vendor (Perbarui, Filter, dan Hapus).
4. Sistem harus memungkinkan Admin untuk melihat dan memproses seluruh pesanan yang masuk.

**B. Kebutuhan Fungsional Vendor (Penjual):**
1. Sistem harus menyediakan fitur bagi Vendor untuk menambahkan produk baru ke katalog toko mereka.
2. Sistem harus memungkinkan Vendor untuk memperbarui profil akun toko.
3. Sistem harus dapat secara otomatis mengirimkan notifikasi email kepada Vendor ketika ada pesanan baru dari User.
4. Sistem harus menyediakan fitur bagi Vendor untuk melihat detail dan mengelola pesanan mereka.

**C. Kebutuhan Fungsional User (Pembeli):**
1. Sistem harus memungkinkan User untuk menambahkan produk ke dalam keranjang belanja (*Add to Cart*).
2. Sistem harus menyediakan fitur *checkout* dengan dukungan pembayaran menggunakan Kartu Debit/Kredit.
3. Sistem harus mewajibkan User untuk mengisi formulir alamat pengiriman saat melakukan *checkout*.
4. Sistem harus mengirimkan notifikasi email otomatis kepada User sebagai konfirmasi bahwa pesanan telah berhasil dibuat.

---

## 2. Deskripsi Umum
### 2.1 Perspektif Produk
Simple Multi-Vendor Website adalah sistem *e-commerce* berbasis web independen. Sistem ini bertindak sebagai perantara digital (*marketplace*) yang menghubungkan berbagai penjual independen ke dalam satu wadah etalase untuk bertransaksi dengan pembeli.

### 2.2 Software Interface
- Antarmuka pengguna (*User Interface*) diakses menggunakan peramban web (*web browser*) modern.
- Sistem berinteraksi secara *backend* dengan API Stripe untuk pemrosesan dan verifikasi transaksi keuangan.

### 2.3 Hardware Interface
- **Sisi Klien:** Perangkat komunikasi keras (PC, Laptop, atau Smartphone) yang terkoneksi internet.
- **Sisi Server:** Server komputasi (lokal atau komersial) yang kompatibel menjalankan *environment* instalasi Python.

### 2.4 Manfaat Produk
- Mengakomodasi kebutuhan banyak penjual untuk membuka toko digital secara praktis tanpa merancang website mandiri.
- Mempermudah pembeli untuk berbelanja produk dari berbagai toko (vendor) berbeda hanya dalam satu proses pemesanan.
- Menjamin keamanan transaksi non-tunai dengan integrasi prosesor pembayaran global.

### 2.5 Karakteristik User
1. **Admin:** Bertindak sebagai pengawas (*superuser*), diasumsikan memiliki pemahaman teknis sistem untuk memelihara operasional kategori dan pengguna.
2. **Vendor:** Pengguna dengan tingkat literasi digital dasar yang mampu mengelola inventaris produk, mengunggah foto, dan memantau antrean pesanan.
3. **User (Pembeli):** Konsumen umum yang memiliki akses ke instrumen pembayaran kartu dan mampu melakukan navigasi pemesanan barang *online*.

### 2.6 Batasan-Batasan
- Kelancaran transaksi *checkout* memiliki ketergantungan mutlak pada ketersediaan dan responsivitas server API Stripe.
- Sistem mewajibkan konfigurasi `ALLOWED_HOSTS` khusus pada file `settings.py` agar aplikasi dapat dijalankan dari sisi server.

### 2.7 Asumsi dan Ketergantungan
- Diasumsikan seluruh aktivitas pendaftaran profil (Vendor dan User) menggunakan alamat email yang valid dan aktif untuk memastikan fitur notifikasi berjalan semestinya.
- Bergantung pada manajer paket `pip` untuk memastikan semua *requirements* pendukung aplikasi terinstal dengan sempurna pada lingkungan virtual.
