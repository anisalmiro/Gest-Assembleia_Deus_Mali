@extends('layouts.app')

@section('title', 'Editar Membro')
@section('page-title', 'Editar Membro')

@section('page-actions')
<a href="{{ route('members.index') }}" class="btn btn-secondary">
    <i class="fas fa-arrow-left me-1"></i> Voltar
</a>
@endsection

@section('content')

    <form action="{{ route('members.update', $member) }}" method="POST" enctype="multipart/form-data">

    @csrf
    @method('PUT')

    <!-- Bloco de Informações Pessoais (mesma estrutura) -->
    <!-- Abaixo estão exemplos de como alterar o preenchimento dos campos -->

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-user me-2"></i> Informações Pessoais
            </h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="first_name" class="form-label">Primeiro Nome *</label>
                    <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                           id="first_name" name="first_name"
                           value="{{ old('first_name', $member->first_name) }}" required>
                    @error('first_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="last_name" class="form-label">Apelido *</label>
                    <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                           id="last_name" name="last_name"
                           value="{{ old('last_name', $member->last_name) }}" required>
                    @error('last_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="date_of_birth" class="form-label">Data de Nascimento *</label>
                    <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror"
                           id="date_of_birth" name="date_of_birth"
                           value="{{ old('date_of_birth', \Carbon\Carbon::parse($member->date_of_birth)->format('Y-m-d')) }}" required>
                    @error('date_of_birth')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label for="gender" class="form-label">Gênero *</label>
                    <select class="form-select @error('gender') is-invalid @enderror"
                            id="gender" name="gender" required>
                        <option value="">Selecione...</option>
                        <option value="male" {{ old('gender', $member->gender) === 'male' ? 'selected' : '' }}>Masculino</option>
                        <option value="female" {{ old('gender', $member->gender) === 'female' ? 'selected' : '' }}>Feminino</option>
                        <option value="other" {{ old('gender', $member->gender) === 'other' ? 'selected' : '' }}>Outro</option>
                    </select>
                    @error('gender')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label for="marital_status" class="form-label">Estado Civil *</label>

                    <select id="marital_status" name="marital_status" class="form-select" onchange="toggleMarriageFields()">
                        <option value="">Selecione...</option>
                        <option value="solteiro" {{ old('marital_status') === 'solteiro' ? 'selected' : '' }}>Solteiro(a)</option>
                        <option value="casado" {{ old('marital_status') === 'casado' ? 'selected' : '' }}>Casado(a)</option>
                        <option value="divorciado" {{ old('marital_status') === 'divorciado' ? 'selected' : '' }}>Divorciado(a)</option>
                        <option value="viuvo" {{ old('marital_status') === 'viuvo' ? 'selected' : '' }}>Viúvo(a)</option>
                    </select>
                    @error('marital_status')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="phone_number" class="form-label">Telefone *</label>
                    <input type="tel" class="form-control @error('phone_number') is-invalid @enderror"
                           id="phone_number" name="phone_number"
                           value="{{ old('phone_number', $member->phone_number) }}" required>
                    @error('phone_number')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">Email *</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                           id="email" name="email"
                           value="{{ old('email', $member->email) }}" required>
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-8 mb-3">
                    <label for="address" class="form-label">Endereço *</label>
                    <textarea class="form-control @error('address') is-invalid @enderror"
                              id="address" name="address" rows="2" required>{{ old('address', $member->address) }}</textarea>
                    @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="date_joined" class="form-label">Data de Ingresso *</label>
                    <input type="date" class="form-control @error('date_joined') is-invalid @enderror"
                           id="date_joined" name="date_joined"
                           value="{{ old('date_joined', \Carbon\Carbon::parse($member->date_joined)->format('Y-m-d')) }}" required>
                    @error('date_joined')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="notes" class="form-label">Observações</label>
                <textarea class="form-control @error('notes') is-invalid @enderror"
                          id="notes" name="notes" rows="3">{{ old('notes', $member->notes) }}</textarea>
                @error('notes')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-church me-2"></i> Informações Complementares
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="profition" class="form-label">Profissão</label>
                        <input type="text" class="form-control" id="profition" name="profition"
                               value="{{ old('profition', $member->profition) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="province_bith" class="form-label">Província de Nascimento</label>
                        <input type="text" class="form-control" id="province_bith" name="province_bith"
                               value="{{ old('province_bith', $member->province_bith) }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="neighborhood" class="form-label">Bairro</label>
                        <input type="text" class="form-control" id="neighborhood" name="neighborhood"
                               value="{{ old('neighborhood', $member->neighborhood) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="date_marriag" class="form-label">Data do Casamento</label>
                        <input type="date" class="form-control" id="date_marriag" name="date_marriag"
                               value="{{ old('date_marriag', $member->date_marriag) }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="baptized" class="form-label">Batizado?</label>
                        <select class="form-select" id="baptized" name="baptized">
                            <option value="">Selecione...</option>
                            <option value="y" {{ old('baptized', $member->baptized) == 'y' ? 'selected' : '' }}>Sim</option>
                            <option value="n" {{ old('baptized', $member->baptized) == 'n' ? 'selected' : '' }}>Não</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="marriag_church" class="form-label">Casado na Igreja?</label>
                        <select class="form-select" id="marriag_church" name="marriag_church">
                            <option value="">Selecione...</option>
                            <option value="y" {{ old('marriag_church', $member->marriag_church) == 'y' ? 'selected' : '' }}>Sim</option>
                            <option value="n" {{ old('marriag_church', $member->marriag_church) == 'n' ? 'selected' : '' }}>Não</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="church_name_marriag" class="form-label">Nome da Igreja do Casamento</label>
                        <input type="text" class="form-control" id="church_name_marriag" name="church_name_marriag"
                               value="{{ old('church_name_marriag', $member->church_name_marriag) }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="date_baptism" class="form-label">Data do Batismo</label>
                        <input type="date" class="form-control" id="date_baptism" name="date_baptism"
                               value="{{ old('date_baptism', $member->date_baptism) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="batizad_from_marriag" class="form-label">Batizado depois do Casamento?</label>
                        <select class="form-select" id="batizad_from_marriag" name="batizad_from_marriag" required>
                            <option value="">Selecione...</option>
                            <option value="y" {{ old('batizad_from_marriag', $member->batizad_from_marriag) == 'y' ? 'selected' : '' }}>Sim</option>
                            <option value="n" {{ old('batizad_from_marriag', $member->batizad_from_marriag) == 'n' ? 'selected' : '' }}>Não</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="has_position_church" class="form-label">Tem Cargo na Igreja?</label>
                        <select class="form-select" id="has_position_church" name="has_position_church" required>
                            <option value="">Selecione...</option>
                            <option value="y" {{ old('has_position_church', $member->has_position_church) == 'y' ? 'selected' : '' }}>Sim</option>
                            <option value="n" {{ old('has_position_church', $member->has_position_church) == 'n' ? 'selected' : '' }}>Não</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="position" class="form-label">Cargo</label>
                        <input type="text" class="form-control" id="position" name="position"
                               value="{{ old('position', $member->position) }}">
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-camera me-2"></i> Foto do Membro
                </h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="photo" class="form-label">Upload da Foto</label>
                    <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" name="photo" accept="image/*">
                    @error('photo')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                @if($member->photo)
                <div class="mb-3">
                    <label>Foto Atual:</label><br>
                    <img src="{{ asset('storage/members_photos/' . $member->photo) }}" alt="Foto de {{ $member->first_name }}"
                         class="img-thumbnail" style="max-width: 200px;">
                </div>
                @endif
            </div>
        </div>

        <!-- Resto das seções: esposa, filhos, etc. -->
    <!-- Reaproveite o mesmo código de criação, mas use os valores de $member->spouse e $member->children, se desejado -->

    <!-- Botões -->
    <div class="d-flex justify-content-end gap-2">
        <a href="{{ route('members.index') }}" class="btn btn-secondary">
            <i class="fas fa-times me-1"></i> Cancelar
        </a>
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save me-1"></i> Atualizar Membro
        </button>
    </div>
</form>
@endsection

@section('scripts')
<script>

@endsection
