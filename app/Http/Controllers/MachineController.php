<?php

namespace App\Http\Controllers;

use App\Models\Machine;
use App\Http\Requests\StoreMachineRequest;
use App\Http\Requests\UpdateMachineRequest;
use App\Models\MachineType;
use App\Models\Status;
use App\Events\MachineNeedsService;
use Illuminate\Http\Request;

class MachineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
       
        $search = $request->input('search');
        $statusId = $request->input('status_id'); 

        $query = Machine::with('type', 'status');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('serial_number', 'like', '%' . $search . '%')
                  ->orWhere('brand', 'like', '%' . $search . '%')
                  ->orWhere('model', 'like', '%' . $search . '%');
            });
        }

        if ($statusId && $statusId != 'all') { 
            $query->where('status_id', $statusId);
        }

        $machines = $query->paginate(10)->appends($request->query()); 
        $statuses = Status::all();

        return view('machines.index', compact('machines', 'statuses')); 
    

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('machines.create', [
            'types' => MachineType::all(), 
            'statuses' => Status::all(), 
        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMachineRequest $request)
    {
        
        Machine::create($request->validated() + [
            'serial_number' => strtoupper($request->input('serial_number')), 
            
        ]);
        
        return redirect('/machines')->with('success', 'Máquina creada correctamente.');
    }

    /**
     * Display the specified resource.
     */

    public function show(Machine $machine, $id)
    {
        $machine = Machine::Find($id);

        //dd($id);
        if (!$machine) {
            return response()->json(['message' => 'Máquina no encontrada'], 404);
        } 
        
         return view ('machines.show', [
            'machine' => $machine,
            ]);
        
    }

       

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Machine $machine, $id)
    {
        $machine = Machine::find($id);

        if (!$machine) {
            
            return redirect('/machines')->with('error', 'Máquina no encontrada.');
        } 
        
        if ($machine->status_id == 1) { 
            return redirect('/machines')->with('error', 'No se puede editar una máquina que se encuentra en uso.');
        }
        
        $types = MachineType::all(); 
        $statuses = Status::all(); 

        return view('machines.edit', [
            'machine' => $machine,
            'statuses' => $statuses,
            'types' => $types,
            'id' => $id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMachineRequest $request, $id)
    {

        $machine = Machine::find($id);

        if (!$machine) {
            return redirect('/machines')->with('error', 'Máquina no encontrada.');
        } 

        if ($machine->status_id == 1) { 
            return redirect('/machines')->with('error', 'No se puede actualizar una máquina que se encuentra en uso.');
        }

        $validatedData = $request->validated();
        $machine->update($validatedData);

        return redirect('/machines')->with('success', 'Máquina actualizada correctamente.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Machine $machine, $id)
    {
        $machine = Machine::find($id);
        if (!$machine) {
            return response()->json(['message' => 'Máquina no encontrada'], 404);
        } 

        if ($machine->status_id == 1) { 
            return response()->json(['error' => 'No se puede dar de baja una máquina en uso'], 400);
        }

        $machine->status_id = 4;
        $machine->save();

        return redirect ('/machines')->with('success', 'Máquina dada de baja correctamente');
    }
}
