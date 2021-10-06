<?php

namespace App\Http\Controllers;

use App\Models\Disciplina;
use Illuminate\Http\Request;

class DisciplinaController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $disciplinas = Disciplina::with(['componente', 'turma'])->get();
        return view('models.disciplina.index', compact('disciplinas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $validatedData = $request->validate([
            'nome' => ['nullable', 'string'],
            'bimestres' => ['nullable', 'string'],
            'componente_id' => ['nullable', 'numeric', 'min:1'],
            'turma_id' => ['nullable', 'numeric', 'min:1'],
            'peso_trab' => ['nullable', 'string'],
            'peso_ava' => ['nullable', 'string'],
            'peso_1b' => ['nullable', 'string'],
            'peso_2b' => ['nullable', 'string'],
            'peso_3b' => ['nullable', 'string'],
            'peso_4b' => ['nullable', 'string'],
            'conc_a' => ['nullable', 'string'],
            'conc_b' => ['nullable', 'string'],
            'conc_c' => ['nullable', 'string'],
        ]);

        $disciplina = Disciplina::create($validatedData);
        $disciplina = Disciplina::with(['componente', 'turma'])->find($disciplina->id);

        return response()->json($disciplina);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Disciplina  $disciplina
     * @return \Illuminate\Http\Response
     */
    public function show(Disciplina $disciplina) {
        $disciplina = Disciplina::with(['componente', 'turma'])->find($disciplina->id);
        return response()->json($disciplina);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Disciplina  $disciplina
     * @return \Illuminate\Http\Response
     */
    public function edit(Disciplina $disciplina) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Disciplina  $disciplina
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Disciplina $disciplina) {
        $validatedData = $request->validate([
            'nome' => ['nullable', 'string'],
            'bimestres' => ['nullable', 'string'],
            'componente_id' => ['nullable', 'numeric', 'min:1'],
            'turma_id' => ['nullable', 'numeric', 'min:1'],
            'peso_trab' => ['nullable', 'string'],
            'peso_ava' => ['nullable', 'string'],
            'peso_1b' => ['nullable', 'string'],
            'peso_2b' => ['nullable', 'string'],
            'peso_3b' => ['nullable', 'string'],
            'peso_4b' => ['nullable', 'string'],
            'conc_a' => ['nullable', 'string'],
            'conc_b' => ['nullable', 'string'],
            'conc_c' => ['nullable', 'string'],
        ]);

        $disciplina->update($validatedData);
        $disciplina = Disciplina::with(['componente', 'turma'])->find($disciplina->id);

        return response()->json($disciplina);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Disciplina  $disciplina
     * @return \Illuminate\Http\Response
     */
    public function destroy(Disciplina $disciplina) {
        //
    }
}
