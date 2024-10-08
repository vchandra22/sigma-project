<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Announcement;
use App\Models\Office;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;
use App\Charts\DataPesertaChart;

class DashboardAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(DataPesertaChart $chart)
    {
        $data['pageTitle'] = 'Admin Dashboard';

        $data['announcementUuid'] = Announcement::first();
        $data['announcementData'] = Announcement::latest('updated_at')->get();

        $admin = Auth::guard('admin')->user();
        $data['userData'] = Admin::with('roles')->where('id', $admin->id)->get();
        $data['activityLog'] = Activity::latest('created_at')->get();

        $data['getOffice'] = Office::where('id', $admin->office_id)->get();
        $data['chart'] = $chart->build();

        return view('admin.dashboard', $data);
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
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
