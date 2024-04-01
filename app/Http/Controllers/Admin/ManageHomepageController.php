<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Homepage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class ManageHomepageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(Homepage $homepage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['pageTitle'] = 'Homepage Content';

        $decryptId = Crypt::decryptString($id);

        $data['homepageData'] = Homepage::where('id', $decryptId)->get();

        return view('admin.edit_homepage', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Homepage $homepage)
    {
        $validatedData = $request->validate([
            'heading' => ['required'],
            'deskripsi_app' => ['required'],
            'instagram_username' => ['required'],
            'instagram_link' => ['required', 'url'],
            'youtube_channel' => ['required'],
            'youtube_link' => ['required', 'url'],
            'id_video' => ['required'],
            'alamat' => ['required'],
            'email' => ['required', 'email'],
            'no_telp' => ['required'],
            'gmaps_kantor' => ['required'],
        ]);

        $homepage = Homepage::where('id', $homepage->id)->update($validatedData);

        $getUser = Auth::guard('admin')->user()->nama_lengkap;
        activity()->causedBy($homepage)->log($getUser . ' melakukan update data Homepage');

        return redirect(route('admin.manageContent'))->with('success', 'Data berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Homepage $homepage)
    {
        //
    }
}
