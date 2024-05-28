<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Benefit;
use App\Models\Faq;
use App\Models\Home;
use App\Models\Homepage;
use App\Models\Journey;
use App\Models\Office;
use App\Models\Position;
use App\Models\Publication;
use App\Models\Requirement;
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
        $data['homeData'] = Homepage::latest()->firstOrFail();
        $data['journeyData'] = Journey::all();
        $data['benefitData'] = Benefit::all();
        $data['benefitData'] = Benefit::all();
        $data['requirementData'] = Requirement::all();
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
        $data['pageTitle'] = 'Posisi Pekerjaan';
        $data['positionData'] = Position::all();
        $data['homeData'] = Homepage::latest()->firstOrFail();

        return view('frontend.roles.role-lists', $data);
    }

    public function roleDetail($slug)
    {
        $positionData = Position::where('slug', $slug)->firstOrFail();

        $data['pageTitle'] = $positionData->role;
        $data['positionData'] = $positionData;
        $data['homeData'] = Homepage::latest()->firstOrFail();

        return view('frontend.roles.role-detail', $data);
    }

    public function publikasiList()
    {
        $data['pageTitle'] = 'Publikasi';
        $data['publikasiData'] = Publication::latest()->paginate(16);
        $data['homeData'] = Homepage::latest()->firstOrFail();

        return view('frontend.publikasi.publikasi-lists', $data);
    }

    public function publikasiDetail($slug)
    {
        $publikasiData = Publication::where('slug', $slug)->firstOrFail();

        $data['pageTitle'] = $publikasiData->judul;
        $data['publikasiData'] = $publikasiData;
        $data['publikasiAll'] = Publication::whereNot('slug', $slug)->latest()->paginate(4);
        $data['homeData'] = Homepage::latest()->firstOrFail();

        return view('frontend.publikasi.publikasi-detail', $data);
    }

    public function faq()
    {
        $data['pageTitle'] = 'FAQ';
        $data['faqData'] = Faq::all();
        $data['homeData'] = Homepage::first();
        $data['homeData'] = Homepage::latest()->firstOrFail();

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
