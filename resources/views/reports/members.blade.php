@extends('layouts.app')

@section('title', 'Relatório de Membros')
@section('page-title', 'Relatório de Membros')

@section('content')
<div class="container">
    <h2>Membros</h2>

    {{-- Formulário de filtros --}}
    <form method="GET" action="{{ route('reports.members') }}" class="row g-3 mb-4 align-items-end">
        <div class="col-md-3">
            <label for="birth_date" class="form-label">Data de Nascimento</label>
            <input type="date" class="form-control" id="birth_date" name="birth_date" value="{{ request('birth_date') }}">
        </div>

        <div class="col-md-3">
            <label for="marital_status" class="form-label">Estado Civil</label>
            <select name="marital_status" id="marital_status" class="form-select">
                <option value="">Todos</option>
                <option value="solteiro" {{ request('marital_status') == 'solteiro' ? 'selected' : '' }}>Solteiro(a)</option>
                <option value="casado" {{ request('marital_status') == 'casado' ? 'selected' : '' }}>Casado(a)</option>
                <option value="divorciado" {{ request('marital_status') == 'divorciado' ? 'selected' : '' }}>Divorciado(a)</option>
                <option value="viuvo" {{ request('marital_status') == 'viuvo' ? 'selected' : '' }}>Viúvo(a)</option>
            </select>
        </div>

        <div class="col-md-3">
            <label for="type" class="form-label">Tipo de Doação</label>
            <select id="type" name="type" class="form-select">
                <option value="">Todos</option>
                <option value="dizimo" {{ request('type') == 'dizimo' ? 'selected' : '' }}>Dízimo</option>
                <option value="doacao" {{ request('type') == 'doacao' ? 'selected' : '' }}>Doação</option>
                <option value="colecta" {{ request('type') == 'colecta' ? 'selected' : '' }}>Coleta</option>
                <option value="colecta_missoes" {{ request('type') == 'colecta_missoes' ? 'selected' : '' }}>Coleta Missões</option>
                <option value="accao_social" {{ request('type') == 'accao_social' ? 'selected' : '' }}>Ação Social</option>
                <option value="agradecimentos" {{ request('type') == 'agradecimentos' ? 'selected' : '' }}>Agradecimentos</option>
                <option value="jovens" {{ request('type') == 'jovens' ? 'selected' : '' }}>Jovens</option>
                <option value="celula_central" {{ request('type') == 'celula_central' ? 'selected' : '' }}>Célula Central</option>
                <option value="celula_2" {{ request('type') == 'celula_2' ? 'selected' : '' }}>Célula 2</option>
                <option value="celula_3" {{ request('type') == 'celula_3' ? 'selected' : '' }}>Célula 3</option>
                <option value="celula_4" {{ request('type') == 'celula_4' ? 'selected' : '' }}>Célula 4</option>
                <option value="celula_5" {{ request('type') == 'celula_5' ? 'selected' : '' }}>Célula 5</option>
                <option value="celula_6" {{ request('type') == 'celula_6' ? 'selected' : '' }}>Célula 6</option>
                <option value="celula_7" {{ request('type') == 'celula_7' ? 'selected' : '' }}>Célula 7</option>
                <option value="celula_8" {{ request('type') == 'celula_8' ? 'selected' : '' }}>Célula 8</option>
                <option value="dizimos_dos_dizimos" {{ request('type') == 'dizimos_dos_dizimos' ? 'selected' : '' }}>Dízimos dos Dízimos</option>
                <option value="xicotelas" {{ request('type') == 'xicotelas' ? 'selected' : '' }}>Xicotelas</option>
            </select>
        </div>


        <div class="col-md-3 d-flex gap-2">
            <button type="submit" class="btn btn-primary">Filtrar</button>
            <a href="{{ route('reports.members') }}" class="btn btn-secondary">Limpar</a>
        </div>
    </form>

    {{-- Botões para exportar --}}
    <div class="mb-3">
<!--        <a href="{{ route('reports.members.export', array_merge(request()->all(), ['format' => 'excel'])) }}" class="btn btn-success me-2">-->
<!--            <i class="fas fa-file-excel"></i> Exportar Excel-->
<!--        </a>-->
        <a href="{{ route('reports.members.export', array_merge(request()->all(), ['format' => 'pdf'])) }}" class="btn btn-danger">
            <i class="fas fa-file-pdf"></i> Exportar PDF
        </a>
    </div>

    {{-- Tabela dos membros --}}
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>Nome Completo</th>
            <th>Data de Nascimento</th>
            <th>Gênero</th>
            <th>Estado Civil</th>
            <th>Esposa</th>
            <th>Filhos</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        @forelse($members as $member)
        <tr>
            <td>{{ $member->first_name }} {{ $member->last_name }}</td>
            <td>{{ \Carbon\Carbon::parse($member->date_of_birth)->format('d/m/Y') }}</td>
            <td>{{ ucfirst($member->gender) }}</td>
            <td>{{ ucfirst($member->marital_status) }}</td>
            <td>
                @if($member->spouse)
                {{ $member->spouse->first_name }} {{ $member->spouse->last_name }}
                @else
                -
                @endif
            </td>
            <td>
                @if($member->children && $member->children->count() > 0)
                <ul class="mb-0">
                    @foreach($member->children as $child)
                    <li>{{ $child->first_name }} {{ $child->last_name }} ({{ ucfirst($child->gender) }})</li>
                    @endforeach
                </ul>
                @else
                -
                @endif
            </td>
            <td>
                <a href="{{ route('members.show', $member) }}" class="btn btn-sm btn-info">Ver</a>
                <a href="{{ route('members.edit', $member) }}" class="btn btn-sm btn-warning">Editar</a>
                <form action="{{ route('members.destroy', $member) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Tem certeza que deseja remover este membro?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" type="submit">Excluir</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7" class="text-center">Nenhum membro encontrado.</td>
        </tr>
        @endforelse
        </tbody>
    </table>

    {{ $members->appends(request()->query())->links() }}
</div>
@endsection
