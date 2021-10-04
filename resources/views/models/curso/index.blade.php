@extends('layouts.app', ['pageIcon' => 'images/curso_ico.png', 'pageTitle' => 'Cursos'])

@section('content')
<button class="btn btn-primary w-100 mb-2" onclick="create()">Cadastrar Novo Curso</button>
<x-data-table :head="['id', 'nome', 'abreviatura', 'tempo']" :array="$cursos" :model="'curso'" />
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
                    <label class="form-label mb-0" for="abreviatura">Abreviatura</label>
                    <input class="form-control" type="text" name="abreviatura" id="abreviatura">
                </div>
                <div class="mb-1">
                    <label class="form-label mb-0" for="tempo">Tempo (Anos)</label>
                    <input class="form-control" type="text" name="tempo" id="tempo">
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
    const cursos = JSON.parse('{!! json_encode($cursos) !!}');

    $.ajaxSetup({
        'X-CSRF-TOKEN': "{{ csrf_token() }}",
    });

    function create() {
        $('#createModal').modal().find('.modal-title').text("Novo Curso");
        $("#id").val('');
        $("#nome").val('');
        $("#abreviatura").val('');
        $("#tempo").val('');
        $('#createModal').modal('show');
    }

    function save(event) {
        event.preventDefault();
        const curso = {
            id: $('#id').val(),
            nome: $('#nome').val(),
            abreviatura: $('#abreviatura').val(),
            tempo: $('#tempo').val(),
        }
        if (curso.id == '') {
            $.post("/api/curso", curso, function (data) {
                row = getTableRow(data);
                $('#datatable>tbody').append(row);
            });
        } else {
            $.ajax({
                type: 'PUT',
                url: '/api/curso/' + curso.id,
                context: this,
                data: curso,
                success: function (data) {
                    rows = $("#datatable>tbody>tr");
                    e = rows.filter(function(i, e) {
                        return e.cells[0].textContent == curso.id;
                    });
                    if (e) {
                        e[0].cells[1].textContent = curso.nome;
                        e[0].cells[2].textContent = curso.abreviatura;
                        e[0].cells[3].textContent = curso.tempo;
                    }
                }
            });
        }
        $('#createModal').modal('hide');
    }

    function show(id) {
        $('#showModal').modal().find('.modal-body').html('');
        $.getJSON('/api/curso/' + id, function (curso) {
            $('#showModal').modal().find('.modal-title').text(curso.nome);
            $('#showModal').modal().find('.modal-body').append(`<strong>ID: </strong>${curso.id}<br>`);
            $('#showModal').modal().find('.modal-body').append(`<strong>ABREVIATURA: </strong>${curso.abreviatura}<br>`);
            $('#showModal').modal().find('.modal-body').append(`<strong>TEMPO: </strong>${curso.tempo} ano(s)<br>`);
            $('#showModal').modal('show')
        });
    }

    function edit(id) {
        $('#createModal').modal().find('.modal-title').text("Editar Curso");
        $.getJSON('/api/curso/' + id, function (curso) {
            $("#id").val(curso.id);
            $("#nome").val(curso.nome);
            $("#abreviatura").val(curso.abreviatura);
            $("#tempo").val(curso.tempo);
            $('#createModal').modal('show');
        });
    }

    function getTableRow(curso) {
        return '<tr>' +
            `<td class="text-center">${curso.id}</td>` +
            `<td class="text-center">${curso.nome}</td>` +
            `<td class="text-center">${curso.abreviatura}</td>` +
            `<td class="text-center">${curso.tempo}</td>` +
            '<td class="text-center">' +
            `<a nohref class="link-secondary mx-1" onclick="show(${curso.id})"><i class="bi bi-info-circle-fill"></i></a>` +
            `<a nohref class="link-secondary mx-1" onclick="edit(${curso.id})"><i class="bi bi-pencil-fill"></i></a>` +
            '</td>' +
            '</tr>';
    }
</script>
@endsection
