<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Office;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use File;

class ManageOfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['pageTitle'] = 'Instansi Magang';
        $data['officeData'] = Office::latest()->paginate(10);

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

        if (isset($validatedData['ttd_kepala'])) {
            // Process 'ttd_kepala' if it exists
            if ($request->hasFile('ttd_kepala')) {
                // Handle file upload and storage
                $file = $request->file('ttd_kepala');
                $directoryPath = 'img';

                // Create directory if not exists
                if (!file_exists($directoryPath)) {
                    Storage::disk('public')->makeDirectory($directoryPath, 0775, true);
                }

                $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
                Storage::disk('public')->put('/img/' . $filename, File::get($file));
                $validatedData['ttd_kepala'] = $filename;
            }
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
    public function edit($uuid)
    {
        $data['pageTitle'] = 'Edit Instansi';

        $data['officeData'] = Office::where('uuid', $uuid)->get();

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

        if (isset($validatedData['ttd_kepala'])) {
            // Process 'ttd_kepala' if it exists
            if ($request->hasFile('ttd_kepala')) {
                // Handle file upload and storage
                $file = $request->file('ttd_kepala');
                $directoryPath = 'img';

                // Create directory if not exists
                if (!file_exists($directoryPath)) {
                    Storage::disk('public')->makeDirectory($directoryPath, 0775, true);
                }

                $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
                Storage::disk('public')->put('/img/' . $filename, File::get($file));
                $validatedData['ttd_kepala'] = $filename;
            }
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
        $office = Office::where('uuid', $office->uuid)->update($validatedData);

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
