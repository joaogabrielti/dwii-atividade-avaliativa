@extends('layouts.app', ['pageIcon' => 'images/curso_ico.png', 'pageTitle' => 'Cursos'])

@section('content')
<a href="{{ route('curso.index') }}" class="btn btn-secondary w-100 mb-3">Voltar</a>
<h4>@isset($curso){{ 'Editar Informações do Curso' }}@else{{ 'Cadastrar Novo Curso' }}@endisset</h4>
<form action="@isset($curso){{ route('curso.update', ['curso' => $curso['id']]) }}@else{{ route('curso.store') }}@endisset" method="POST">
    @csrf
    @isset($curso)
        @method('PUT')
    @endisset
    <div class="mb-1">
        <label class="form-label mb-0" for="nome">Nome</label>
        <input class="form-control @error('nome'){{ 'is-invalid' }}@enderror" type="text" name="nome" id="nome" value="{{ $curso['nome'] ?? old('nome') }}">
        @error('nome')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-1">
        <label class="form-label mb-0" for="abreviatura">Abreviatura</label>
        <input class="form-control @error('abreviatura'){{ 'is-invalid' }}@enderror" type="text" name="abreviatura" id="abreviatura" value="{{ $curso['abreviatura'] ?? old('abreviatura') }}">
        @error('abreviatura')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-1">
        <label class="form-label mb-0" for="tempo">Tempo (em Anos)</label>
        <input class="form-control @error('tempo'){{ 'is-invalid' }}@enderror" type="text" name="tempo" id="tempo" value="{{ $curso['tempo'] ?? old('tempo') }}">
        @error('tempo')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <button class="btn btn-primary w-100 mt-2" type="submit">Salvar</button>
</form>
@endsection
