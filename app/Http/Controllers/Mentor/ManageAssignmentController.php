<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Document;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ManageAssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['pageTitle'] = 'Assignment List';

        return view('mentor.assignment.assignment_list', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['pageTitle'] = 'Create Assignment';
        $user = Auth::user();
        $data['userData'] = Document::with('user', 'status')
            ->where('office_id', $user->office_id)
            ->whereHas('status', function ($query) {
                $query->where('status', 'diterima');
            })->get();

        return view('mentor.assignment.assignment_create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'status_id' => ['required'],
            'judul' => ['required'],
            'start_date' => ['nullable', 'date_format:d/m/Y'],
            'due_date' => ['nullable', 'date_format:d/m/Y'],
            'pertanyaan' => ['required'],
            'doc_pertanyaan' => 'nullable|mimes:pdf|max:2048',
        ]);

        $validatedData['start_date'] = Carbon::createFromFormat('d/m/Y', $validatedData['start_date'])->format('Y-m-d');
        $validatedData['due_date'] = Carbon::createFromFormat('d/m/Y', $validatedData['due_date'])->format('Y-m-d');

        Assignment::create($validatedData);

        return redirect(route('mentor.manageAssignment'))->with('success', 'Data berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Assignment $assignment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Assignment $assignment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Assignment $assignment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Assignment $assignment)
    {
        //
    }
}
