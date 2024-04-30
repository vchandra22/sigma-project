<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Journey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManageJourneyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['pageTitle'] = 'Internship Journey';
        $data['journeyData'] = Journey::paginate(10);

        return view('admin.journey.journey_list', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['pageTitle'] = 'Tambah Journey';

        return view('admin.journey.journey_create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => ['required'],
            'detail' => ['required', 'max:255'],
        ]);

        $journey = Journey::create($validatedData);

        $getUser = Auth::guard('admin')->user()->nama_lengkap;
        activity()->causedBy($journey)->log($getUser . ' melakukan tambah data Journey baru');

        return redirect(route('admin.manageJourney'))->with('success', 'Data berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Journey $journey)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($uuid)
    {
        $data['pageTitle'] = 'Edit Journey';
        $data['journeyData'] = Journey::where('uuid', $uuid)->get();

        return view('admin.journey.journey_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Journey $journey)
    {
        $validatedData = $request->validate([
            'title' => ['required'],
            'detail' => ['required', 'max:255'],
        ]);

        $journey = Journey::where('id', $journey->id)->update($validatedData);

        $getUser = Auth::guard('admin')->user()->nama_lengkap;
        activity()->causedBy($journey)->log($getUser . ' melakukan update data Journey');

        return redirect(route('admin.manageJourney'))->with('success', 'Data berhasil disimpan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $journey = Journey::find($id);
        $journey->delete();

        $getUser = Auth::guard('admin')->user()->nama_lengkap;
        activity()->causedBy($journey)->log($getUser . ' melakukan delete data Journey');

        return redirect(route('admin.manageJourney'))->with('success', 'Data berhasil dihapus!');
    }
}
