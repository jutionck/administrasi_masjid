-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 19 Agu 2020 pada 12.13
-- Versi server: 10.1.45-MariaDB-cll-lve
-- Versi PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mipdevpc_masjid`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_aset`
--

CREATE TABLE `m_aset` (
  `idaset` int(11) NOT NULL,
  `tgl_aset` date DEFAULT NULL,
  `namaaset` varchar(100) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `harga` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `keterangan` enum('Baik','Rusak') DEFAULT 'Baik',
  `id_masjid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `m_aset`
--

INSERT INTO `m_aset` (`idaset`, `tgl_aset`, `namaaset`, `jumlah`, `harga`, `total`, `keterangan`, `id_masjid`) VALUES
(1, '2019-10-06', 'AC Daikin_FTC 50NV14', 2, 0, 0, 'Baik', 3),
(2, '2019-10-01', 'AC Daikin_Fine Somv14', 1, 0, 0, 'Baik', 3),
(3, '2019-10-01', 'AC _Sharp_Lantai  2', 2, 0, 0, 'Baik', 3),
(4, '2019-10-01', 'AC_ Panasonic_CS_PCGNKJ', 7, 0, 0, 'Baik', 3),
(5, '2019-10-01', 'Kipas Tornado_Regency', 4, 0, 0, 'Baik', 3),
(6, '2019-10-01', 'AC_Daikin_FTNE50MV14', 1, 0, 0, 'Baik', 3),
(7, '2019-10-01', 'Kipas Angin Dinding_Miyako', 1, 0, 0, 'Baik', 3),
(8, '2019-10-01', 'Kipas Angin_Maspion', 1, 0, 0, 'Rusak', 3),
(9, '2019-10-01', 'Kipas Angin_Panasonic', 1, 0, 0, 'Baik', 3),
(10, '2019-10-01', 'Jam LED', 1, 0, 0, 'Baik', 3),
(11, '2019-10-01', 'Note Book_Acer', 1, 0, 0, 'Baik', 3),
(12, '2019-10-01', 'LCD Proyektor_View Sonic', 1, 0, 0, 'Baik', 3),
(13, '2019-10-01', 'DVR CCTV_G Lens', 1, 0, 0, 'Baik', 3),
(14, '2019-10-01', 'Power Supply CCTV Box_SPC', 1, 0, 0, 'Baik', 3),
(16, '2019-10-01', 'Monitor CCTV_LG_14', 1, 0, 0, 'Baik', 3),
(17, '2019-10-01', 'CCTV Indoor', 3, 0, 0, 'Baik', 3),
(18, '2019-10-01', 'CCTV Outdoor', 1, 0, 0, 'Baik', 3),
(19, '2019-10-01', 'Kipas Gantung', 4, 0, 0, 'Baik', 3),
(20, '2019-10-01', 'Kipas Dinding_Regency', 2, 0, 0, 'Baik', 3),
(21, '2019-10-01', 'Vacumm Cleaner', 1, 0, 0, 'Baik', 3),
(22, '2019-10-01', 'Listrik 3 Phase', 1, 0, 0, 'Baik', 3),
(23, '2019-10-01', 'Pompa Air_Jet Pump', 1, 0, 0, 'Baik', 3),
(24, '2019-10-01', 'MIXER_Yamakawa', 1, 0, 0, 'Baik', 3),
(25, '2019-10-01', 'Power/Ampli_Audio Seven Hi-S', 1, 0, 0, 'Baik', 3),
(26, '2019-10-01', 'Power/Ampli_TOA_PK_ZA2120', 1, 0, 0, 'Baik', 3),
(27, '2019-10-01', 'Power/Ampli_TZA 2060', 1, 0, 0, 'Baik', 3),
(28, '2019-10-01', 'Power/Ampli_TOA_ZA_1031', 1, 0, 0, 'Baik', 3),
(29, '2019-10-01', 'Regulator_Yamakawa_5000N', 1, 0, 0, 'Baik', 3),
(30, '2019-10-01', 'Harkis Lemari', 0, 0, 0, 'Baik', 3),
(31, '2019-10-01', 'Mic Imam_TOA', 2, 0, 0, 'Baik', 3),
(32, '2019-10-01', 'MIc Mimbar_Klazer_KR_505c', 1, 0, 0, 'Baik', 3),
(33, '2019-10-01', 'MIC Azan_Kabel Merah 15M', 1, 0, 0, 'Baik', 3),
(34, '2019-10-01', 'Kiyub+Mic_Blizer', 1, 0, 0, 'Baik', 3),
(35, '2019-10-01', 'Kiyub Putih+Mic', 1, 0, 0, 'Baik', 3),
(36, '2019-10-01', 'Speaker 16 Inchi_TOA', 8, 0, 0, 'Baik', 3),
(37, '2019-10-01', 'Speaker di Gantung di Tembok_TOA', 8, 0, 0, 'Baik', 3),
(38, '2019-10-01', 'Kotak Amal Kecil', 3, 0, 0, 'Baik', 3),
(39, '2019-10-01', 'Kotak Amal Duduk', 2, 0, 0, 'Baik', 3),
(40, '2019-10-01', 'Lemari Kecil Kaca', 1, 0, 0, 'Baik', 3),
(41, '2019-10-01', 'Lemari Kaca Mukena', 1, 0, 0, 'Baik', 3),
(42, '2019-10-01', 'Lemari Besar', 1, 0, 0, 'Baik', 3),
(43, '2019-10-01', 'Pembatas Sholat', 2, 0, 0, 'Baik', 3),
(44, '2019-10-01', 'Jam Dinding', 2, 0, 0, 'Baik', 3),
(45, '2019-10-01', 'Hiasan Dinding', 2, 0, 0, 'Baik', 3),
(46, '2019-10-01', 'Papan Laporan Kas', 2, 0, 0, 'Baik', 3),
(47, '2019-10-01', 'Papan Petugas Sholat', 1, 0, 0, 'Baik', 3),
(48, '2019-10-01', 'Papan Tulis', 1, 0, 0, 'Baik', 3),
(49, '2019-10-01', 'Kotak Sampah Besar', 1, 0, 0, 'Baik', 3),
(50, '2019-10-01', 'Mimbar Khotib', 1, 0, 0, 'Baik', 3),
(51, '2019-10-01', 'Kursi Khotib', 1, 0, 0, 'Baik', 3),
(52, '2019-10-01', 'Rak Dorong', 1, 0, 0, 'Baik', 3),
(53, '2019-10-01', 'Karpet Motif Titik Hijau', 10, 0, 0, 'Baik', 3),
(54, '2019-10-01', 'Karpet Motif Polos_Hijau', 6, 0, 0, 'Baik', 3),
(55, '2019-10-01', 'Karpet Motif Polos Merah', 9, 0, 0, 'Baik', 3),
(56, '2019-10-01', 'Kaca Dinding', 1, 0, 0, 'Baik', 3),
(57, '2019-10-01', 'Rak Sepatu Sandal', 4, 0, 0, 'Baik', 3),
(58, '2019-10-01', 'Papan Mading', 1, 0, 0, 'Baik', 3),
(59, '2019-10-01', 'Meja TPA', 11, 0, 0, 'Baik', 3),
(60, '2019-10-01', 'Meja Kecil Hitam', 1, 0, 0, 'Baik', 3),
(61, '2020-08-15', 'Mic', 5, 125000, 625000, '', 5),
(62, '2020-08-15', 'SoundSysytem', 2, 50000000, 100000000, '', 9);

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_donatur`
--

CREATE TABLE `m_donatur` (
  `id_donatur` int(11) NOT NULL,
  `nama_donatur` varchar(255) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `id_masjid` int(11) NOT NULL,
  `publish` enum('T','F') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `m_donatur`
--

INSERT INTO `m_donatur` (`id_donatur`, `nama_donatur`, `jenis_kelamin`, `alamat`, `no_hp`, `id_masjid`, `publish`) VALUES
(1, 'Hamba Allah', 'L', 'Rajabasa', '900009900', 2, 'T'),
(2, 'tes', 'L', 'polinela', '45678', 1, 'T'),
(3, 'Rusmianto', 'L', 'Polinela', '199000', 7, 'T'),
(4, 'Ali Akbar', 'L', 'Way Dadi', '087818181818', 6, 'T'),
(5, 'SUKIMAN', 'L', 'SUKARAME', '08', 3, 'T'),
(6, 'FATHUL HAYAT', 'L', 'SUKARAME', '08', 3, 'T'),
(7, 'H ROSIDI', 'L', 'SUKARAME', '08', 3, 'T'),
(8, 'NASIR', 'L', 'SUKARAME', '08', 3, 'T'),
(9, 'H ABDULLAH', 'L', 'SUKARAME', '08', 3, 'T'),
(10, 'H HERWAN', 'L', 'SUKARAME', '08', 3, 'T'),
(11, 'H ACMAD', 'L', 'SUKARAME', '08', 3, 'T'),
(12, 'H ACHLAMI', 'L', 'SUKARAME', '08', 3, 'T'),
(13, 'H NAWIRI', 'L', 'SUKARAME', '08', 3, 'T'),
(14, 'Donatur Tes', 'L', 'Bandar Lampung', '1223', 4, 'T'),
(15, 'Fulan', 'L', 'Sukarame', '082180221160', 5, 'T'),
(16, 'rusminanto', 'L', 'bfp', '5678', 9, 'T');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_masjid`
--

CREATE TABLE `m_masjid` (
  `id_masjid` int(11) NOT NULL,
  `nama_masjid` varchar(255) NOT NULL,
  `ketua` varchar(50) DEFAULT NULL,
  `sekretaris` varchar(50) DEFAULT NULL,
  `bendahara` varchar(59) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT 'logo-dkm.jpg',
  `publish` enum('T','F') NOT NULL DEFAULT 'T'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `m_masjid`
--

INSERT INTO `m_masjid` (`id_masjid`, `nama_masjid`, `ketua`, `sekretaris`, `bendahara`, `alamat`, `foto`, `publish`) VALUES
(1, '-', NULL, NULL, NULL, NULL, 'logo-dkm.jpg', 'T'),
(2, 'Al Banna', 'Zainal Arifin, M.Si.', 'Eksa Ridwansyah, S.E., M.Buss', 'Rusmianto, S.E., M.E.Akt', 'Jl. Soekarno Hatta No. 10 Rajabasa Bandar Lampung, Lampung, 35144', 'logo-dkm_backup.jpg', 'T'),
(3, 'Taqwa', 'Dr. H Rosidi', 'Irawan, M.Si.', 'H. Miad Khairudin', 'Kelurahan Waydadi, Kecamatan Sukarame, Bandar Lampung', 'masjid.jpeg', 'T'),
(4, 'Masjid user 2', NULL, NULL, NULL, NULL, 'logo-dkm.jpg', 'T'),
(5, 'Masjid user 3', NULL, NULL, NULL, NULL, 'logo-dkm.jpg', 'T'),
(6, 'Masjid Al- Hidayah', 'Rusmianto', 'Irawan', 'Jution', 'Jl. Soekarno Hatta No 10 Rajabasa', 'Logo_Kab_Pringsewu.png', 'T'),
(7, 'Masjid Tes', 'Jution', 'Kirana', 'Candra', 'Rajabasa', '61612527-lampung-indonesia-map-in-grey.jpg', 'T'),
(8, 'As Salam', 'Wagiyono', '-', '-', 'Dusun Kampung Sawah RT/RW 05/01 Desa Kebagusan. Kec. Gedongtataan Kab. Pesawaran', 'illustration-islamic-mosque_53876-8154.jpg', 'T'),
(9, 'Babbussalam', '-', '-', '-', 'Desa Tanjung Sari, Lampung Selatan', 'illustration-islamic-mosque_53876-8154.jpg', 'T'),
(10, 'Tesla', NULL, NULL, NULL, NULL, 'logo-dkm.jpg', 'T');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_organisasi`
--

CREATE TABLE `m_organisasi` (
  `id_konten` int(4) NOT NULL,
  `judul_konten` varchar(50) NOT NULL,
  `isi_konten` text NOT NULL,
  `menu_konten` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `m_organisasi`
--

INSERT INTO `m_organisasi` (`id_konten`, `judul_konten`, `isi_konten`, `menu_konten`) VALUES
(1, 'Struktur Organisasi DKM', '<p>Ketua : Bapak Fulan</p>\r\n\r\n<p>Sekreta</p>\r\n', 'DKM'),
(2, 'Struktur Organisasi Majelis Taklim', '', 'Majelis Taklim'),
(3, 'Struktur Organisasi TPA', '', 'TPA'),
(4, 'Struktur Organisasi Remaja Masjid', '', 'Remaja Masjid');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_petugas`
--

CREATE TABLE `m_petugas` (
  `id_petugas` int(11) NOT NULL,
  `nama_petugas` varchar(255) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('ADMIN','USER') NOT NULL,
  `id_masjid` int(11) DEFAULT NULL,
  `publish` enum('T','F') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `m_petugas`
--

INSERT INTO `m_petugas` (`id_petugas`, `nama_petugas`, `jenis_kelamin`, `no_hp`, `user`, `password`, `level`, `id_masjid`, `publish`) VALUES
(1, 'Admin', 'L', '085269350993', 'admin', 'admin', 'ADMIN', 1, 'T'),
(5, 'Jution Candra Kirana', 'L', '090000', 'jutionck', 'jutionck', 'USER', 2, 'T'),
(6, 'Masjid At-Taqwa 2', 'L', '34567', 'mtaqwa2', '12345', 'USER', 1, 'T'),
(7, 'masjidtaqwa', 'L', '123', 'masjidtaqwa', '12345', 'USER', 3, 'T'),
(8, 'User 2', 'L', '89', 'user2', 'user2', 'USER', 4, 'T'),
(9, 'User 3', 'L', '878', 'user3', 'user3', 'USER', 5, 'T'),
(10, 'User 4', 'L', '123', 'user4', 'user4', 'USER', 6, 'T'),
(11, 'jckk', 'L', '999', 'jckk', 'jck', 'USER', 7, 'T'),
(12, 'Siswoko', 'L', '085279751241', 'siswoko', 'siswoko1234', 'USER', 8, 'T'),
(13, 'Fulan', 'L', '0821828282828', 'adminmasjid', '12345678', 'USER', 9, 'T'),
(14, 'Tesla', 'L', '5678', 'tesla', 'tesla', 'USER', 10, 'T');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tr_infaq`
--

CREATE TABLE `tr_infaq` (
  `id_infaq` int(11) NOT NULL,
  `jenis_infaq` enum('INFAQ JUMAT','KOTAK AMAL','INFAQ LAINNYA') NOT NULL,
  `tanggal` date NOT NULL,
  `nominal` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `id_petugas` int(11) NOT NULL,
  `publish` enum('T','F') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tr_infaq`
--

INSERT INTO `tr_infaq` (`id_infaq`, `jenis_infaq`, `tanggal`, `nominal`, `keterangan`, `id_petugas`, `publish`) VALUES
(2, 'INFAQ JUMAT', '2019-09-05', '5000000', 'Saldo Awal', 6, 'T'),
(3, 'INFAQ JUMAT', '2019-09-06', '600000', 'Infaq', 6, 'T'),
(4, 'INFAQ LAINNYA', '2019-09-05', '120000000', 'Saldo Awal', 11, 'T'),
(5, 'KOTAK AMAL', '2019-09-07', '350000', 'Kotak Amal', 11, 'T'),
(6, 'KOTAK AMAL', '2019-09-09', '150000', 'Kotak Amal', 11, 'T'),
(7, 'KOTAK AMAL', '2019-09-11', '350000', 'Kotak Amal', 11, 'T'),
(8, 'INFAQ JUMAT', '2019-09-06', '2000000', 'Infaq Jumat', 10, 'T'),
(9, 'KOTAK AMAL', '2019-10-10', '500000', 'Kotak Amal', 10, 'T'),
(10, 'INFAQ JUMAT', '2019-09-01', '204264265', 'SALDO AWAL', 7, 'T'),
(11, 'INFAQ JUMAT', '2019-09-06', '900000', 'INFAK JUMAT', 7, 'T'),
(12, 'KOTAK AMAL', '2019-09-06', '100000', 'SUKIMIN', 7, 'T'),
(13, 'KOTAK AMAL', '2019-09-06', '100000', 'FATHUL HAYAT', 7, 'T'),
(14, 'KOTAK AMAL', '2019-09-06', '200000', 'H ROSYIDI', 7, 'T'),
(15, 'KOTAK AMAL', '2019-09-06', '100000', 'NASIR', 7, 'T'),
(16, 'KOTAK AMAL', '2019-09-08', '250000', 'H ABDULLAH', 7, 'T'),
(17, 'KOTAK AMAL', '2019-09-08', '100000', 'H HERWAN', 7, 'T'),
(18, 'KOTAK AMAL', '2019-09-09', '100000', 'H AHMAD', 7, 'T'),
(19, 'INFAQ JUMAT', '2019-09-13', '935000', 'JUMAT KE-2', 7, 'T'),
(20, 'KOTAK AMAL', '2019-09-13', '200000', 'H ACHLAMI', 7, 'T'),
(21, 'KOTAK AMAL', '2019-09-13', '100000', 'H NAWIRI', 7, 'T'),
(22, 'INFAQ JUMAT', '2020-08-04', '10000', 'ss', 8, 'T'),
(23, 'INFAQ JUMAT', '2020-08-14', '1500000', 'Infaq Jumat', 9, 'T'),
(24, 'KOTAK AMAL', '2020-08-15', '500000', 'kotak amal', 13, 'T');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tr_pengeluaran`
--

CREATE TABLE `tr_pengeluaran` (
  `id_pengeluaran` int(11) NOT NULL,
  `jenis_pengeluaran` enum('PEMBANGUNAN','OPERASIONAL','ZIS') NOT NULL,
  `tanggal` date NOT NULL,
  `nominal` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `id_petugas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tr_pengeluaran`
--

INSERT INTO `tr_pengeluaran` (`id_pengeluaran`, `jenis_pengeluaran`, `tanggal`, `nominal`, `keterangan`, `id_petugas`) VALUES
(1, 'OPERASIONAL', '2019-09-27', '200000', 'ketet', 6),
(2, 'OPERASIONAL', '2019-09-06', '150000', 'Membeli minum', 10),
(3, 'OPERASIONAL', '2019-09-06', '600000', 'INSENTIF MARBOT', 7),
(4, 'OPERASIONAL', '2019-09-06', '150000', 'TRANSPORT KHOTIB JUMAT', 7),
(5, 'OPERASIONAL', '2019-09-06', '100000', 'BELI PEWANGI RUANGAN', 7),
(6, 'OPERASIONAL', '2019-09-09', '1165900', 'BAYAR LISTRIK SEPTEMBER', 7),
(7, 'OPERASIONAL', '2019-09-13', '700000', 'KONSUMSI GERAKAN SUBUH', 7),
(8, 'OPERASIONAL', '2020-08-16', '100000', 'perbaikan salon', 13);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tr_rekapkas`
--

CREATE TABLE `tr_rekapkas` (
  `no_rekap` int(6) NOT NULL,
  `tgl_rekap` date NOT NULL,
  `tgl_tampil` date NOT NULL,
  `operasional` int(11) DEFAULT NULL,
  `pembangunan` int(11) DEFAULT NULL,
  `zis` int(11) DEFAULT NULL,
  `pengeluaran_operasional` int(11) DEFAULT NULL,
  `pengeluaran_pembangunan` int(11) DEFAULT NULL,
  `pengeluaran_zis` int(11) DEFAULT NULL,
  `id_masjid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tr_rekapkas`
--

INSERT INTO `tr_rekapkas` (`no_rekap`, `tgl_rekap`, `tgl_tampil`, `operasional`, `pembangunan`, `zis`, `pengeluaran_operasional`, `pengeluaran_pembangunan`, `pengeluaran_zis`, `id_masjid`) VALUES
(1, '2019-09-30', '2019-10-01', 207349265, 100000000, 500000, 2715900, 0, 0, 3),
(2, '2019-10-31', '2019-11-01', NULL, 100000000, 500000, NULL, 250000, 50000, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tr_sodaqoh`
--

CREATE TABLE `tr_sodaqoh` (
  `id_sodaqoh` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nominal` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `id_donatur` int(11) NOT NULL,
  `id_petugas` int(11) NOT NULL,
  `publish` enum('T','F') NOT NULL DEFAULT 'T'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tr_sodaqoh`
--

INSERT INTO `tr_sodaqoh` (`id_sodaqoh`, `tanggal`, `nominal`, `keterangan`, `id_donatur`, `id_petugas`, `publish`) VALUES
(1, '2019-09-06', '30000000', 'Saldo Awal', 2, 6, 'T'),
(2, '2019-09-09', '500000', 'Ket', 2, 6, 'T'),
(3, '2019-09-06', '1500000', 'Beli semen', 4, 10, 'T'),
(4, '2020-08-11', '100000', 'Tes', 14, 8, 'T'),
(5, '2020-08-14', '100000000', 'Sumbangan', 15, 9, 'T'),
(6, '2020-08-15', '10000000', 'dana masjid', 16, 13, 'T');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tr_zakatt`
--

CREATE TABLE `tr_zakatt` (
  `id_zakat` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nama_pembayar` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `jenis_zakat` enum('UANG','BERAS') NOT NULL,
  `jumlah_jiwa` varchar(255) NOT NULL,
  `total_bayar` varchar(255) NOT NULL,
  `id_petugas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tr_zis`
--

CREATE TABLE `tr_zis` (
  `id_zis` int(11) NOT NULL,
  `jenis_zis` enum('ZAKAT','INFAQ','SHODAQOH') NOT NULL,
  `tanggal` date NOT NULL,
  `nominal` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `id_petugas` int(11) NOT NULL,
  `publish` enum('T','F') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tr_zis`
--

INSERT INTO `tr_zis` (`id_zis`, `jenis_zis`, `tanggal`, `nominal`, `keterangan`, `id_petugas`, `publish`) VALUES
(1, 'ZAKAT', '2019-09-05', '100000000', 'Saldo Awal', 6, 'T'),
(2, 'SHODAQOH', '2019-09-06', '500000', 'Sodaqoh', 10, 'T'),
(3, 'SHODAQOH', '2020-08-14', '500000', 'Shodaqoh', 9, 'T'),
(4, 'INFAQ', '2020-08-15', '5000000', 'infaq', 13, 'T');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `m_aset`
--
ALTER TABLE `m_aset`
  ADD PRIMARY KEY (`idaset`);

--
-- Indeks untuk tabel `m_donatur`
--
ALTER TABLE `m_donatur`
  ADD PRIMARY KEY (`id_donatur`),
  ADD KEY `id_masjid` (`id_masjid`);

--
-- Indeks untuk tabel `m_masjid`
--
ALTER TABLE `m_masjid`
  ADD PRIMARY KEY (`id_masjid`);

--
-- Indeks untuk tabel `m_organisasi`
--
ALTER TABLE `m_organisasi`
  ADD PRIMARY KEY (`id_konten`);

--
-- Indeks untuk tabel `m_petugas`
--
ALTER TABLE `m_petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indeks untuk tabel `tr_infaq`
--
ALTER TABLE `tr_infaq`
  ADD PRIMARY KEY (`id_infaq`),
  ADD KEY `id_petugas` (`id_petugas`);

--
-- Indeks untuk tabel `tr_pengeluaran`
--
ALTER TABLE `tr_pengeluaran`
  ADD PRIMARY KEY (`id_pengeluaran`),
  ADD KEY `id_petugas` (`id_petugas`);

--
-- Indeks untuk tabel `tr_rekapkas`
--
ALTER TABLE `tr_rekapkas`
  ADD PRIMARY KEY (`no_rekap`);

--
-- Indeks untuk tabel `tr_sodaqoh`
--
ALTER TABLE `tr_sodaqoh`
  ADD PRIMARY KEY (`id_sodaqoh`),
  ADD KEY `id_donatur` (`id_donatur`),
  ADD KEY `id_petugas` (`id_petugas`);

--
-- Indeks untuk tabel `tr_zakatt`
--
ALTER TABLE `tr_zakatt`
  ADD PRIMARY KEY (`id_zakat`),
  ADD KEY `id_petugas` (`id_petugas`);

--
-- Indeks untuk tabel `tr_zis`
--
ALTER TABLE `tr_zis`
  ADD PRIMARY KEY (`id_zis`),
  ADD KEY `id_petugas` (`id_petugas`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `m_aset`
--
ALTER TABLE `m_aset`
  MODIFY `idaset` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT untuk tabel `m_donatur`
--
ALTER TABLE `m_donatur`
  MODIFY `id_donatur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `m_masjid`
--
ALTER TABLE `m_masjid`
  MODIFY `id_masjid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `m_organisasi`
--
ALTER TABLE `m_organisasi`
  MODIFY `id_konten` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `m_petugas`
--
ALTER TABLE `m_petugas`
  MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `tr_infaq`
--
ALTER TABLE `tr_infaq`
  MODIFY `id_infaq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `tr_pengeluaran`
--
ALTER TABLE `tr_pengeluaran`
  MODIFY `id_pengeluaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tr_rekapkas`
--
ALTER TABLE `tr_rekapkas`
  MODIFY `no_rekap` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tr_sodaqoh`
--
ALTER TABLE `tr_sodaqoh`
  MODIFY `id_sodaqoh` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tr_zakatt`
--
ALTER TABLE `tr_zakatt`
  MODIFY `id_zakat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tr_zis`
--
ALTER TABLE `tr_zis`
  MODIFY `id_zis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `m_donatur`
--
ALTER TABLE `m_donatur`
  ADD CONSTRAINT `m_donatur_ibfk_1` FOREIGN KEY (`id_masjid`) REFERENCES `m_masjid` (`id_masjid`);

--
-- Ketidakleluasaan untuk tabel `tr_infaq`
--
ALTER TABLE `tr_infaq`
  ADD CONSTRAINT `tr_infaq_ibfk_1` FOREIGN KEY (`id_petugas`) REFERENCES `m_petugas` (`id_petugas`);

--
-- Ketidakleluasaan untuk tabel `tr_pengeluaran`
--
ALTER TABLE `tr_pengeluaran`
  ADD CONSTRAINT `tr_pengeluaran_ibfk_1` FOREIGN KEY (`id_petugas`) REFERENCES `m_petugas` (`id_petugas`);

--
-- Ketidakleluasaan untuk tabel `tr_sodaqoh`
--
ALTER TABLE `tr_sodaqoh`
  ADD CONSTRAINT `tr_sodaqoh_ibfk_1` FOREIGN KEY (`id_donatur`) REFERENCES `m_donatur` (`id_donatur`),
  ADD CONSTRAINT `tr_sodaqoh_ibfk_2` FOREIGN KEY (`id_petugas`) REFERENCES `m_petugas` (`id_petugas`);

--
-- Ketidakleluasaan untuk tabel `tr_zakatt`
--
ALTER TABLE `tr_zakatt`
  ADD CONSTRAINT `tr_zakatt_ibfk_1` FOREIGN KEY (`id_petugas`) REFERENCES `m_petugas` (`id_petugas`);

--
-- Ketidakleluasaan untuk tabel `tr_zis`
--
ALTER TABLE `tr_zis`
  ADD CONSTRAINT `tr_zis_ibfk_1` FOREIGN KEY (`id_petugas`) REFERENCES `m_petugas` (`id_petugas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
