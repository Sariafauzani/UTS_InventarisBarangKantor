<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\BarangModel;
use App\Models\KategoriModel;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class BarangController extends Controller
{
    // Menampilkan halaman utama daftar barang
    public function index()
    {
        // navigasi halaman
        $breadcrumb = (object) [
            'title' => 'Daftar Barang',  
            'list' => ['Home', 'Barang'] 
        ];
        // judul/keterangan halaman
        $page = (object) [
            'title' => 'Daftar barang yang tersedia dalam sistem'
        ];
        // penanda menu aktif
        $activeMenu = 'barang';
        
        return view('barang.index', compact('breadcrumb', 'page', 'activeMenu'));
    }

    // Mengambil data barang untuk DataTables (AJAX)
    public function list(Request $request)
    {
        // Ambil data barang beserta relasi ke kategori
        $barang = BarangModel::with('kategori')->select('barang_id', 'barang_kode', 'barang_nama', 'kategori_id', 'unit', 'stok_barang');

        return DataTables::of($barang)
            ->addIndexColumn() // Tambah kolom nomor urut
            ->addColumn('kategori_nama', function ($barang) {
                return $barang->kategori->kategori_nama ?? '-'; // Tampilkan nama kategori atau '-' jika tidak ada
            })
            ->addColumn('aksi', function ($barang) {
                // Tombol edit dan hapus dengan modal AJAX
                $btn = '<button onclick="modalAction(\'' . url('/barang/' . $barang->barang_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/barang/' . $barang->barang_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi']) // Pastikan kolom aksi dirender sebagai HTML
            ->make(true);
    }

    // Menampilkan form tambah barang via modal AJAX
    public function create_ajax()
    {
        $kategori = KategoriModel::all(); // Ambil semua data kategori untuk dropdown
        return view('barang.create_ajax', compact('kategori'));
    }

    // Menyimpan data barang baru via AJAX
    public function store_ajax(Request $request)
    {
        // Aturan validasi input
        if ($request->ajax()) {
            $rules = [
                'barang_kode' => 'required|string|min:3|unique:barang,barang_kode',
                'barang_nama' => 'required|string|max:100',
                'kategori_id' => 'required|exists:kategori,kategori_id',
                'unit' => 'required|string|max:50',
                'stok_barang' => 'required|integer|min:0'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                // Jika validasi gagal, kembalikan error
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            // Simpan data barang
            BarangModel::create($request->all());

            // Memunculkan pesan jika berhasil disimpan
            return response()->json([
                'status' => true,
                'message' => 'Data Barang Berhasil Disimpan'
            ]);
        }

        return redirect('/');
    }

    // Menampilkan form edit barang via modal AJAX
    public function edit_ajax($id)
    {
        $barang = BarangModel::find($id); // Cari data barang berdasarkan ID
        $kategori = KategoriModel::all(); // Ambil semua kategori

        return view('barang.edit_ajax', compact('barang', 'kategori'));
    }

    // Mempengaruhi data barang via AJAX
    public function update_ajax(Request $request, $id)
    {
        if ($request->ajax()) {
            // Aturan validasi update
            $rules = [
                'barang_kode' => 'required|string|min:3|unique:barang,barang_kode,' . $id . ',barang_id',
                'barang_nama' => 'required|string|max:100',
                'kategori_id' => 'required|exists:kategori,kategori_id',
                'unit' => 'required|string|max:50',
                'stok_barang' => 'required|integer|min:0'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            $barang = BarangModel::find($id);

            if ($barang) {
                // Update data barang
                $barang->update($request->all());

                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diupdate'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }

        return redirect('/');
    }

    // Menampilkan konfirmasi hapus via modal AJAX
    public function confirm_ajax($id)
    {
        $barang = BarangModel::find($id);

        return view('barang.confirm_ajax', compact('barang'));
    }

    // Menghapus data barang via AJAX
    public function delete_ajax(Request $request, $id)
    {
        if ($request->ajax()) {
            $barang = BarangModel::find($id);

            if ($barang) {
                $barang->delete(); // Hapus data barang
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil dihapus'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }

        return redirect('/');
    }
}
