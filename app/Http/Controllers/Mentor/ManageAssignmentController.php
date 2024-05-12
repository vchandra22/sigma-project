<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Document;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use File;

class ManageAssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['pageTitle'] = 'Assignment List';

        $user = Auth::user();

        $data['assignmentData'] = Assignment::where('created_by', $user->id)->latest()->paginate(10);

        return view('mentor.assignment.assignment_list', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['pageTitle'] = 'Create Assignment';
        $user = Auth::user();
        $data['userData'] = Document::with('user', 'status', 'position')
            ->where('office_id', $user->office_id)
            ->whereHas('status', function ($query) {
                $query->where('status', 'diterima');
            })
            ->latest()
            ->get();

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
            'doc_pertanyaan' => 'nullable|mimes:pdf,zip,rar,docx,xlsx,xls,txt|max:2048',
        ]);

        $validatedData['start_date'] = Carbon::createFromFormat('d/m/Y', $validatedData['start_date'])->format('Y-m-d');
        $validatedData['due_date'] = Carbon::createFromFormat('d/m/Y', $validatedData['due_date'])->format('Y-m-d');
        $validatedData['created_by'] = Auth::user()->id;

        if ($request->hasFile('doc_pertanyaan')) {
            $file = $request->file('doc_pertanyaan');
            $directoryPath = 'private/assignments';

            // Create directory if not exists
            if (!file_exists($directoryPath)) {
                Storage::disk('local')->makeDirectory($directoryPath, 0775, true);
            }

            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
            Storage::disk('local')->put('/private/assignments/' . $filename, File::get($file));
            $validatedData['doc_pertanyaan'] = $filename;
        }

        Assignment::create($validatedData);

        return redirect(route('mentor.manageAssignment'))->with('success', 'Data berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $data['pageTitle'] = 'Detail Assignment';
        $data['assignmentData'] = Assignment::where('slug', $slug)->get();

        $status_id = $data['assignmentData']->pluck('status_id')->unique();
        $data['userData'] = Document::with('user', 'status')->whereIn('id', $status_id)->firstOrFail();

        return view('mentor.assignment.assignment_detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $data['pageTitle'] = 'Edit Assignment';
        $user = Auth::user();
        $data['assignmentData'] = Assignment::where('slug', $slug)->get();
        $data['userData'] = Document::with('user', 'status')
            ->where('office_id', $user->office_id)
            ->whereHas('status', function ($query) {
                $query->where('status', 'diterima');
            })->get();

        return view('mentor.assignment.assignment_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Assignment $assignment)
    {
        $validatedData = $request->validate([
            'status_id' => ['required'],
            'judul' => ['required'],
            'start_date' => ['nullable', 'date_format:d/m/Y'],
            'due_date' => ['nullable', 'date_format:d/m/Y'],
            'pertanyaan' => ['required'],
            'doc_pertanyaan' => 'nullable|mimes:pdf,zip,rar,docx,xlsx,xls,txt|max:2048',
        ]);

        $validatedData['start_date'] = Carbon::createFromFormat('d/m/Y', $validatedData['start_date'])->format('Y-m-d');
        $validatedData['due_date'] = Carbon::createFromFormat('d/m/Y', $validatedData['due_date'])->format('Y-m-d');
        $validatedData['created_by'] = Auth::user()->id;

        if ($request->hasFile('doc_pertanyaan')) {
            
            $oldFilename = $assignment->doc_pertanyaan;

            // Delete the old file
            if ($oldFilename) {
                Storage::disk('local')->delete('private/assignments/' . $oldFilename);
            }

            // Upload the new file
            $file = $request->file('doc_pertanyaan');
            $directoryPath = 'private/assignments';

            if (!file_exists($directoryPath)) {
                Storage::disk('local')->makeDirectory($directoryPath, 0775, true);
            }

            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
            Storage::disk('local')->put('/private/assignments/' . $filename, File::get($file));
            $validatedData['doc_pertanyaan'] = $filename;
        }

        $newSlug = Str::slug($request->input('judul'));

        if ($newSlug !== $assignment->slug) {
            $count = 1;
            $slugExists = Assignment::where('slug', $newSlug)->exists();
            while ($slugExists) {
                $newSlug = $newSlug . '-' . $count;
                $slugExists = Assignment::where('slug', $newSlug)->exists();
                $count++;
            }
            $assignment->slug = $newSlug;
        }
        $validatedData['slug'] = $newSlug;

        Assignment::where('id', $assignment->id)->update($validatedData);

        return redirect(route('mentor.manageAssignment'))->with('success', 'Data berhasil disimpan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $assignment = Assignment::find($id);
        // Delete files from storage if they exist
        if ($assignment->doc_pertanyaan) {
            Storage::disk('local')->delete('private/assignments/' . $assignment->doc_pertanyaan);
        }
        if ($assignment->doc_jawaban) {
            Storage::disk('local')->delete('private/assignments/' . $assignment->doc_jawaban);
        }
        $assignment->delete();

        return redirect(route('mentor.manageAssignment'))->with('success', 'Data berhasil dihapus!');
    }

    public function downloadPertanyaan($assignment)
    {
        $assignment = Assignment::where('uuid', $assignment)->first();
        $filePath = storage_path('app/private/assignments/' . $assignment->doc_pertanyaan);

        // Return the file as a download response
        return response()->download($filePath);
    }
}
