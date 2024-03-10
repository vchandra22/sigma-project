<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Home;
use Illuminate\Http\Request;

class MainIndexController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['pageTitle'] = 'Beranda';

        return view('frontend.home.home', $data);
    }

    public function roleList() {
        $data['pageTitle'] = 'Internship Roles';

        return view('frontend.roles.role-lists', $data);
    }

    public function roleDetail() {
        $data['pageTitle'] = 'Developer';

        return view('frontend.roles.role-detail', $data);
    }

    public function publikasiList()
    {
        $data['pageTitle'] = 'Publikasi';

        return view('frontend.publikasi.publikasi-lists', $data);
    }

    public function publikasiDetail()
    {
        $data['pageTitle'] = 'Judul Publikasi';

        return view('frontend.publikasi.publikasi-detail', $data);
    }

    public function faq()
    {
        $data['pageTitle'] = 'FAQ';

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

    /**
     * Display the specified resource.
     */
    public function show(Home $home)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Home $home)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Home $home)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Home $home)
    {
        //
    }
}
