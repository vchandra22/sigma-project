<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Benefit;
use App\Models\Faq;
use App\Models\Homepage;
use App\Models\Journey;
use App\Models\Office;
use App\Models\Position;
use App\Models\Publication;
use App\Models\Requirement;
use App\Models\Status;

class MainIndexController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['pageTitle'] = 'Beranda'; // Setel judul halaman menjadi 'Beranda'
        $data['homeData'] = Homepage::latest()->firstOrFail(); // Mendapatkan data konten beranda
        $data['journeyData'] = Journey::all(); // Mendapatkan data konten tahapan magang
        $data['benefitData'] = Benefit::all(); // Mendapatkan data konten keuntungan magang
        $data['requirementData'] = Requirement::all(); // Mendapatkan data konten kebutuhan

        // Menghitung jumlah peserta berdasarkan status
        $data['countDiterima'] = Status::where('status', 'diterima')->count();
        $data['countSelesai'] = Status::where('status', 'selesai')->count();
        $data['countMentor'] = Admin::whereHas('roles', function ($query) {
            $query->where('name', 'mentor');
        })->count();

        $data['countOffice'] = Office::count(); // Menghitung jumlah kantor

        return view('frontend.home.home', $data); // Kembalikan view home dengan data
    }

    public function roleList()
    {
        $data['pageTitle'] = 'Posisi Pekerjaan'; // Setel judul halaman menjadi 'Posisi Pekerjaan'
        $data['homeData'] = Homepage::latest()->firstOrFail(); // Mendapatkan data konten beranda
        $data['positionData'] = Position::all(); // Mendapatkan posisi pekerjaan yang tersedia

        return view('frontend.roles.role-lists', $data); // Kembalikan view daftar posisi dengan data
    }

    public function roleDetail($slug)
    {
        // Mendapatkan data posisi yang sesuai dengan slug
        $positionData = Position::where('slug', $slug)->firstOrFail();
        $data['positionData'] = $positionData;

        $data['pageTitle'] = $positionData->role; // Setel judul halaman dengan data role
        $data['homeData'] = Homepage::latest()->firstOrFail(); // Mendapatkan data konten beranda

        return view('frontend.roles.role-detail', $data);
    }

    public function publikasiList()
    {
        $data['pageTitle'] = 'Publikasi'; // Setel judul halaman menjadi 'Publikasi'
        $data['homeData'] = Homepage::latest()->firstOrFail(); // Mendapatkan data konten beranda

        // Mendapatkan data publikasi, urutkan berdasarkan yang terbaru, dan paginasi (16 per halaman)
        $data['publikasiData'] = Publication::latest()->paginate(16);

        return view('frontend.publikasi.publikasi-lists', $data); // Kembalikan view daftar publikasi dengan data
    }

    public function publikasiDetail($slug)
    {
        // Mendapatkan data publikasi yang sesuai dengan slug
        $publikasiData = Publication::where('slug', $slug)->firstOrFail();
        $data['publikasiData'] = $publikasiData;

        $data['pageTitle'] = $publikasiData->judul; // Setel judul halaman dengan data judul publikasi

        // Mendapatkan daftar publikasi selain slug, urut berdasarkan terbaru, paginasi (4 per halaman)
        $data['publikasiAll'] = Publication::whereNot('slug', $slug)->latest()->paginate(4);
        $data['homeData'] = Homepage::latest()->firstOrFail(); // Mendapatkan data konten beranda

        return view('frontend.publikasi.publikasi-detail', $data); // Kembalikan view publikasi detail dengan data
    }

    public function faq()
    {
        $data['pageTitle'] = 'FAQ'; // Setel judul halaman menjadi 'FAQ'
        $data['faqData'] = Faq::all(); // Mendapatkan data FAQ
        $data['homeData'] = Homepage::latest()->firstOrFail(); // Mendapatkan data konten beranda

        return view('frontend.faq.faq', $data); // Kembalikan view faq dengan data
    }
}
