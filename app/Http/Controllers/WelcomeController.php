<?php
namespace App\Http\Controllers;

class WelcomeController extends Controller{

    // Menampilkan halaman utama welcome
    public function index() {
        // Membuat variabel breadcrumb sebagai objek standar (stdClass) untuk menyimpan data navigasi breadcrumb
        $breadcrumb = (object) [
            'title' => 'Selamat Datang',  // judul halaman
            'list' => ['Home', 'Welcome'] // daftar breadcrumb yang akan ditampilkan
        ];

        // Memberi highlight pada menu "Dashboard"
        $activeMenu = 'dashboard';

        // Mengirimkan data breadcrumb dan activeMenu agar bisa diakses di file Blade
        return view('welcome', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    }
}