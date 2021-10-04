@extends('layouts.app', ['pageIcon' => 'images/curso_ico.png', 'pageTitle' => 'Cursos'])

@section('content')
<a href="{{ route('curso.index') }}" class="btn btn-secondary w-100 mb-3">Voltar</a>
<h4>{{ $curso->nome }}</h4>
<p class="mb-0"><strong>ID:</strong> {{ $curso->id }}</p>
<p class="mb-0"><strong>ABREVIATURA:</strong> {{ $curso->abreviatura }}</p>
<p class="mb-0"><strong>TEMPO:</strong> {{ $curso->tempo }} ano(s)</p>
@endsection
