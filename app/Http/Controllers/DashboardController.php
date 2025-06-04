<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Machine; 
use App\Models\Work;    
use App\Models\Assignment; 

class DashboardController extends Controller
{
    /**
     * Display a dashboard with important statistics.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        
        $totalMachines = Machine::count();
        $machinesInUse = Machine::where('status_id', 1)->count();

        $totalWorks = Work::count();
        $activeWorks = Work::whereNull('end_date_real')->count(); 
       
        $totalAssignments = Assignment::count();
        $pendingAssignments = Assignment::whereNull('end_date')->count(); 
        return view('dashboard', compact(
            'totalMachines',
            'machinesInUse',
            'totalWorks',
            'activeWorks',
            'totalAssignments',
            'pendingAssignments'
        ));
    }
}
