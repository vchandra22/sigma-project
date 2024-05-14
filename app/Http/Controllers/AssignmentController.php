<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAssignmentRequest;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Assignment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use File;
use Illuminate\Support\Str;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['pageTitle'] = 'Assignment';
        $user = Auth::user(); // Retrieve the authenticated user

        $data['assignmentData'] = Assignment::where('status_id', $user->id)->latest()->paginate(10);
        // Check if assignment data is empty
        if ($data['assignmentData']->isEmpty()) {
            $data['mentorData'] = null;
        } else {
            // If assignment data is not empty, fetch mentor data based on assignment data
            $mentor_ids = $data['assignmentData']->pluck('created_by')->unique();
            $data['mentorData'] = Admin::whereIn('id', $mentor_ids)->get();
        }

        return view('user.assignment_list', $data);
    }

    public function statusBelumDikerjakan()
    {
        $data['pageTitle'] = 'Assignment';
        $user = Auth::user(); // Retrieve the authenticated user

        $data['assignmentData'] = Assignment::where('status_id', $user->id)->where('status', 'dikirim')->latest()->paginate(10);
        // Check if assignment data is empty
        if ($data['assignmentData']->isEmpty()) {
            $data['mentorData'] = null;
        } else {
            // If assignment data is not empty, fetch mentor data based on assignment data
            $mentor_ids = $data['assignmentData']->pluck('created_by')->unique();
            $data['mentorData'] = Admin::whereIn('id', $mentor_ids)->get();
        }

        return view('user.assignment_list', $data);
    }


    public function statusSelesai()
    {
        $data['pageTitle'] = 'Assignment';
        $user = Auth::user(); // Retrieve the authenticated user

        $data['assignmentData'] = Assignment::where('status_id', $user->id)->where('status', 'selesai')->latest()->paginate(10);
        // Check if assignment data is empty
        if ($data['assignmentData']->isEmpty()) {
            $data['mentorData'] = null;
        } else {
            // If assignment data is not empty, fetch mentor data based on assignment data
            $mentor_ids = $data['assignmentData']->pluck('created_by')->unique();
            $data['mentorData'] = Admin::whereIn('id', $mentor_ids)->get();
        }

        return view('user.assignment_list', $data);
    }

    public function statusTerlambat()
    {
        $data['pageTitle'] = 'Assignment';
        $user = Auth::user(); // Retrieve the authenticated user

        $data['assignmentData'] = Assignment::where('status_id', $user->id)->where('status', 'terlambat')->latest()->paginate(10);
        // Check if assignment data is empty
        if ($data['assignmentData']->isEmpty()) {
            $data['mentorData'] = null;
        } else {
            // If assignment data is not empty, fetch mentor data based on assignment data
            $mentor_ids = $data['assignmentData']->pluck('created_by')->unique();
            $data['mentorData'] = Admin::whereIn('id', $mentor_ids)->get();
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
            'doc_jawaban' => 'nullable|mimes:pdf,zip,rar,docx,xlsx,xls,txt|max:2048',
        ]);

        if ($request->hasFile('doc_jawaban')) {
            $file = $request->file('doc_jawaban');
            $directoryPath = 'private/assignments';

            // Create directory if not exists
            if (!file_exists($directoryPath)) {
                Storage::disk('local')->makeDirectory($directoryPath, 0775, true);
            }

            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
            Storage::disk('local')->put('/private/assignments/' . $filename, File::get($file));
            $validatedData['doc_jawaban'] = $filename;
        }

        $validatedData['status'] = 'selesai';

        // Check if assignment is overdue
        if ($assignment->updated_at > $assignment->due_date) {
            $validatedData['status'] = 'terlambat';
        } else {
            $validatedData['status'] = 'selesai';
        }

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

    public function downloadJawaban($assignment)
    {
        $assignment = Assignment::where('uuid', $assignment)->first();
        $filePath = storage_path('app/private/assignments/' . $assignment->doc_jawaban);

        // Return the file as a download response
        return response()->download($filePath);
    }

    public function cancelJawaban(Assignment $assignment)
    {
        $filename = $assignment->doc_jawaban;

        if ($filename) {
            Storage::disk('local')->delete('private/assignments/' . $filename);
        }
        // Update assignment data
        $assignment->update(['doc_jawaban' => null, 'status' => 'dikirim']);

        return redirect(route('user.assignment'))->with('success', 'Sukses membatalkan jawaban!');
    }
}
