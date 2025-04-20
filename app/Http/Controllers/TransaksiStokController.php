<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangModel;
use Illuminate\Support\Facades\Validator;
use App\Models\TransaksiStokModel;
use Yajra\DataTables\Facades\DataTables;

class TransaksiStokController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Transaksi Stok Barang',
            'list' => ['Home', 'Transaksi Stok']
        ];

        $page = (object) [
            'title' => 'Form transaksi masuk dan keluar stok barang'
        ];

        $activeMenu = 'transaksi_stok';

        $barang = BarangModel::all();

        return view('transaksi_stok.index', compact('breadcrumb', 'page', 'activeMenu', 'barang'));
    }

    public function list(Request $request)
{
    $transaksi = TransaksiStokModel::with('barang') // join ke barang
        ->select('transaksi_stok.*'); // ambil semua kolom transaksi_stok

    return DataTables::of($transaksi)
        ->addIndexColumn()
        ->addColumn('barang_nama', function ($row) {
            return $row->barang->barang_nama ?? '-';
        })
        ->addColumn('barang_kode', function ($row) {
            return $row->barang->barang_kode ?? '-';
        })
        ->addColumn('aksi', function ($row) {
            $btn = '<button onclick="modalAction(\'' . url('/transaksi_stok/' . $row->transaksi_stok_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button>';
            $btn .= '<button onclick="modalAction(\'' . url('/transaksi_stok/' . $row->transaksi_stok_id .
                        '/delete_ajax') . '\')"  class="btn btn-danger btn-sm">Hapus</button> ';
            return $btn;
        })
        ->rawColumns(['aksi'])
        ->make(true);
}

    public function create_ajax()
    {
        $barang = BarangModel::all();
        return view('transaksi_stok.create_ajax', compact('barang'));
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax()) {
            $rules = [
                'barang_kode' => 'required|exists:barang,barang_kode',
                'type' => 'required|in:masuk,keluar',
                'quantity' => 'required|integer|min:1'
            ];
    
            $validator = Validator::make($request->all(), $rules);
    
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors()
                ]);
            }
    
            try {
                $kode = trim($request->barang_kode);
                $barang = BarangModel::where('barang_kode', $kode)->first();
    
                if (!$barang) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Barang tidak ditemukan'
                    ]);
                }
    
                if ($request->type == 'masuk') {
                    $barang->stok_barang += $request->quantity;
                } else {
                    if ($barang->stok_barang < $request->quantity) {
                        return response()->json([
                            'status' => false,
                            'message' => 'Stok tidak mencukupi untuk transaksi keluar'
                        ]);
                    }
                    $barang->stok_barang -= $request->quantity;
                }
    
                $barang->save();
    
                // Simpan transaksi ke tabel transaksi_stok
                TransaksiStokModel::create([
                    'barang_id' => $barang->barang_id,
                    'type' => $request->type,
                    'quantity' => $request->quantity,
                    'keterangan' => $request->keterangan,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
    
                return response()->json([
                    'status' => true,
                    'message' => 'Transaksi stok berhasil diproses'
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ]);
            }
        }
    
        return redirect('/');
    }

    public function edit_ajax($id)
    {
        // Mengambil data transaksi_stok berdasarkan ID
        $transaksi_stok = TransaksiStokModel::find($id); // find() akan pakai primary key
        $barang = BarangModel::all();

        // Mengirimkan data transaksi_stok dan barang ke view
        return view('transaksi_stok.edit_ajax', compact('transaksi_stok', 'barang'));
    }

    public function update_ajax(Request $request, $id)
    {
        if ($request->ajax()) {
            $rules = [
                'type' => 'required|in:masuk,keluar',
                'quantity' => 'required|integer|min:1',
                'keterangan' => 'nullable|string'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            $transaksi = TransaksiStokModel::find($id);

            if (!$transaksi) {
                return response()->json([
                    'status' => false,
                    'message' => 'Data transaksi tidak ditemukan'
                ]);
            }

            $transaksi->update([
                'type' => $request->type,
                'quantity' => $request->quantity,
                'keterangan' => $request->keterangan
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Data transaksi berhasil diperbarui'
            ]);
        }

        return redirect('/');
    }

    public function confirm_ajax($id)
    {
        $transaksi_stok = TransaksiStokModel::with('barang')->find($id);

        if (!$transaksi_stok) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }

        return view('transaksi_stok.confirm_ajax', compact('transaksi_stok'));
    }

    public function delete_ajax($id)
    {
        $data = TransaksiStokModel::find($id);

        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Data transaksi tidak ditemukan'
            ]);
        }

        $data->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data transaksi berhasil dihapus'
        ]);
    }
}
