## 🛠️ EVALUASI PBF

### 1. Clone Repository

Clone repositori backend ke dalam direktori lokal:

```bash
git clone https://github.com/AlfitoAdityaProtic/Latihan-BE-Evaluasi-PBF.git
```

### 2. Install Dependensi

Install semua dependensi yang dibutuhkan menggunakan Composer:

```bash
composer install
```

### 3. Konfigurasi Environment

Salin file `.env.example` menjadi `.env` dan atur konfigurasi database:

```bash
cp env .env
```

Edit file `.env` dan sesuaikan dengan koneksi database lokal kamu:

```ini
database.default.hostname = localhost
database.default.database = nama_database_anda
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
```

### 4. Buat Database dan Import Dummy Data

* Buat database baru di MySQL, misalnya: `evaluasi_pbf`
* Import file SQL berikut ke dalam database tersebut:

```sql
CREATE TABLE `dosens` (
  `nama` varchar(100) NOT NULL,
  `nidn` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `prodi` varchar(100) NOT NULL,
  PRIMARY KEY (`nidn`)
);

INSERT INTO `dosens` (`nama`, `nidn`, `email`, `prodi`) VALUES
('Dr. Bambang', '12345678', 'bambang@kampus.ac.id', 'Teknik Informatika'),
('Dr. Siti', '87654321', 'siti@kampus.ac.id', 'Sistem Informasi');

CREATE TABLE `mahasiswas` (
  `nama` varchar(100) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `prodi` varchar(100) NOT NULL,
  `prodi` varchar(100) NOT NULL,
  `wali_dosen_id` varchar(20) NOT NULL,
  PRIMARY KEY (`nim`)
);

INSERT INTO `mahasiswas` (`nama`, `nim`, `email`, `prodi`, `wali_dosen_id`) VALUES
('Andi Saputra', '210001', 'andi@kampus.ac.id', 'Teknik Informatika','<isikan nidn dari table dosens>'),
('Rina Melati', '210002', 'rina@kampus.ac.id', 'Sistem Informasi','<isikan nidn dari table dosens>');
```
* notes : buat foreign key `mahasiswas.wali_dosen_id` ke `dosens.nidn` dengan `on delete` cascade dan `on update` cascade

### 5. Jalankan Server Development

```bash
php spark serve
```

Server akan berjalan di `http://localhost:8080`

### 6. Cek Endpoint API Menggunakan Postman

Gunakan Postman untuk mengetes endpoint berikut:

#### Dosen

* `GET` → `http://localhost:8080/dosen`
* `POST` → `http://localhost:8080/dosen`
* `PUT` → `http://localhost:8080/dosen/{id}`
* `DELETE` → `http://localhost:8080/dosen/{id}`

#### Mahasiswa

* `GET` → `http://localhost:8080/mahasiswa`
* `POST` → `http://localhost:8080/mahasiswa`
* `PUT` → `http://localhost:8080/mahasiswa/{id}`
* `DELETE` → `http://localhost:8080/mahasiswa/{id}`

### 7. Tugas Mahasiswa (Frontend Laravel)

> Buatlah tampilan frontend menggunakan Laravel yang dapat melakukan **CRUD data Dosen dan Mahasiswa** dengan mengonsumsi API di atas.

---
