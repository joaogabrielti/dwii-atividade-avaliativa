@extends('layouts.app', ['pageIcon' => 'images/disciplina_ico.png', 'pageTitle' => 'Disciplinas'])

@section('content')
<button class="btn btn-primary w-100 mb-2" onclick="create()">Cadastrar Nova Disciplina</button>
<x-data-table :head="['id', 'nome', 'bimestres', ['name' => 'componente', 'attr' => 'componente.nome'], ['name' => 'turma', 'attr' => 'turma.abreviatura']]" :array="$disciplinas" :model="'disciplina'" />
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
                    <label class="form-label mb-0" for="bimestres">Número de Bimestres</label>
                    <input class="form-control" type="text" name="bimestres" id="bimestres">
                </div>
                <div class="mb-1">
                    <label class="form-label mb-0" for="componente_id">Componente Curricular</label>
                    <select class="form-select" name="componente_id" id="componente_id">
                        @foreach (App\Models\Componente::all() as $componente)
                        <option value="{{ $componente->id }}">{{ $componente->nome }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-1">
                    <label class="form-label mb-0" for="turma_id">Turma</label>
                    <select class="form-select" name="turma_id" id="turma_id">
                        @foreach (App\Models\Turma::all() as $turma)
                        <option value="{{ $turma->id }}">{{ $turma->nome }}</option>
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
<div class="modal fade" id="pesosModal" tabindex="-1" aria-labelledby="pesosModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pesosModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" id="id">
                <div class="mb-1">
                    <label class="form-label mb-0" for="peso_trab">Trabalho</label>
                    <input class="form-control" type="text" name="peso_trab" id="peso_trab">
                </div>
                <div class="mb-1">
                    <label class="form-label mb-0" for="peso_ava">Avaliação</label>
                    <input class="form-control" type="text" name="peso_ava" id="peso_ava">
                </div>
                <div class="mb-1">
                    <label class="form-label mb-0" for="peso_1b">1º Bimestre</label>
                    <input class="form-control" type="text" name="peso_1b" id="peso_1b">
                </div>
                <div class="mb-1">
                    <label class="form-label mb-0" for="peso_2b">2º Bimestre</label>
                    <input class="form-control" type="text" name="peso_2b" id="peso_2b">
                </div>
                <div class="mb-1">
                    <label class="form-label mb-0" for="peso_3b">3º Bimestre</label>
                    <input class="form-control" type="text" name="peso_3b" id="peso_3b">
                </div>
                <div class="mb-1">
                    <label class="form-label mb-0" for="peso_4b">4º Bimestre</label>
                    <input class="form-control" type="text" name="peso_4b" id="peso_4b">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="savePesos(event)">Salvar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="conceitosModal" tabindex="-1" aria-labelledby="conceitosModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="conceitosModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" id="id">
                <div class="mb-1">
                    <label class="form-label mb-0" for="conc_a">A</label>
                    <input class="form-control" type="text" name="conc_a" id="conc_a">
                </div>
                <div class="mb-1">
                    <label class="form-label mb-0" for="conc_b">B</label>
                    <input class="form-control" type="text" name="conc_b" id="conc_b">
                </div>
                <div class="mb-1">
                    <label class="form-label mb-0" for="conc_c">C</label>
                    <input class="form-control" type="text" name="conc_c" id="conc_c">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="saveConceitos(event)">Salvar</button>
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
    const disciplinas = JSON.parse('{!! json_encode($disciplinas) !!}');

    $.ajaxSetup({
        'X-CSRF-TOKEN': "{{ csrf_token() }}",
    });

    function create() {
        $('#createModal').modal().find('.modal-title').text("Nova Disciplina");
        $("#id").val('');
        $("#nome").val('');
        $("#bimestres").val('');
        $("#componente_id").val('');
        $("#turma_id").val('');
        $('#createModal').modal('show');
    }

    function save(event) {
        event.preventDefault();
        const disciplina = {
            id: $('#id').val(),
            nome: $('#nome').val(),
            bimestres: $('#bimestres').val(),
            componente_id: $('#componente_id').val(),
            turma_id: $('#turma_id').val(),
        }
        if (disciplina.id == '') {
            $.post("/api/disciplina", disciplina, function (data) {
                row = getTableRow(data);
                $('#datatable>tbody').append(row);
            });
        } else {
            $.ajax({
                type: 'PUT',
                url: '/api/disciplina/' + disciplina.id,
                context: this,
                data: disciplina,
                success: function (data) {
                    rows = $("#datatable>tbody>tr");
                    e = rows.filter(function(i, e) {
                        return e.cells[0].textContent == data.id;
                    });
                    if (e) {
                        e[0].cells[1].textContent = data.nome;
                        e[0].cells[2].textContent = data.bimestres;
                        e[0].cells[3].textContent = data.componente.nome;
                        e[0].cells[4].textContent = data.turma.abreviatura;
                    }
                }
            });
        }
        $('#createModal').modal('hide');
    }

    function savePesos(event) {
        event.preventDefault();
        const disciplina = {
            id: $('#id').val(),
            peso_trab: $('#peso_trab').val(),
            peso_ava: $('#peso_ava').val(),
            peso_1b: $('#peso_1b').val(),
            peso_2b: $('#peso_2b').val(),
            peso_3b: $('#peso_3b').val(),
            peso_4b: $('#peso_4b').val()
        }
        $.ajax({
            type: 'PUT',
            url: '/api/disciplina/' + disciplina.id,
            context: this,
            data: disciplina,
            success: function (data) {
                console.log('pesos editados...');
            }
        });
        $('#pesosModal').modal('hide');
    }

    function saveConceitos(event) {
        event.preventDefault();
        const disciplina = {
            id: $('#id').val(),
            conc_a: $('#conc_a').val(),
            conc_b: $('#conc_b').val(),
            conc_c: $('#conc_c').val()
        }
        $.ajax({
            type: 'PUT',
            url: '/api/disciplina/' + disciplina.id,
            context: this,
            data: disciplina,
            success: function (data) {
                console.log('conceitos editados...');
            }
        });
        $('#conceitosModal').modal('hide');
    }

    function show(id) {
        $('#showModal').modal().find('.modal-body').html('');
        $.getJSON('/api/disciplina/' + id, function (disciplina) {
            $('#showModal').modal().find('.modal-title').text(disciplina.nome);
            $('#showModal').modal().find('.modal-body').append(`<strong>ID: </strong>${disciplina.id}<br>`);
            $('#showModal').modal().find('.modal-body').append(`<strong>BIMESTRES: </strong>${disciplina.bimestres}<br>`);
            $('#showModal').modal().find('.modal-body').append(`<strong>COMPONENTE: </strong>${disciplina.componente.nome}<br>`);
            $('#showModal').modal().find('.modal-body').append(`<strong>TURMA: </strong>${disciplina.turma.abreviatura}<br>`);
            $('#showModal').modal('show')
        });
    }

    function edit(id) {
        $('#createModal').modal().find('.modal-title').text("Editar Disciplina");
        $.getJSON('/api/disciplina/' + id, function (disciplina) {
            $("#id").val(disciplina.id);
            $("#nome").val(disciplina.nome);
            $("#bimestres").val(disciplina.bimestres);
            $("#componente_id").val(disciplina.componente_id);
            $("#turma_id").val(disciplina.turma_id);
            $('#createModal').modal('show');
        });
    }

    function editPesos(id) {
        $.getJSON('/api/disciplina/' + id, function (disciplina) {
            $('#pesosModal').modal().find('.modal-title').text("Configuração de Pesos: " + disciplina.nome);
            $("#id").val(disciplina.id);
            $("#peso_trab").val(disciplina.peso_trab);
            $("#peso_ava").val(disciplina.peso_ava);
            $("#peso_1b").val(disciplina.peso_1b);
            $("#peso_2b").val(disciplina.peso_2b);
            $("#peso_3b").val(disciplina.peso_3b);
            $("#peso_4b").val(disciplina.peso_4b);
            $('#pesosModal').modal('show');
        });
    }

    function editConceitos(id) {
        $.getJSON('/api/disciplina/' + id, function (disciplina) {
            $('#pesosModal').modal().find('.modal-title').text("Configuração de Conceitos: " + disciplina.nome);
            $("#id").val(disciplina.id);
            $("#conc_a").val(disciplina.conc_a);
            $("#conc_b").val(disciplina.conc_b);
            $("#conc_c").val(disciplina.conc_c);
            $('#conceitosModal').modal('show');
        });
    }

    function getTableRow(disciplina) {
        return '<tr>' +
            `<td class="text-center">${disciplina.id}</td>` +
            `<td class="text-center">${disciplina.nome}</td>` +
            `<td class="text-center">${disciplina.bimestres}</td>` +
            `<td class="text-center">${disciplina.componente.nome}</td>` +
            `<td class="text-center">${disciplina.turma.abreviatura}</td>` +
            '<td class="text-center">' +
            `<a nohref class="link-secondary mx-1" onclick="show(${disciplina.id})"><i class="bi bi-info-circle-fill"></i></a>` +
            `<a nohref class="link-secondary mx-1" onclick="edit(${disciplina.id})"><i class="bi bi-pencil-fill"></i></a>` +
            `<a nohref class="link-secondary mx-1" onclick="editPesos(${disciplina.id})"><i class="bi bi-gear-fill"></i></a>` +
            `<a nohref class="link-secondary mx-1" onclick="editConceitos(${disciplina.id})"><i class="bi bi-bookmark-check-fill"></i></a>` +
            '</td>' +
            '</tr>';
    }
</script>
@endsection
