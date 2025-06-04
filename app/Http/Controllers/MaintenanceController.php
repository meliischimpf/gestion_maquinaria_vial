<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Http\Requests\StoreMaintenanceRequest;
use App\Http\Requests\UpdateMaintenanceRequest;
use Illuminate\Http\Request;
use App\Models\Machine;
use App\Models\Work;
use App\Models\MaintenanceType;


class MaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Maintenance::query();

        if ($search = $request->input('search')) {
            $query->whereHas('machine', function ($q) use ($search) {
                $q->where('serial_number', 'like', '%' . $search . '%');
            })->orWhereHas('type', function ($q) use ($search) { 
                $q->where('name', 'like', '%' . $search . '%');
            });
        }

        if ($maintenanceTypeId = $request->input('maintenance_type_id') && $request->input('maintenance_type_id') != 'all') {
            $query->where('maintenance_type_id', $maintenanceTypeId);
        }

        if ($machineId = $request->input('machine_id') && $request->input('machine_id') != 'all') {
            $query->where('machine_id', $machineId);
        }

        $maintenances = $query->with(['machine', 'type'])->paginate(10); 

        $maintenanceTypes = MaintenanceType::all();
        $machines = Machine::all();

        return view('maintenances.index', compact('maintenances', 'maintenanceTypes', 'machines'));
    
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
    public function store(StoreMaintenanceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Maintenance $maintenance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Maintenance $maintenance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMaintenanceRequest $request, Maintenance $maintenance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Maintenance $maintenance)
    {
        //
    }
}
