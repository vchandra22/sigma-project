<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Faq;
use App\Models\Home;
use App\Models\Homepage;
use App\Models\Journey;
use App\Models\Office;
use App\Models\Position;
use App\Models\Publication;
use App\Models\Status;
use Illuminate\Http\Request;

class MainIndexController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['pageTitle'] = 'Beranda';
        $data['homeData'] = Homepage::latest()->get();
        $data['journeyData'] = Journey::all();
        $data['countDiterima'] = Status::where('status', 'diterima')->count();
        $data['countSelesai'] = Status::where('status', 'selesai')->count();
        $data['countMentor'] = Admin::whereHas('roles', function ($query) {
            $query->where('name', 'mentor');
        })->count();

        $data['countOffice'] = Office::count();

        return view('frontend.home.home', $data);
    }

    public function roleList()
    {
        $data['pageTitle'] = 'Internship Roles';
        $data['positionData'] = Position::all();

        return view('frontend.roles.role-lists', $data);
    }

    public function roleDetail($slug)
    {
        $data['pageTitle'] = 'Developer';
        $data['positionData'] = Position::where('slug', $slug)->get();

        return view('frontend.roles.role-detail', $data);
    }

    public function publikasiList()
    {
        $data['pageTitle'] = 'Publikasi';
        $data['publikasiData'] = Publication::all();

        return view('frontend.publikasi.publikasi-lists', $data);
    }

    public function publikasiDetail($slug)
    {
        $data['pageTitle'] = 'Judul Publikasi';
        $data['publikasiData'] = Publication::where('slug', $slug)->get();
        $data['publikasiAll'] = Publication::all();

        return view('frontend.publikasi.publikasi-detail', $data);
    }

    public function faq()
    {
        $data['pageTitle'] = 'FAQ';
        $data['faqData'] = Faq::all();
        $data['homeData'] = Homepage::first();

        return view('frontend.faq.faq', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }
}
