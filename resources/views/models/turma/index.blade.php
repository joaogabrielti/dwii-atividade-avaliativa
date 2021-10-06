@extends('layouts.app', ['pageIcon' => 'images/turma_ico.png', 'pageTitle' => 'Turmas'])

@section('content')
<button class="btn btn-primary w-100 mb-2" onclick="create()">Cadastrar Nova Turma</button>
<x-data-table :head="['id', 'nome', 'ano', 'abreviatura', ['name' => 'curso', 'attr' => 'curso.abreviatura']]" :array="$turmas" :model="'turma'" />
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
                    <label class="form-label mb-0" for="ano">Ano</label>
                    <input class="form-control" type="text" name="ano" id="ano">
                </div>
                <div class="mb-1">
                    <label class="form-label mb-0" for="abreviatura">Abreviatura</label>
                    <input class="form-control" type="text" name="abreviatura" id="abreviatura">
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
    const turmas = JSON.parse('{!! json_encode($turmas) !!}');

    $.ajaxSetup({
        'X-CSRF-TOKEN': "{{ csrf_token() }}",
    });

    function create() {
        $('#createModal').modal().find('.modal-title').text("Nova Turma");
        $("#id").val('');
        $("#nome").val('');
        $("#ano").val('');
        $("#abreviatura").val('');
        $("#curso_id").val('');
        $('#createModal').modal('show');
    }

    function save(event) {
        event.preventDefault();
        const turma = {
            id: $('#id').val(),
            nome: $('#nome').val(),
            ano: $('#ano').val(),
            abreviatura: $('#abreviatura').val(),
            curso_id: $('#curso_id').val(),
        }
        if (turma.id == '') {
            $.post("/api/turma", turma, function (data) {
                row = getTableRow(data);
                $('#datatable>tbody').append(row);
            });
        } else {
            $.ajax({
                type: 'PUT',
                url: '/api/turma/' + turma.id,
                context: this,
                data: turma,
                success: function (data) {
                    rows = $("#datatable>tbody>tr");
                    e = rows.filter(function(i, e) {
                        return e.cells[0].textContent == data.id;
                    });
                    if (e) {
                        e[0].cells[1].textContent = data.nome;
                        e[0].cells[2].textContent = data.ano;
                        e[0].cells[3].textContent = data.abreviatura;
                        e[0].cells[4].textContent = data.curso.abreviatura;
                    }
                }
            });
        }
        $('#createModal').modal('hide');
    }

    function show(id) {
        $('#showModal').modal().find('.modal-body').html('');
        $.getJSON('/api/turma/' + id, function (turma) {
            $('#showModal').modal().find('.modal-title').text(turma.nome);
            $('#showModal').modal().find('.modal-body').append(`<strong>ID: </strong>${turma.id}<br>`);
            $('#showModal').modal().find('.modal-body').append(`<strong>ANO: </strong>${turma.ano}<br>`);
            $('#showModal').modal().find('.modal-body').append(`<strong>ABREVIATURA: </strong>${turma.abreviatura}<br>`);
            $('#showModal').modal().find('.modal-body').append(`<strong>CURSO: </strong>${turma.curso.abreviatura}<br>`);
            $('#showModal').modal('show')
        });
    }

    function edit(id) {
        $('#createModal').modal().find('.modal-title').text("Editar Turma");
        $.getJSON('/api/turma/' + id, function (turma) {
            $("#id").val(turma.id);
            $("#nome").val(turma.nome);
            $("#ano").val(turma.ano);
            $("#abreviatura").val(turma.abreviatura);
            $("#curso_id").val(turma.curso_id);
            $('#createModal').modal('show');
        });
    }

    function getTableRow(turma) {
        return '<tr>' +
            `<td class="text-center">${turma.id}</td>` +
            `<td class="text-center">${turma.nome}</td>` +
            `<td class="text-center">${turma.ano}</td>` +
            `<td class="text-center">${turma.abreviatura}</td>` +
            `<td class="text-center">${turma.curso.abreviatura}</td>` +
            '<td class="text-center">' +
            `<a nohref class="link-secondary mx-1" onclick="show(${turma.id})"><i class="bi bi-info-circle-fill"></i></a>` +
            `<a nohref class="link-secondary mx-1" onclick="edit(${turma.id})"><i class="bi bi-pencil-fill"></i></a>` +
            '</td>' +
            '</tr>';
    }
</script>
@endsection
