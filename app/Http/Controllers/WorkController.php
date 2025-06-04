<?php

namespace App\Http\Controllers;

use App\Models\Work;
use App\Http\Requests\StoreWorkRequest;
use App\Http\Requests\UpdateWorkRequest;
use Illuminate\Http\Request;
use App\Models\Province;

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $provinceId = $request->input('province_id'); 

        $query = Work::with('province'); 

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

       
        if ($provinceId && $provinceId != 'all') {
            $query->where('province_id', $provinceId);
        }

        
        $works = $query->paginate(10)->appends($request->query()); 

     
        $provinces = Province::all();

        return view('works.index', compact('works', 'provinces'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $provinces = Province::all(); 

        return view('works.create', [
            'provinces' => $provinces,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWorkRequest $request)
    {
        
        $data = $request->validated();
        $data['end_date_real'] = null;

        Work::create($data); 

        return redirect('/works')->with('success', 'Obra creada correctamente.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Work $work, $id)
    {
        $work = Work::Find($id);
         if (!$work) {
            return redirect()->route('works')->with('error', 'Trabajo no encontrado.');
        } 
        

        return view('works.show', [
            'work' => $work,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Work $work, $id)
    {
        $work = Work::find($id); // Buscamos la obra por el ID

        if (!$work) {
            return redirect()->route('works')->with('error', 'Obra no encontrada.');
        }
    
        return view('works.edit', [
            'work' => $work,
            'provinces' => Province::all(), 
            'id' => $id, 
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWorkRequest $request, $id)
    {
        $work = Work::find($id);
        
        if (!$work) {
            return redirect()->route('works')->with('error', 'Obra no encontrada.');
        }
        
        $validatedData = $request->validated();
        
        $work->update($validatedData);

        return redirect()->route('works')->with('success', 'Obra actualizada correctamente.');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        
        $work = Work::findOrFail($id); 

        $request->validate([
            'end_date_real' => 'required|date',
        ]);

        $work->end_date_real = $request->input('end_date_real');
        $work->save(); 

        return redirect()->route('works')->with('success', 'La obra ha sido marcada como completada con la fecha de fin real.');
    }
}
