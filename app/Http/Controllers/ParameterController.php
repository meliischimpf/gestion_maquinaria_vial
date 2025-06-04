<?php

namespace App\Http\Controllers;

use App\Models\Parameter;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreParameterRequest;
use App\Http\Requests\UpdateParameterRequest;

class ParameterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parameters = Parameter::all(); 

        return view('parameters.index', compact('parameters'));
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
    public function store(StoreParameterRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Parameter $parameter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Parameter $parameter, $id)
    {
        $parameter = Parameter::find($id); 

        
        if (!$parameter) {
            return redirect()->route('parameters')->with('error', 'Parámetro no encontrado.');
        }
        
        return view('parameters.edit', compact('parameter'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateParameterRequest $request, Parameter $parameter, $id)
    {
        $parameter = Parameter::find($id);

        if (!$parameter) {
            return redirect()->route('parameters')->with('error', 'Parámetro no encontrado.');
        }
        
        $validatedData = $request->validated();
        
        $parameter->update($validatedData);

        return redirect()->route('parameters')->with('success', 'Parámetro actualizado correctamente.');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Parameter $parameter)
    {
        //
    }
}
