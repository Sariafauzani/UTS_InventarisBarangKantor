<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriModel;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class KategoriController extends Controller
{
    // Menampilkan halaman utama kategori
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Kategori',
            'list' => ['Home', 'Kategori']
        ];

        $page = (object) [
            'title' => 'Daftar kategori barang dalam sistem'
        ];

        $activeMenu = 'kategori';
        $kategori = KategoriModel::all(); // Ambil semua data kategori untuk ditampilkan (jika diperlukan)

        return view('kategori.index', compact('breadcrumb', 'page', 'activeMenu', 'kategori'));
    }

    // Ambil data Kategori dalam bentuk json untuk datatables
    public function list(Request $request)
    {
        $kategori = KategoriModel::select('kategori_id', 'kategori_kode', 'kategori_nama');

        // filter data Kategori brdasarkan kategori_id
        if ($request->kategori_id) {
            $kategori->where('kategori_id', $request->kategori_id);
        }

        return DataTables::of($kategori)
            ->addIndexColumn() // Tambahkan nomor urut otomatis
            ->addColumn('aksi', function ($kategori) { // Menambahkan kolom aksi
                // Tombol Edit dan Hapus untuk setiap baris
                $btn = '<button onclick="modalAction(\'' . url('/kategori/' . $kategori->kategori_id .
                    '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/kategori/' . $kategori->kategori_id .
                    '/delete_ajax') . '\')"  class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi']) // Memberitahu DataTables bahwa kolom aksi adalah html
            ->make(true);
    }

    // Menampilkan form tambah kategori (AJAX)
    public function create_ajax()
    {
        return view('kategori.create_ajax');
    }

    // Menyimpan data kategori baru (AJAX)
    public function store_ajax(Request $request)
    {
        if ($request->ajax()) {
            // Aturan validasi input
            $rules = [
                'kategori_kode' => 'required|string|min:2|unique:kategori,kategori_kode',
                'kategori_nama' => 'required|string|max:100'
            ];

            // Validasi data
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                // Jika gagal validasi
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            // Simpan data kategori
            KategoriModel::create($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Data Kategori Berhasil Disimpan'
            ]);
        }

        return redirect('/');
    }

    // Menampilkan form edit data kategori
    public function edit_ajax($id)
    {
        $kategori = KategoriModel::find($id); // Ambil data berdasarkan ID
        return view('kategori.edit_ajax', compact('kategori'));
    }

    // Mengupdate data kategori (AJAX)
    public function update_ajax(Request $request, $id)
    {
        if ($request->ajax()) {
            // Aturan validasi untuk update
            $rules = [
                'kategori_kode' => 'required|string|min:2|unique:kategori,kategori_kode,' . $id . ',kategori_id',
                'kategori_nama' => 'required|string|max:100'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                 // Jika validasi gagal
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            $kategori = KategoriModel::find($id);

            if ($kategori) {
                // Update data kategori
                $kategori->update($request->all());

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

    // Menampilkan konfirmasi hapus kategori
    public function confirm_ajax($id)
    {
        $kategori = KategoriModel::find($id);
        return view('kategori.confirm_ajax', compact('kategori'));
    }

    // Menghapus data kategori (AJAX)
    public function delete_ajax(Request $request, $id)
    {
        if ($request->ajax()) {
            $kategori = KategoriModel::find($id);

            if ($kategori) {
                $kategori->delete(); // Hapus data
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
