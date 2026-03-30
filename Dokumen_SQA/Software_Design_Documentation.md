# Software Design Documentation (SDD)
**Proyek:** Simple Multi-Vendor Website
**Versi:** 1.0
**Tanggal:** [Masukkan Tanggal Hari Ini]

## 1. Pendahuluan
### 1.1 Tujuan
Tujuan dari dokumen ini adalah untuk memberikan rincian rancangan teknis dari sistem *Simple Multi-Vendor Website*. Dokumen ini menjelaskan bagaimana kebutuhan fungsional ditransformasikan ke dalam struktur perangkat lunak, model data, dan rancangan antarmuka.

### 1.2 Ruang Lingkup
Dokumen rancangan ini mencakup arsitektur *backend* menggunakan Django, integrasi sistem pembayaran Stripe, serta perancangan basis data untuk mendukung interaksi antara Admin, Vendor, dan Pembeli (User).

### 1.3 Gambaran Umum Dokumen
Dokumen ini terbagi menjadi tiga bagian utama: Pendahuluan, Deskripsi Umum Sistem, dan Detail Rancangan Perangkat Lunak (*Software Design*) yang mencakup model diagram dan arsitektur sistem.

---

## 2. Deskripsi Umum
### 2.1 Perspektif Produk
Sistem ini dirancang sebagai platform web *e-commerce* terpusat yang mendukung banyak penjual (*multi-vendor*). Arsitekturnya memisahkan logika bisnis (Django), penyimpanan data (Database), dan layanan pihak ketiga (Stripe API).

### 2.2 Manfaat Produk
- Mempermudah integrasi pembayaran global bagi penjual lokal melalui Stripe.
- Memberikan struktur data yang terorganisir untuk manajemen stok dan pesanan dari berbagai vendor dalam satu dasbor.

### 2.3 Karakteristik User
- **Admin:** Memiliki kontrol penuh atas integritas data kategori dan pengguna.
- **Vendor:** Fokus pada pengelolaan katalog produk dan pemenuhan pesanan pelanggan.
- **User (Buyer):** Berinteraksi dengan antarmuka belanja untuk mencari, memesan, dan membayar produk.

### 2.4 Batasan-Batasan
- Sistem memerlukan koneksi internet aktif untuk proses verifikasi pembayaran.
- Perancangan ini didasarkan pada lingkungan Python Django; migrasi ke *framework* lain akan memerlukan desain ulang arsitektur.

---

## 3. Software Design
### 3.1 Kebutuhan Fungsional
Rancangan ini mendukung fungsi utama:
- Registrasi dan manajemen profil Vendor.
- Katalogisasi produk dengan filter kategori.
- Sistem keranjang belanja (*Cart*) dan *checkout*.
- Integrasi notifikasi email untuk konfirmasi pesanan.

### 3.2 Kebutuhan Interface
- **User Interface:** Web responsif berbasis HTML/CSS.
- **API Interface:** Integrasi dengan API Stripe untuk transaksi kartu kredit/debit.

### 3.3 Lingkungan Operasi
- **Sistem Operasi:** Windows/Linux/MacOS.
- **Web Server:** Django Development Server (port 8000).
- **Database:** SQLite (default Django) atau PostgreSQL/MySQL.

### 3.4 Batas Perancangan
Sistem dirancang untuk skala kecil hingga menengah. Perancangan keamanan terfokus pada penggunaan sistem autentikasi bawaan Django dan enkripsi data transaksi oleh pihak ketiga (Stripe).

### 3.5 Model Data
*(Catatan: Untuk kebutuhan tugas SQA, bagian ini mendeskripsikan alur logika sistem).*

#### 3.5.1 Use Case Diagram
- **Aktor:** Admin, Vendor, User.
- **Aktivitas Utama:** - User: Browse Produk, Add to Cart, Checkout.
  - Vendor: Add Product, View Order Notification.
  - Admin: Manage Category, Manage Users.

#### 3.5.2 Activity Diagram
Menjelaskan alur belanja: Mulai -> Pilih Produk -> Masuk Keranjang -> Isi Alamat -> Bayar (Stripe) -> Notifikasi Email -> Selesai.

#### 3.5.3 Sequence Diagram
Menjelaskan urutan pesan antara User, Website, dan Stripe API saat proses pembayaran berlangsung.

#### 3.5.4 Class Diagram
Mencakup entitas utama:
- **User:** id, username, password, email, role.
- **Product:** id, vendor_id, name, description, price, category.
- **Order:** id, user_id, total_price, address, status.

#### 3.5.5 Object Diagram
Contoh instansiasi data: Objek "Sepatu" sebagai *Product* yang dimiliki oleh "Toko A" sebagai *Vendor*.

### 3.6 Rancangan Arsitektur Sistem
Sistem menggunakan pola arsitektur **MVT (Model-View-Template)**:
- **Model:** Mengelola struktur basis data.
- **View:** Menangani logika bisnis dan permintaan pengguna.
- **Template:** Mengatur tampilan antarmuka kepada pengguna.

### 3.7 Rancangan Interface Halaman
- **Halaman Beranda:** Menampilkan produk populer dan kategori.
- **Halaman Produk:** Detail deskripsi, harga, dan tombol "Add to Cart".
- **Halaman Dashboard Vendor:** Grafik penjualan dan form tambah produk.
- **Halaman Checkout:** Formulir alamat dan *input* kartu kredit Stripe.
