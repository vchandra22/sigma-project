<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\Home;
use App\Models\Homepage;
use App\Models\Logbook;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class ManageLogbookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['pageTitle'] = 'Logbook List';

        return view('mentor.logbook.logbook_list', $data);
    }

    public function tableLogbook()
    {
        $user = Auth::guard('admin')->user();
        $getData['findStatusId'] = Logbook::all();
        $status_id = $getData['findStatusId']->pluck('status_id')->unique();

        $query = User::join('documents', 'users.id', '=', 'documents.user_id')
            ->join('statuses', 'documents.id', '=', 'statuses.document_id')
            ->join('logbooks', 'statuses.id', '=', 'logbooks.status_id')
            ->where('documents.office_id', $user->office_id)
            ->whereIn('logbooks.status_id', $status_id)
            ->select('users.nama_lengkap', 'documents.no_identitas', 'documents.instansi_asal', 'logbooks.status_id', 'statuses.created_at', 'statuses.status')
            ->orderByDesc('statuses.created_at')
            ->distinct();

        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('nama_lengkap', function ($data) {
                return $data->nama_lengkap;
            })
            ->editColumn('instansi_asal', function ($data) {
                return $data->instansi_asal;
            })
            ->editColumn('status', function ($data) {
                return $data->status;
            })
            ->addColumn('opsi', function ($data) {
                // Assuming you have a route named 'detail' to show details
                $detailRoute = route('mentor.showLogbook', ['id' => encrypt($data->status_id)]);

                return '<a href="' . $detailRoute . '" class="py-2 text-md text-blue-500 cursor-pointer hover:underline" onclick="var newWindow = window.open(\'' . $detailRoute . '\', \'newwindow\', \'width=900,height=880\'); newWindow.onload = function() { newWindow.print(); }; return false;" target="_blank">Detail</a>';
            })
            ->filterColumn('instansi_asal', function ($query, $keyword) {
                $query->where('documents.instansi_asal', 'like', "%$keyword%");
            })
            ->filterColumn('status', function ($query, $keyword) {
                $query->where('statuses.status', 'like', "%$keyword%");
            })
            ->rawColumns(['opsi'])
            ->make(true);
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
    public function show($id)
    {
        $data['pageTitle'] = 'Logbook Magang';
        $data['aboutData'] = Homepage::firstOrFail();

        $status_id = Crypt::decrypt($id);
        $data['userData'] = User::join('documents', 'users.id', '=', 'documents.user_id')
            ->join('offices', 'documents.office_id', '=', 'offices.id')
            ->join('positions', 'documents.position_id', '=', 'positions.id')
            ->join('statuses', 'documents.id', '=', 'statuses.document_id')
            ->join('logbooks', 'statuses.id', '=', 'logbooks.status_id')
            ->where('logbooks.status_id', $status_id)
            ->first();

        $data['logbookData'] = User::join('documents', 'users.id', '=', 'documents.user_id')
            ->join('statuses', 'documents.id', '=', 'statuses.document_id')
            ->join('logbooks', 'statuses.id', '=', 'logbooks.status_id')
            ->where('logbooks.status_id', $status_id)
            ->oldest('logbooks.tgl_magang')
            ->get();

        return view('mentor.logbook.logbook_show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Logbook $logbook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Logbook $logbook)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Logbook $logbook)
    {
        //
    }
}
