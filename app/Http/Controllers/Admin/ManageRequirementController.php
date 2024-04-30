<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Requirement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManageRequirementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['pageTitle'] = 'Requirement Data';
        $data['requirementData'] = Requirement::paginate(10);

        return view('admin.requirement.requirement_list', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['pageTitle'] = 'Tambah Data Requirement';

        return view('admin.requirement.requirement_create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'content' => ['required', 'max:255'],
        ]);

        $requirement = Requirement::create($validatedData);

        $getUser = Auth::guard('admin')->user()->nama_lengkap;
        activity()->causedBy($requirement)->log($getUser . ' melakukan tambah data Requirement baru');

        return redirect(route('admin.manageRequirement'))->with('success', 'Data berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Requirement $requirement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($uuid)
    {
        $data['pageTitle'] = 'Edit Data Requirement';
        $data['requirementData'] = Requirement::where('uuid', $uuid)->get();

        return view('admin.requirement.requirement_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Requirement $requirement)
    {
        $validatedData = $request->validate([
            'content' => ['required', 'max:255'],
        ]);

        $requirement = Requirement::where('id', $requirement->id)->update($validatedData);

        $getUser = Auth::guard('admin')->user()->nama_lengkap;
        activity()->causedBy($requirement)->log($getUser . ' melakukan update data Requirement');

        return redirect(route('admin.manageRequirement'))->with('success', 'Data berhasil disimpan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $requirement = Requirement::find($id);
        $requirement->delete();

        $getUser = Auth::guard('admin')->user()->nama_lengkap;
        activity()->causedBy($requirement)->log($getUser . ' melakukan delete data Requirement');

        return redirect(route('admin.manageRequirement'))->with('success', 'Data berhasil dihapus!');
    }
}
