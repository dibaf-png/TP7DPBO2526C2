# Janji

Saya Farah Diba Nur Malinda dengan NIM 2502083 mengerjakan Tugas Praktikum 7 dalam mata kuliah Desain dan Pemrograman Berorientasi Objek untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin

---

# Sistem Jual Beli Jabatan di Pemerintahan

Proyek ini bertujuan untuk mengimplementasikan alur kerja Model View Controller (MVC), penggunaan PDO (PHP Data Objects), dan Prepared Statements untuk keamanan. Proyek ini juga dibuat menggunakan PHP Native dengan menerapkan konsep Object Oriented Programming (OOP)

---

# Penjelasan Fitur Utama

* **Manajemen Instansi (`departments`):** Melakukan operasi CRUD (*Create, Read, Update, Delete*) untuk mendata instansi atau dinas pemerintahan yang menjadi objek transaksi.
* **Manajemen Posisi Jabatan (`positions`):** Melakukan operasi CRUD (*Create, Read, Update, Delete*) untuk mengelola daftar posisi/jabatan strategis lengkap dengan pengaturan kuota kursi dan nominal mahar suap (didukung validasi angka non-negatif dan batas maksimal).
* **Manajemen Kandidat Pejabat (`candidates`):** Melakukan operasi CRUD (*Create, Read, Update, Delete*) untuk mengelola data profil calon pejabat, nomor KTP, nomor telepon, hingga sumber kekayaan/aset yang digunakan untuk melamar jabatan.
* **Manajemen Transaksi Suap (`transactions`):** Melakukan operasi CRUD (*Create, Read, Update, Delete*) untuk mencatat transaksi jual beli kursi jabatan dengan menghubungkan data kandidat dan posisi jabatan, dilengkapi informasi kedok pembayaran, catatan khusus, status pelantikan, dan tanggal transaksi.
* **Keamanan & Validasi Server-Side:** Seluruh data masukan dibersihkan menggunakan `trim()`, diperiksa tipe datanya (`is_numeric()`), serta dicegah dari nilai kosong atau negatif pada level model sebelum masuk ke database.

---

# Penjelasan Struktur Database

Database yang digunakan bernama `db_jualbeli`, terdiri dari 4 tabel utama yang saling berelasi menggunakan *Foreign Key*:

* **`departments`**
  * Menyimpan daftar master instansi/dinas.
  * Kolom utama: `id` (Primary Key), `dept_code` (Kode Dinas), `dept_name` (Nama Instansi).
* **`positions`**
  * Menyimpan daftar posisi jabatan dan besaran mahar.
  * Kolom utama: `id`, `department_id` (Foreign Key ke `departments`), `position_name`, `price`, `quota`.
* **`candidates`**
  * Menyimpan data diri calon pejabat pembeli kursi.
  * Kolom utama: `id`, `name`, `no_ktp`, `no_phone`, `wealth_source`.
* **`transactions`**
  * Entitas utama pencatatan transaksi suap.
  * Kolom utama: `id`, `candidate_id` (Foreign Key ke `candidates`), `position_id` (Foreign Key ke `positions`), `amount_paid`, `payment_method`, `note`, `status`, `transaction_date`.

<img width="1027" height="389" alt="db" src="https://github.com/user-attachments/assets/4f44b570-cb40-494b-ba6d-2b0c738182bf" />

---

# Struktur Direktori & Fungsi File

Berikut rincian direktori proyek **`program`** beserta penjelasan isi dan fungsi masing-masing berkas:
```text
program/
├── config/
│   └── db.php             # Mengelola koneksi database MySQL menggunakan PDO dengan Exception Handling
├── class/
│   ├── Department.php     # Class model untuk logika data Instansi & validasi server-side
│   ├── Position.php       # Class model untuk logika data Jabatan/Mahar, relasi JOIN, & validasi angka
│   ├── Candidate.php      # Class model untuk logika data Kandidat Pejabat & validasi input
│   └── Transaction.php    # Class model untuk pencatatan Transaksi Suap & validasi pembayaran
├── view/
│   ├── header.php         # Komponen layout atas (navigasi & tajuk utama bernuansa satire)
│   ├── footer.php         # Komponen layout bawah (hak cipta & footer halaman)
│   ├── departments.php    # Antarmuka pengguna (UI) & form input untuk entitas Instansi
│   ├── positions.php      # Antarmuka pengguna (UI) & form input untuk entitas Jabatan
│   ├── candidates.php     # Antarmuka pengguna (UI) & form input untuk entitas Kandidat
│   └── transactions.php   # Antarmuka pengguna (UI) & form input untuk entitas Transaksi Suap
├── index.php              # Front Controller & Router utama yang mengatur alur logika request (GET/POST)
└── style.css              # Berkas Cascading Style Sheets kustom dengan tema visual Dark & Flame (Hitam & Oranye)

```

---

# Dokumentasi Video

Dokumentasi demonstrasi aplikasi dapat diakses melalui tautan berikut: 

👉 [Tonton Video Demo Proyek (Google Drive)](https://drive.google.com/drive/folders/1if546ZTGiG_G1XjFuePEOEnMRFwmLkaq?usp=sharing)




