@extends('layouts.app')

@section('title', 'Lista de Usuários')
@section('page-title', 'Usuários')

@section('content')
<div class="container">
    <h2>Usuários</h2>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
                <a href="{{ route('users.edit', $user) }}" class="btn btn-primary btn-sm">Editar</a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>

    {{ $users->links() }} {{-- paginação --}}
</div>
@endsection
