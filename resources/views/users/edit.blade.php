@extends('layouts.app')

@section('title', 'Editar Usuário')
@section('page-title', 'Editar Usuário')

@section('content')
<div class="container">
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        </div>

        <!-- Campos para alteração de senha -->
        <div class="mb-3">
            <label for="password" class="form-label">Nova Senha</label>
            <input type="password" name="password" id="password" class="form-control" autocomplete="new-password" placeholder="Deixe em branco para não alterar">
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmar Nova Senha</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" autocomplete="new-password" placeholder="Repita a nova senha">
        </div>

        <button type="submit" class="btn btn-primary">Atualizar</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
