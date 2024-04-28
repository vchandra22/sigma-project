<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAssignmentRequest;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Assignment;
use Illuminate\Support\Facades\Auth;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['pageTitle'] = 'Assignment';
        $user = Auth::user(); //mengambil id user yang telah login
        $data['assignmentData'] = Assignment::where('status_id', $user->id)->latest()->paginate(10);

        if ($data['assignmentData']->isEmpty()) {

            $data['mentorData'] = null;
        } else {
            // If assignment data is not empty, fetch mentor data based on assignment data
            $mentor_id = $data['assignmentData']->pluck('created_by')->unique();
            $data['mentorData'] = Admin::whereIn('id', $mentor_id)->firstOrFail();
        }

        return view('user.assignment_list', $data);
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
    public function store(StoreAssignmentRequest $request)
    {
        //
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
    public function edit($slug)
    {
        $data['pageTitle'] = 'Assignment Detail';
        $data['assignmentData'] = Assignment::where('slug', $slug)->get();

        $mentor_id = $data['assignmentData']->pluck('created_by')->unique();
        $data['mentorData'] = Admin::whereIn('id', $mentor_id)->firstOrFail();

        return view('user.assignment_detail', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Assignment $assignment)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'doc_jawaban' => 'nullable|mimes:pdf|max:2048',
        ]);

        $validatedData['status'] = 'selesai';

        Assignment::where('id', $assignment->id)->update($validatedData);

        return redirect(route('user.assignment'))->with('success', 'Data berhasil disimpan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Assignment $assignment)
    {
        //
    }
}
