<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CursoController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $cursos = Curso::all();
        return view('models.curso.index', compact('cursos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('models.curso.create');
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
            'abreviatura' => ['required', 'string'],
            'tempo' => ['required', 'string']
        ]);

        $curso = Curso::create($validatedData);

        if ($request->wantsJson() || Str::startsWith(request()->path(), 'api')) return response()->json($curso);
        return redirect(route('curso.index'))->with(['status' => 'success', 'message' => 'Curso cadastrado!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function show(Curso $curso) {
        if (request()->wantsJson()) return response()->json($curso);
        return view('models.curso.show', compact('curso'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function edit(Curso $curso) {
        return view('models.curso.create', compact('curso'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Curso $curso) {
        $validatedData = $request->validate([
            'nome' => ['required', 'string'],
            'abreviatura' => ['required', 'string'],
            'tempo' => ['required', 'string']
        ]);

        $curso->update($validatedData);

        if ($request->wantsJson() || Str::startsWith(request()->path(), 'api')) return response()->json($curso);
        return redirect(route('curso.index'))->with(['status' => 'success', 'message' => 'Curso editado!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Curso $curso) {
        //
    }
}
