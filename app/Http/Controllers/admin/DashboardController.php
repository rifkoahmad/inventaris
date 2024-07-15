<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Ambil tanggal saat ini
    $now = Carbon::now();

    // Inisialisasi array untuk menyimpan data bulanan
    $dataBarangMasuk = [];
    $dataBarangKeluar = [];
    $dataPeminjaman = [];
    $dataPengembalian = [];
    $bulan = [];
    $logActivityAllUser = Activity::all();

    // Inisialisasi variabel untuk menyimpan jumlah total data selama 6 bulan terakhir
    $totalBarangMasuk = 0;
    $totalBarangKeluar = 0;
    $totalPeminjaman = 0;
    $totalPengembalian = 0;

    // Loop untuk 6 bulan terakhir
    for ($i = 0; $i < 6; $i++) {
        // Dapatkan bulan dan tahun untuk setiap iterasi
        $month = $now->copy()->subMonths($i)->format('Y-m');
        $startDate = $now->copy()->subMonths($i)->startOfMonth();
        $endDate = $now->copy()->subMonths($i)->endOfMonth();

        // Ambil data transaksi untuk bulan tersebut
        $barangMasuk = BarangMasuk::whereBetween('tanggal_masuk', [$startDate, $endDate])->count();
        $barangKeluar = BarangKeluar::whereBetween('tanggal_keluar', [$startDate, $endDate])->count();
        $peminjamanBarang = Peminjaman::whereBetween('tanggal_pinjam', [$startDate, $endDate])->count();
        $pengembalianBarang = Pengembalian::whereBetween('tanggal_kembali', [$startDate, $endDate])->count();

        // Simpan data ke dalam array
        $dataBarangMasuk[$month] = $barangMasuk;
        $dataBarangKeluar[$month] = $barangKeluar;
        $dataPeminjaman[$month] = $peminjamanBarang;
        $dataPengembalian[$month] = $pengembalianBarang;
        $bulan[] = $month;

        // Tambahkan ke total
        $totalBarangMasuk += $barangMasuk;
        $totalBarangKeluar += $barangKeluar;
        $totalPeminjaman += $peminjamanBarang;
        $totalPengembalian += $pengembalianBarang;
    }

    // Kirim data ke view
    return view('admin.a_dashboard.dashboard', [
        'logs' => $logActivityAllUser,
        'barangMasuk' => $dataBarangMasuk,
        'barangKeluar' => $dataBarangKeluar,
        'peminjamanBarang' => $dataPeminjaman,
        'pengembalianBarang' => $dataPengembalian,
        'bulan' => array_reverse($bulan),
        'totalBarangMasuk' => $totalBarangMasuk,
        'totalBarangKeluar' => $totalBarangKeluar,
        'totalPeminjaman' => $totalPeminjaman,
        'totalPengembalian' => $totalPengembalian,
    ]);
    }
}
