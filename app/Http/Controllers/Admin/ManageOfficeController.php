<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Office;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class ManageOfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['pageTitle'] = 'Instansi Magang';
        $data['officeData'] = Office::all();

        return view('admin.office.office_list', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['pageTitle'] = 'Tambah Instansi';

        return view('admin.office.office_create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_kantor' => ['required'],
            'alamat' => ['required'],
            'nama_kepala' => ['required'],
            'nip_kepala' => ['required'],
            'ttd_kepala' => ['image', 'max:2048', 'mimes:jpg,jpeg,png,webp'],
        ]);

        // Store the image
        if ($request->hasFile('ttd_kepala')) {
            // Get the uploaded file
            $ttd_kepala = $request->file('ttd_kepala');

            // Generate a unique filename
            $filename = time() . '_' . $ttd_kepala->getClientOriginalName();

            // Store the image in the storage directory
            $path = $ttd_kepala->storeAs('public/docs/office/ttd', $filename);

            // Update the 'gambar' field in the database with the image path
            $validatedData['ttd_kepala'] = $path;
        }

        $office = Office::create($validatedData);
        $getUser = Auth::guard('admin')->user()->nama_lengkap;
        activity()->causedBy($office)->log($getUser . ' melakukan tambah data Instansi / OPD baru');

        return redirect(route('admin.manageOffice'))->with('success', 'Data berhasil disimpan!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Office $office)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $data['pageTitle'] = 'Edit Instansi';

        $data['officeData'] = Office::where('slug', $slug)->get();

        return view('admin.office.office_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Office $office)
    {
        $validatedData = $request->validate([
            'nama_kantor' => ['required'],
            'alamat' => ['required'],
            'nama_kepala' => ['required'],
            'nip_kepala' => ['required'],
            'ttd_kepala' => ['image', 'max:2048', 'mimes:jpg,jpeg,png,webp'],
        ]);

        // Store the image
        if ($request->hasFile('ttd_kepala')) {
            // Get the uploaded file
            $ttd_kepala = $request->file('ttd_kepala');

            // Generate a unique filename
            $filename = time() . '_' . $ttd_kepala->getClientOriginalName();

            // Store the image in the storage directory
            $path = $ttd_kepala->storeAs('public/docs/office/ttd', $filename);

            // Update the 'gambar' field in the database with the image path
            $validatedData['ttd_kepala'] = $path;
        }

        $newSlug = Str::slug($request->input('nama_kantor'));

        if ($newSlug !== $office->slug) {
            $count = 1;
            $slugExists = Office::where('slug', $newSlug)->exists();
            while ($slugExists) {
                $newSlug = $newSlug . '-' . $count;
                $slugExists = Office::where('slug', $newSlug)->exists();
                $count++;
            }
            $office->slug = $newSlug;
        }

        $validatedData['slug'] = $newSlug;
        $office = Office::where('id', $office->id)->update($validatedData);

        $getUser = Auth::guard('admin')->user()->nama_lengkap;
        activity()->causedBy($office)->log($getUser . ' melakukan update data Instansi / OPD');

        return redirect(route('admin.manageOffice'))->with('success', 'Data berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $office = Office::find($id);
        $office->delete();

        $getUser = Auth::guard('admin')->user()->nama_lengkap;
        activity()->causedBy($office)->log($getUser . ' melakukan delete data Instansi / OPD');

        return redirect(route('admin.manageOffice'))->with('success', 'Data berhasil dihapus!');
    }
}
