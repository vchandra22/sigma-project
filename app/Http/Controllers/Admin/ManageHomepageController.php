<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Homepage;
use App\Models\Meta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use File;
use Illuminate\Support\Facades\Storage;

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
    public function edit($uuid)
    {
        $data['pageTitle'] = 'Homepage Content';

        $data['homepageData'] = Homepage::where('uuid', $uuid)->get();
        $data['metaData'] = Meta::where('slug', 'home')->get();

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

        $validatedDataMeta = $request->validate([
            'meta_title' => ['nullable', 'max:255', 'min:10'],
            'meta_description' => ['nullable', 'max:255'],
            'meta_keyword' => ['nullable'],
            'og_image' => ['image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048', 'nullable'],
        ]);

        $homepage = Homepage::where('uuid', $homepage->uuid)->update($validatedData);

        if ($request->hasFile('og_image')) {
            $file = $request->file('og_image');
            $directoryPath = 'img';

            // Create directory if not exists
            if (!file_exists($directoryPath)) {
                Storage::disk('public')->makeDirectory($directoryPath, 0777, true, true);
            }

            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
            Storage::disk('public')->put('/img/' . $filename, File::get($file));
            $validatedDataMeta['og_image'] = $filename;
        } else {
            // Code block intentionally left empty
        }
        Meta::where('slug', "home")->update($validatedDataMeta);

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
