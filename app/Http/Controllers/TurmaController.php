<?php

namespace App\Http\Controllers;

use App\Models\Turma;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TurmaController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $turmas = Turma::with('curso')->get();
        return view('models.turma.index', compact('turmas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

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
            'ano' => ['required', 'string'],
            'abreviatura' => ['required', 'string'],
            'curso_id' => ['required', 'numeric', 'min:1']
        ]);

        $turma = Turma::create($validatedData);
        $turma = Turma::with('curso')->find($turma->id);

        return response()->json($turma);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Turma  $turma
     * @return \Illuminate\Http\Response
     */
    public function show(Turma $turma) {
        $turma = Turma::with('curso')->find($turma->id);
        return response()->json($turma);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Turma  $turma
     * @return \Illuminate\Http\Response
     */
    public function edit(Turma $turma) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Turma  $turma
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Turma $turma) {
        $validatedData = $request->validate([
            'nome' => ['required', 'string'],
            'ano' => ['required', 'string'],
            'abreviatura' => ['required', 'string'],
            'curso_id' => ['required', 'numeric', 'min:1']
        ]);

        $turma->update($validatedData);
        $turma = Turma::with('curso')->find($turma->id);

        return response()->json($turma);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Turma  $turma
     * @return \Illuminate\Http\Response
     */
    public function destroy(Turma $turma) {
        //
    }
}
