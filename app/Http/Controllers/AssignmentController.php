<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Http\Requests\StoreAssignmentRequest;
use App\Http\Requests\UpdateAssignmentRequest;
use Illuminate\Http\Request;
use App\Models\AssignmentEnd;
use App\Models\Machine;
use App\Models\Work;
use Illuminate\Support\Facades\Auth;
use App\Events\AssignmentEnded;
use App\Listeners\ProcessAssignmentEnd;
use Illuminate\Support\Facades\DB;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $activeAssignments = Assignment::with(['machine', 'work'])
                                        ->whereNull('end_date')
                                        ->orderBy('start_date', 'desc')
                                        ->paginate(10, ['*'], 'activePage'); 

        
        $finishedAssignments = Assignment::with(['machine', 'work', 'assignmentend'])
                                            ->whereNotNull('end_date')
                                            ->orderBy('end_date', 'desc')
                                            ->paginate(10, ['*'], 'finishedPage'); 

        
        $assignment_ends = AssignmentEnd::all();

        return view('assignments.index', compact('activeAssignments', 'finishedAssignments', 'assignment_ends'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('assignments.create', [
           
            'machines' => Machine::all(),
            'works' => Work::all(),
        ]);
    }

    public function store(StoreAssignmentRequest $request)
    {
        $assignmentData = $request->validated();
        $assignmentData['end_date'] = null; 
        
        Assignment::create($assignmentData);

        return redirect('/assignments')->with('success', 'Asignación creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Assignment $assignment, $id)
    {
        $assignment = Assignment::with(['assignmentEnd', 'machine', 'work'])->findOrFail($id); // Usar findOrFail para lanzar un 404 si no existe

        return view('assignments.show', compact('assignment'));
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Assignment $assignment, $id)
    {
    $assignment = Assignment::find($id);

        if (!$assignment) {
            return redirect('/assignments')->with('error', 'Asignación no encontrada.');
        }

        $machines = Machine::all();
        $works = Work::all();

        return view('assignments.edit', [
            'assignment' => $assignment,
            'machines' => $machines,
            'works' => $works,
            'id' => $id, 
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAssignmentRequest $request, Assignment $assignment)
    {
        $assignment = Assignment::find($assignment->id);

        if (!$assignment) {
            return redirect('/assignments')->with('error', 'Asignación no encontrada.');
        }

        $validatedData = $request->validated();
        $assignment->update($validatedData);

        return redirect('/assignments')->with('success', 'Asignación actualizada correctamente.');
    }

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $assignment = Assignment::find($id);

        if (!$assignment) {
            return redirect()->route('assignments')->with('error', 'Asignación no encontrada.');
        }

        if ($assignment->end_date) {
            return redirect()->route('assignments')->with('error', 'Esta asignación ya ha sido finalizada.');
        }

        $request->validate([
            'end_date' => 'required|date',
            'assignment_end_id' => 'required|exists:assignment_ends,id',
            'km_traveled' => 'nullable|numeric|min:0',
        ]);
        

        DB::transaction(function () use ($request, $assignment) {
            $assignment->update([
                'end_date' => $request->input('end_date'),
                'assignment_end_id' => $request->input('assignment_end_id'), 
                'km_traveled' => $request->input('km_traveled'),
            ]);

        

            event(new AssignmentEnded($assignment));
        });

        return redirect()->route('assignments')->with('status', 'La asignación ha sido finalizada correctamente.');
    }
}
