<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Term;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ManageTermsController extends Controller
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
    public function show(Term $term)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['pageTitle'] = 'Edit Content Terms & Condition';

        $decryptId = Crypt::decryptString($id);
        $data['termsData'] = Term::where('id', $decryptId)->first();

        return view('admin.terms.terms_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Term $term)
    {
        $validatedData = $request->validate([
            'content' => ['required'],
        ]);

        $term = Term::where('id', $term->id)->update($validatedData);

        return redirect(route('admin.manageContent'))->with('success', 'Data berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Term $term)
    {
        //
    }
}
