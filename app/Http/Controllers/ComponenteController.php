<?php

namespace App\Http\Controllers;

use App\Models\Componente;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ComponenteController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $componentes = Componente::with('curso')->get();
        return view('models.componente.index', compact('componentes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('models.componente.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $validatedData = $request->validate([
            'nome' => ['required', 'string'],
            'aulas' => ['required', 'numeric', 'min:1'],
            'curso_id' => ['required', 'numeric', 'min:1']
        ]);

        $componente = Componente::create($validatedData);
        $componente = Componente::with('curso')->find($componente->id);

        if ($request->wantsJson() || Str::startsWith(request()->path(), 'api')) return response()->json($componente);
        return redirect(route('componente.index'))->with(['status' => 'success', 'message' => 'Componente cadastrado!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Componente  $componente
     * @return \Illuminate\Http\Response
     */
    public function show(Componente $componente) {
        $componente = Componente::with('curso')->find($componente->id);
        if (request()->wantsJson()) return response()->json($componente);
        return view('models.componente.show', compact('componente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Componente  $componente
     * @return \Illuminate\Http\Response
     */
    public function edit(Componente $componente) {
        return view('models.componente.create', compact('componente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Componente  $componente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Componente $componente) {
        $validatedData = $request->validate([
            'nome' => ['required', 'string'],
            'aulas' => ['required', 'numeric', 'min:1'],
            'curso_id' => ['required', 'numeric', 'min:1']
        ]);

        $componente->update($validatedData);
        $componente = Componente::with('curso')->find($componente->id);

        if ($request->wantsJson() || Str::startsWith(request()->path(), 'api')) return response()->json($componente);
        return redirect(route('componente.index'))->with(['status' => 'success', 'message' => 'Componente editado!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Componente  $componente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Componente $componente) {
        //
    }
}
