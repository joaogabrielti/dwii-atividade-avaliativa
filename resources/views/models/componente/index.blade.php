@extends('layouts.app', ['pageIcon' => 'images/componente_ico.png', 'pageTitle' => 'Componentes'])

@section('content')
<button class="btn btn-primary w-100 mb-2" onclick="create()">Cadastrar Novo Componente Curricular</button>
<x-data-table :head="['id', 'nome', ['name' => 'Aulas Semanais', 'attr' => 'aulas'], ['name' => 'curso', 'attr' => 'curso.abreviatura']]" :array="$componentes" :model="'componente'" />
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" id="id">
                <div class="mb-1">
                    <label class="form-label mb-0" for="nome">Nome</label>
                    <input class="form-control" type="text" name="nome" id="nome">
                </div>
                <div class="mb-1">
                    <label class="form-label mb-0" for="aulas">Carga Horária / N° Aulas - Semanal</label>
                    <input class="form-control" type="text" name="aulas" id="aulas">
                </div>
                <div class="mb-1">
                    <label class="form-label mb-0" for="curso_id">Curso</label>
                    <select class="form-select" name="curso_id" id="curso_id">
                        @foreach (App\Models\Curso::all() as $curso)
                        <option value="{{ $curso->id }}">{{ $curso->nome }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="save(event)">Salvar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="showModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
@endsection


@section('scripts')
<script type="text/javascript">
    const componentes = JSON.parse('{!! json_encode($componentes) !!}');

    $.ajaxSetup({
        'X-CSRF-TOKEN': "{{ csrf_token() }}",
    });

    function create() {
        $('#createModal').modal().find('.modal-title').text("Novo Componente Curricular");
        $("#id").val('');
        $("#nome").val('');
        $("#aulas").val('');
        $("#curso_id").val('');
        $('#createModal').modal('show');
    }

    function save(event) {
        event.preventDefault();
        const componente = {
            id: $('#id').val(),
            nome: $('#nome').val(),
            aulas: $('#aulas').val(),
            curso_id: $('#curso_id').val(),
        }
        if (componente.id == '') {
            $.post("/api/componente", componente, function (data) {
                row = getTableRow(data);
                $('#datatable>tbody').append(row);
            });
        } else {
            $.ajax({
                type: 'PUT',
                url: '/api/componente/' + componente.id,
                context: this,
                data: componente,
                success: function (data) {
                    rows = $("#datatable>tbody>tr");
                    e = rows.filter(function(i, e) {
                        return e.cells[0].textContent == data.id;
                    });
                    if (e) {
                        e[0].cells[1].textContent = data.nome;
                        e[0].cells[2].textContent = data.aulas;
                        e[0].cells[3].textContent = data.curso.abreviatura;
                    }
                }
            });
        }
        $('#createModal').modal('hide');
    }

    function show(id) {
        $('#showModal').modal().find('.modal-body').html('');
        $.getJSON('/api/componente/' + id, function (componente) {
            $('#showModal').modal().find('.modal-title').text(componente.nome);
            $('#showModal').modal().find('.modal-body').append(`<strong>ID: </strong>${componente.id}<br>`);
            $('#showModal').modal().find('.modal-body').append(`<strong>CARGA HORÁRIA: </strong>${componente.aulas} aulas semanais<br>`);
            $('#showModal').modal().find('.modal-body').append(`<strong>CURSO: </strong>${componente.curso.abreviatura}<br>`);
            $('#showModal').modal('show')
        });
    }

    function edit(id) {
        $('#createModal').modal().find('.modal-title').text("Editar componente");
        $.getJSON('/api/componente/' + id, function (componente) {
            $("#id").val(componente.id);
            $("#nome").val(componente.nome);
            $("#aulas").val(componente.aulas);
            $("#curso_id").val(componente.curso_id);
            $('#createModal').modal('show');
        });
    }

    function getTableRow(componente) {
        return '<tr>' +
            `<td class="text-center">${componente.id}</td>` +
            `<td class="text-center">${componente.nome}</td>` +
            `<td class="text-center">${componente.aulas}</td>` +
            `<td class="text-center">${componente.curso.abreviatura}</td>` +
            '<td class="text-center">' +
            `<a nohref class="link-secondary mx-1" onclick="show(${componente.id})"><i class="bi bi-info-circle-fill"></i></a>` +
            `<a nohref class="link-secondary mx-1" onclick="edit(${componente.id})"><i class="bi bi-pencil-fill"></i></a>` +
            '</td>' +
            '</tr>';
    }
</script>
@endsection
