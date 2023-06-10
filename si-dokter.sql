-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 26 Bulan Mei 2023 pada 15.09
-- Versi server: 10.3.38-MariaDB
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kassandr_si-dokter`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` varchar(2) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` text NOT NULL,
  `level` varchar(15) NOT NULL DEFAULT 'Administrator'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `nama`, `no_hp`, `alamat`, `email`, `password`, `level`) VALUES
('A1', 'Erik Wahyudi', '082225634392', 'Jl. H. Agus salim Dkh. Medelan Ds. Jalen Kec. Balong Kab. Ponorogo', 'admin@kassandra.com', 'd0aeca852d9004f9eab4fb139b3ec6db', 'Administrator');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_dokter`
--

CREATE TABLE `tb_dokter` (
  `id_dokter` varchar(2) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` text NOT NULL,
  `level` varchar(6) NOT NULL DEFAULT 'Dokter'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_dokter`
--

INSERT INTO `tb_dokter` (`id_dokter`, `nama`, `no_hp`, `email`, `password`, `level`) VALUES
('D1', 'Dr. Bambang, SpOG', '123', 'bambang@gmail.com', '202cb962ac59075b964b07152d234b70', 'Dokter');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_informasi`
--

CREATE TABLE `tb_informasi` (
  `id_informasi` varchar(2) NOT NULL,
  `title` varchar(50) NOT NULL,
  `informasi` text NOT NULL,
  `file_informasi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_informasi`
--

INSERT INTO `tb_informasi` (`id_informasi`, `title`, `informasi`, `file_informasi`) VALUES
('i1', 'Informasi Si-Antri Pe-Dok', '<p><strong>Apa yang harus saya lakukan jika belum punya akun di Aplikasi Si-Antri Pe-Dok (Sistem Antrian Periksa Dokter) ?</strong></p>\r\n\r\n<p>1. Silahkan mendaftar terlebih dahulu dengan mengisikan nama, no hp, alamat serta data lainnya yang diperlukan.</p>\r\n\r\n<p>2. Jika sudah silahkan login dengan memasukan nama atau no hp atau email dan password yang kamu buat tadi.</p>\r\n\r\n<p>3. Selanjutnya pada tampilan menu utama ada tombol <u><em>Daftar Periksa Sekarang</em></u>, Klik tombol tersebut maka kamu akan diarahkan ke halaman menu&nbsp;<em><u>Buat Jadwal Periksa</u></em><em><u>&nbsp;</u></em>selanjutnya kamu akan disuruh mengiisi data yang diperlukan seperti memilih tanggal periksa yang diinginkan dan klik tombol <u><em>submit</em></u></p>\r\n\r\n<p>5. Jika sudah maka jadwal periksa kamu akan muncul dihalaman utama sesuai urutan antrian mendaftar.</p>\r\n\r\n<p><strong>Jika sudah punya akun, apa yang akan saya lakukan ?</strong></p>\r\n\r\n<ul>\r\n	<li>Cukup melakukan perintah dari urutan no 2 - 4 saja ya, tidak perlu membuat akun baru lagi, karena data akun kamu sudah tersimpan di database..</li>\r\n</ul>\r\n\r\n<p><strong>Jika sudah punya akun tetapi lupa password ?</strong></p>\r\n\r\n<ul>\r\n	<li>Kamu bisa melakukan reset password pada menu reset password yang ada di halaman login bagian bawah ( klik lupa password) atau klik link berikut</li>\r\n	<li>Kemudian masukkan akun email yang kamu gunakan mendaftar diawal dan pastikan akun email masih aktif di perangkat kamu jika tidak bisa menghubungi admin dengan mengklik <em><u>hubungi admin</u></em></li>\r\n</ul>\r\n', 'informasi_645ae61fa903f.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pasien`
--

CREATE TABLE `tb_pasien` (
  `id_pasien` varchar(50) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  `tgl_lahir` date NOT NULL,
  `nama_suami` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `level` varchar(6) NOT NULL DEFAULT 'Pasien'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_pasien`
--

INSERT INTO `tb_pasien` (`id_pasien`, `nama`, `no_hp`, `alamat`, `tgl_lahir`, `nama_suami`, `email`, `password`, `level`) VALUES
('P001CGk4mc', 'Bumil', '123456789', 'Ponorogo', '2000-07-06', 'Pakmil', 'bumil@gmail.com', '202cb962ac59075b964b07152d234b70', 'Pasien'),
('P002dBPSbJ', 'Ani Handayani', '085877711122', 'Ds. Balong Kec. Balong Kab. Ponorogo', '1998-03-05', 'Budi Doremi', 'ani@gmail.com', '202cb962ac59075b964b07152d234b70', 'Pasien'),
('P003Nx9QKZ', 'fannisa', '1234', 'Balong Ponorogo', '2001-02-07', 'bpk fan', 'fannisa@gmail.com', '202cb962ac59075b964b07152d234b70', 'Pasien'),
('P004Aoz0J8', 'Arfiana', '12345', 'ponorogo kota', '2000-07-06', 'bpk ran', 'rani@gmail.com', '202cb962ac59075b964b07152d234b70', 'Pasien'),
('P005DV4Tpr', 'rika', '1111', 'jenangan', '1999-02-01', 'bpk rika', 'rika@gmail.com', '202cb962ac59075b964b07152d234b70', 'Pasien'),
('P006x7EQbK', 'maftika', '19122', 'Madiun Kota', '2001-03-05', 'bpk tika', 'maftika@gmail.com', '202cb962ac59075b964b07152d234b70', 'Pasien'),
('P007FBpi18', 'Dika Rizka Fadhila', '128271', 'Balong Ponorogo', '2000-05-08', 'bpk dika', 'dila@gmail.com', '202cb962ac59075b964b07152d234b70', 'Pasien'),
('P008bYtAC3', 'shinta indriana', '01816765', 'Ngasinan Jetis', '2001-01-01', 'bp sinta', 'sinta@gmail.com', '202cb962ac59075b964b07152d234b70', 'Pasien'),
('P009IDF7Ma', 'Rani Dwi kartikasari', '115225', 'Babadan Ponorogo', '1998-11-11', 'bp arfi', 'arfi@gmail.com', '202cb962ac59075b964b07152d234b70', 'Pasien'),
('P010HIE3cs', 'Mahalini', '7332911', 'Ponorogo Kota', '1992-03-09', 'bp riski', 'lini@gmail.com', '202cb962ac59075b964b07152d234b70', 'Pasien'),
('P011lYuvYQ', 'ais', '6181616', 'Jl. Agus Salim Rt. 007 Rw. 003 Medelan, Jalen Kec. Balong Kabupaten Ponorogo, Jawa Timur 63461, Indonesia', '1996-05-11', 'budi', 'ais@gmai.com', '202cb962ac59075b964b07152d234b70', 'Pasien');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengaturan`
--

CREATE TABLE `tb_pengaturan` (
  `id_pengaturan` varchar(7) NOT NULL,
  `nama_judul` varchar(50) NOT NULL,
  `meta_keywords` text NOT NULL,
  `meta_description` text NOT NULL,
  `jdwl_praktek` varchar(15) NOT NULL,
  `jam_praktek` time NOT NULL,
  `jdwl_pendaftaran` varchar(50) NOT NULL,
  `akses_pendaftaran` enum('Buka','Tutup') NOT NULL,
  `logo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_pengaturan`
--

INSERT INTO `tb_pengaturan` (`id_pengaturan`, `nama_judul`, `meta_keywords`, `meta_description`, `jdwl_praktek`, `jam_praktek`, `jdwl_pendaftaran`, `akses_pendaftaran`, `logo`) VALUES
('P1xhDwL', 'Si-Antri Pe-Dok', 'Sistem Antrian Periksa Dokter', 'Klinik Praktik Dr. Bambang Sp.OG', 'Senin ~ Jum\'at', '05:00:00', 'Setiap hari Minggu', 'Buka', 'header_646ac6a9377f2.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_periksa`
--

CREATE TABLE `tb_periksa` (
  `id_antrian` varchar(50) NOT NULL,
  `id_pasien` varchar(50) NOT NULL,
  `kode_antrian` varchar(4) NOT NULL,
  `mens_terakhir` date NOT NULL,
  `keluhan` text NOT NULL,
  `tgl_periksa` date NOT NULL,
  `catatan` text NOT NULL,
  `waktu_keluar` time NOT NULL,
  `status` enum('PV','BTL','ANTRI','DIPERIKSA','S') NOT NULL,
  `uuid` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_periksa`
--

INSERT INTO `tb_periksa` (`id_antrian`, `id_pasien`, `kode_antrian`, `mens_terakhir`, `keluhan`, `tgl_periksa`, `catatan`, `waktu_keluar`, `status`, `uuid`) VALUES
('A001pYlhK', 'P011lYuvYQ', 'h0Tf', '2023-04-10', 'mencoba mengeluh', '2023-05-26', 'isitirahat yang cukup', '10:02:09', 'S', 'lipjPKw8rmQwgT5i'),
('A002xnoB3', 'P010HIE3cs', 'RDku', '2023-04-30', 'mengapa harus ada keluhan', '2023-05-26', 'qwert', '10:54:38', 'S', 'wmmxrGw46cFJSEPD'),
('A003W8c1V', 'P009IDF7Ma', 'Db2n', '2023-04-30', 'ingin ku berkata apa saja', '2023-05-26', '', '00:00:00', 'DIPERIKSA', 'kxRVz4RzoJvHhkcG'),
('A004WZG05', 'P008bYtAC3', 'HgaC', '2023-05-01', 'Sebenrnya saya ingin mengeluh', '2023-05-26', '', '00:00:00', 'ANTRI', 'kqLgDrmdR6O9iceb'),
('A005kdtmJ', 'P006x7EQbK', 'bTVn', '2023-05-01', 'pengin check aja', '2023-05-26', '', '00:00:00', 'ANTRI', 'QmxUuAkcIbA0w4Aj'),
('A006ccaSF', 'P005DV4Tpr', 'Xx3D', '2023-05-01', 'perut kembung', '2023-05-26', '', '00:00:00', 'ANTRI', 'LBZUs7znhInd2xVr'),
('A007LyRlL', 'P004Aoz0J8', 'uK3k', '2023-04-18', 'rindu seseorang', '2023-05-26', '', '00:00:00', 'PV', '6xt47UaDXauTkYgm'),
('A008lSCvR', 'P003Nx9QKZ', 'FSSM', '2023-05-01', 'ingin bahagia bersamanya', '2023-05-26', '', '00:00:00', 'PV', 'qicFwFn249p0rMYr'),
('A009PiG2q', 'P002dBPSbJ', 'pzJN', '2023-05-03', 'hmmm aku tak tahu', '2023-05-26', '', '00:00:00', 'PV', 'ckhzKJH5f5OBhdq3'),
('A010ayyb2', 'P001CGk4mc', 'e1eI', '2023-04-30', 'orang hamil biasanya keluhan apa gitu', '2023-05-26', '', '00:00:00', 'BTL', '2jchyMpWkTvzoNba'),
('A011UCTM1', 'P007FBpi18', 'ToWv', '2023-04-30', 'hatiku rapuh', '2023-05-26', 'selesai', '10:44:45', 'S', 'k9MqGsbBBdjEGX8i');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `tb_dokter`
--
ALTER TABLE `tb_dokter`
  ADD PRIMARY KEY (`id_dokter`);

--
-- Indeks untuk tabel `tb_informasi`
--
ALTER TABLE `tb_informasi`
  ADD PRIMARY KEY (`id_informasi`);

--
-- Indeks untuk tabel `tb_pasien`
--
ALTER TABLE `tb_pasien`
  ADD PRIMARY KEY (`id_pasien`);

--
-- Indeks untuk tabel `tb_periksa`
--
ALTER TABLE `tb_periksa`
  ADD PRIMARY KEY (`id_antrian`),
  ADD KEY `id_pasien` (`id_pasien`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_periksa`
--
ALTER TABLE `tb_periksa`
  ADD CONSTRAINT `tb_periksa_ibfk_1` FOREIGN KEY (`id_pasien`) REFERENCES `tb_pasien` (`id_pasien`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
