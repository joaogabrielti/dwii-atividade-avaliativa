@extends('layouts.app')

@section('content')
<div class="row g-2">
    <div class="col-6 col-md-3">
        <a class="d-flex flex-column align-items-center link-secondary text-decoration-none" href="{{ route('curso.index') }}">
            <img class="img-fluid" src="{{ asset('images/curso_ico.png') }}">
            <span class="fs-5 fw-bold">Cursos</span>
        </a>
    </div>
    <div class="col-6 col-md-3">
        <a class="d-flex flex-column align-items-center link-secondary text-decoration-none" href="{{ route('componente.index') }}">
            <img class="img-fluid" src="{{ asset('images/componente_ico.png') }}">
            <span class="fs-5 fw-bold">Componentes</span>
        </a>
    </div>
    <div class="col-6 col-md-3">
        <a class="d-flex flex-column align-items-center link-secondary text-decoration-none" href="">
            <img class="img-fluid" src="{{ asset('images/turma_ico.png') }}">
            <span class="fs-5 fw-bold">Turmas</span>
        </a>
    </div>
    <div class="col-6 col-md-3">
        <a class="d-flex flex-column align-items-center link-secondary text-decoration-none" href="">
            <img class="img-fluid" src="{{ asset('images/disciplina_ico.png') }}">
            <span class="fs-5 fw-bold">Disciplinas</span>
        </a>
    </div>
</div>
@endsection
