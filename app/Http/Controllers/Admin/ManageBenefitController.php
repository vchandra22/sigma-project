<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Benefit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManageBenefitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['pageTitle'] = 'Benefits List';
        $data['benefitData'] = Benefit::paginate(10);

        return view('admin.benefit.benefit_list', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['pageTitle'] = 'Tambah Data Benefit';

        return view('admin.benefit.benefit_create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => ['required'],
            'fa_icon' => ['required'],
            'detail' => ['required', 'max:255'],
        ]);

        $benefit = Benefit::create($validatedData);

        $getUser = Auth::guard('admin')->user()->nama_lengkap;
        activity()->causedBy($benefit)->log($getUser . ' melakukan tambah data Benefit baru');

        return redirect(route('admin.manageBenefit'))->with('success', 'Data berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Benefit $benefit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($uuid)
    {
        $data['pageTitle'] = 'Edit Benefit Data';
        $data['benefitData'] = Benefit::where('uuid', $uuid)->get();

        return view('admin.benefit.benefit_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Benefit $benefit)
    {
        $validatedData = $request->validate([
            'title' => ['required'],
            'fa_icon' => ['required'],
            'detail' => ['required', 'max:255'],
        ]);

        $benefit = Benefit::where('id', $benefit->id)->update($validatedData);

        $getUser = Auth::guard('admin')->user()->nama_lengkap;
        activity()->causedBy($benefit)->log($getUser . ' melakukan update data Benefit');

        return redirect(route('admin.manageBenefit'))->with('success', 'Data berhasil disimpan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $benefit = Benefit::find($id);
        $benefit->delete();

        $getUser = Auth::guard('admin')->user()->nama_lengkap;
        activity()->causedBy($benefit)->log($getUser . ' melakukan delete data Benefit');

        return redirect(route('admin.manageBenefit'))->with('success', 'Data berhasil dihapus!');
    }
}
