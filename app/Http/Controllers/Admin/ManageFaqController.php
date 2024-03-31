<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ManageFaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['pageTitle'] = 'FAQ';
        $data['faqData'] = Faq::all();

        return view('admin.faq.faq_list', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['pageTitle'] = 'Tambah Pertanyaan';

        return view('admin.faq.faq_create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'pertanyaan' => ['required'],
            'jawaban' => ['required']
        ]);

        Faq::create($validatedData);

        return redirect(route('admin.manageFaq'))->with('success', 'Data berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Faq $faq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $data['pageTitle'] = 'Edit FAQ';
        $data['faqData'] = Faq::where('slug', $slug)->get();

        return view('admin.faq.faq_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Faq $faq)
    {
        $validatedData = $request->validate([
            'pertanyaan' => ['required'],
            'jawaban' => ['required']
        ]);

        $newSlug = Str::slug($request->input('pertanyaan'));

        if ($newSlug !== $faq->slug) {
            $count = 1;
            $slugExists = Faq::where('slug', $newSlug)->exists();
            while ($slugExists) {
                $newSlug = $newSlug . '-' . $count;
                $slugExists = Faq::where('slug', $newSlug)->exists();
                $count++;
            }
            $faq->slug = $newSlug;
        }

        $validatedData['slug'] = $newSlug;
        $faq = Faq::where('id', $faq->id)->update($validatedData);

        return redirect(route('admin.manageFaq'))->with('success', 'Data berhasil diupdate!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $faq = Faq::find($id);
        $faq->delete();

        return redirect(route('admin.manageFaq'))->with('success', 'Data berhasil dihapus!');
    }
}
