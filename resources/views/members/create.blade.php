@extends('layouts.app')

@section('title', 'Novo Membro')
@section('page-title', 'Registar Novo Membro')

@section('page-actions')
<a href="{{ route('members.index') }}" class="btn btn-secondary">
    <i class="fas fa-arrow-left me-1"></i>
    Voltar
</a>
@endsection

@section('content')

<form action="{{ route('members.store') }}" method="POST" enctype="multipart/form-data">

    @csrf

    <!-- Informações Pessoais -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-user me-2"></i>
                Informações Pessoais
            </h6>
        </div>
        <div class="card-body">
            <div class="row">

                <div class="col-md-6 mb-3">
                    <label for="first_name" class="form-label">Primeiro Nome *</label>
                    <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                           id="first_name" name="first_name" value="{{ old('first_name') }}" required>
                    @error('first_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="last_name" class="form-label">Apelido *</label>
                    <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                           id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                    @error('last_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="date_of_birth" class="form-label">Data de Nascimento *</label>
                    <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror"
                           id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}" required>
                    @error('date_of_birth')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="gender" class="form-label">Gênero *</label>
                    <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender" required>
                        <option value="">Selecione...</option>
                        <option value="maculino" {{ old('gender') === 'maculino' ? 'selected' : '' }}>Masculino</option>
                        <option value="feminino" {{ old('gender') === 'feminino' ? 'selected' : '' }}>Feminino</option>
                        <option value="outro" {{ old('gender') === 'outro' ? 'selected' : '' }}>Outro</option>
                    </select>
                    @error('gender')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="profition" class="form-label">Profissão</label>
                    <input type="text" class="form-control" id="profition" name="profition" value="{{ old('profition') }}">
                    @error('profition')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="province_bith" class="form-label">Província de Nascimento</label>
                    <input type="text" class="form-control" id="province_bith" name="province_bith" value="{{ old('province_bith') }}">
                    @error('province_bith')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="neighborhood" class="form-label">Local de Residencia</label>
                    <input type="text" class="form-control" id="neighborhood" name="neighborhood" value="{{ old('neighborhood') }}">
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="marital_status" class="form-label">Estado Civil *</label>

                    <select id="marital_status" name="marital_status" class="form-select" onchange="toggleMarriageFields()">
                        <option value="">Selecione...</option>
                        <option value="solteiro" {{ old('marital_status') === 'solteiro' ? 'selected' : '' }}>Solteiro(a)</option>
                        <option value="casado" {{ old('marital_status') === 'casado' ? 'selected' : '' }}>Casado(a)</option>
                        <option value="uniao_factos" {{ old('marital_status') === 'uniao_factos' ? 'selected' : '' }}>União de Factos(a)</option>
                        <option value="divorciado" {{ old('marital_status') === 'divorciado' ? 'selected' : '' }}>Divorciado(a)</option>
                        <option value="viuvo" {{ old('marital_status') === 'viuvo' ? 'selected' : '' }}>Viúvo(a)</option>
                    </select>
                    @error('marital_status')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3" id="date_marriag_group" style="display: none;">
                    <label for="date_marriag" class="form-label">Data do Casamento</label>
                    <input type="date" class="form-control" id="date_marriag" name="date_marriag" value="{{ old('date_marriag') }}">
                </div>

                <div class="col-md-4 mb-3">
                    <label for="date_joined" class="form-label">Data de Ingresso na igreja*</label>
                    <input type="date" class="form-control @error('date_joined') is-invalid @enderror"
                           id="date_joined" name="date_joined" value="{{ old('date_joined', date('Y-m-d')) }}" required>
                    @error('date_joined')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label for="baptized" class="form-label">Batizado?</label>
                    <select class="form-select" name="baptized" id="baptized" onchange="toggleBaptismDate(this.value)">
                        <option value="">Selecione...</option>
                        <option value="y" {{ old('baptized') == 'y' ? 'selected' : '' }}>Sim</option>
                        <option value="n" {{ old('baptized') == 'n' ? 'selected' : '' }}>Não</option>
                    </select>
                </div>

                <div class="col-md-4 mb-3" id="baptism_group" style="display: none;">
                    <div class="col-md-4 mb-3">
                        <label for="date_baptism" class="form-label">Data do Batismo</label>
                        <input type="date" class="form-control" id="date_baptism" name="date_baptism" value="{{ old('date_baptism') }}">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="batizad_from_marriag" class="form-label">Batizado após o casamento?</label>
                        <select class="form-select" name="batizad_from_marriag" id="batizad_from_marriag">
                            <option value="">Selecione...</option>
                            <option value="y" {{ old('batizad_from_marriag') == 'y' ? 'selected' : '' }}>Sim</option>
                            <option value="n" {{ old('batizad_from_marriag') == 'n' ? 'selected' : '' }}>Não</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="marriag_church" class="form-label">Casado na Igreja?</label>
                    <select class="form-select" name="marriag_church" id="marriag_church" onchange="toggleChurchNameField()">
                        <option value="">Selecione...</option>
                        <option value="y" {{ old('marriag_church') == 'y' ? 'selected' : '' }}>Sim</option>
                        <option value="n" {{ old('marriag_church') == 'n' ? 'selected' : '' }}>Não</option>
                    </select>
                </div>

                <div class="col-md-4 mb-3" id="church_name_marriag_group" style="display: none;">
                    <label for="church_name_marriag" class="form-label">Nome da Igreja do Casamento</label>
                    <input type="text" class="form-control" id="church_name_marriag" name="church_name_marriag" value="{{ old('church_name_marriag') }}">
                </div>
            </div>


            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="has_position_church" class="form-label">Possui Cargo na Igreja?</label>
                    <select class="form-select" name="has_position_church" id="has_position_church" onchange="togglePositionGroup()">
                        <option value="">Selecione...</option>
                        <option value="y" {{ old('has_position_church') == 'y' ? 'selected' : '' }}>Sim</option>
                        <option value="n" {{ old('has_position_church') == 'n' ? 'selected' : '' }}>Não</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3" id="position_group" style="display: none;">
                    <label for="position" class="form-label">Cargo na Igreja</label>

                    <select class="form-select" id="position_select" onchange="togglePositionInput(this.value)">
                        <option value="">Selecione...</option>
                        <option value="Operador" {{ old('position') == 'Operador' ? 'selected' : '' }}>Operador</option>
                        <option value="Diácono" {{ old('position') == 'Diácono' ? 'selected' : '' }}>Diácono</option>
                        <option value="Evangelista" {{ old('position') == 'Evangelista' ? 'selected' : '' }}>Evangelista</option>
                        <option value="Presbítero" {{ old('position') == 'Presbítero' ? 'selected' : '' }}>Presbítero</option>
                        <option value="Pastor" {{ old('position') == 'Pastor' ? 'selected' : '' }}>Pastor</option>
                        <option value="Outro" {{ !in_array(old('position'), ['Operador', 'Diácono', 'Evangelista', 'Presbítero', 'Pastor']) && old('position') ? 'selected' : '' }}>Outro (especificar)</option>
                    </select>

                    <input type="text"
                           class="form-control mt-2"
                           id="position_input"
                           name="position"
                           placeholder="Especifique o cargo"
                           value="{{ old('position') }}"
                           style="display: none;">
                </div>
            </div>



            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="phone_number" class="form-label">Telefone</label>
                    <input type="tel" class="form-control @error('phone_number') is-invalid @enderror"
                           id="phone_number" name="phone_number" value="{{ old('phone_number') }}">
                    @error('phone_number')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">Email </label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                           id="email" name="email" value="{{ old('email') }}">
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-8 mb-3">
                    <label for="address" class="form-label">Endereço</label>
                    <textarea class="form-control @error('address') is-invalid @enderror"
                              id="address" name="address" rows="2">{{ old('address') }}</textarea>
                    @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="photo" class="form-label">Foto do Membro</label>
                    <input type="file" class="form-control @error('photo') is-invalid @enderror"
                           id="photo" name="photo" accept="image/*">
                    @error('photo')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    @if(isset($member) && $member->photo)
                    <div class="mt-3">
                        <p><strong>Foto Atual:</strong></p>
                        <img src="{{ asset('storage/' . $member->photo) }}"
                             alt="Foto de {{ $member->first_name }}"
                             class="img-thumbnail" style="max-width: 200px;">
                    </div>
                    @endif
                </div>
            </div>


            <div class="mb-3">
                <label for="notes" class="form-label">Observações</label>
                <textarea class="form-control @error('notes') is-invalid @enderror"
                          id="notes" name="notes" rows="3">{{ old('notes') }}</textarea>
                @error('notes')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <!-- Informações da Esposa -->
    <div class="card shadow mb-4" id="spouse-section" style="display: none;">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-heart me-2"></i>
                Informações da Esposa
            </h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="spouse_first_name" class="form-label">Primeiro Nome</label>
                    <input type="text" class="form-control @error('spouse_first_name') is-invalid @enderror"
                           id="spouse_first_name" name="spouse_first_name" value="{{ old('spouse_first_name') }}">
                    @error('spouse_first_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="spouse_last_name" class="form-label">Apelido</label>
                    <input type="text" class="form-control @error('spouse_last_name') is-invalid @enderror"
                           id="spouse_last_name" name="spouse_last_name" value="{{ old('spouse_last_name') }}">
                    @error('spouse_last_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="spouse_date_of_birth" class="form-label">Data de Nascimento</label>
                    <input type="date" class="form-control @error('spouse_date_of_birth') is-invalid @enderror"
                           id="spouse_date_of_birth" name="spouse_date_of_birth" value="{{ old('spouse_date_of_birth') }}">
                    @error('spouse_date_of_birth')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="spouse_phone_number" class="form-label">Telefone</label>
                    <input type="tel" class="form-control @error('spouse_phone_number') is-invalid @enderror"
                           id="spouse_phone_number" name="spouse_phone_number" value="{{ old('spouse_phone_number') }}">
                    @error('spouse_phone_number')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="spouse_email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('spouse_email') is-invalid @enderror"
                           id="spouse_email" name="spouse_email" value="{{ old('spouse_email') }}">
                    @error('spouse_email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <!-- Informações dos Filhos -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-child me-2"></i>
                Informações dos Filhos
            </h6>
            <button type="button" class="btn btn-success btn-sm" onclick="addChild()">
                <i class="fas fa-plus me-1"></i>
                Adicionar Filho
            </button>
        </div>
        <div class="card-body">
            <div id="children-container">
                <p class="text-muted">Clique em "Adicionar Filho" para incluir informações dos filhos.</p>
            </div>
        </div>
    </div>

    <!-- Botões de Ação -->
    <div class="d-flex justify-content-end gap-2">
        <a href="{{ route('members.index') }}" class="btn btn-secondary">
            <i class="fas fa-times me-1"></i>
            Cancelar
        </a>
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save me-1"></i>
            Salvar Membro
        </button>
    </div>
</form>
@endsection

@section('scripts')
<script>

    function togglePositionGroup() {
        const hasPosition = document.getElementById('has_position_church').value;
        const positionGroup = document.getElementById('position_group');

        if (hasPosition === 'y') {
            positionGroup.style.display = 'block';
        } else {
            positionGroup.style.display = 'none';
            document.getElementById('position_input').style.display = 'none';
            document.getElementById('position_input').value = '';
        }
    }


    function togglePositionInput(value) {
        const input = document.getElementById('position_input');
        if (value === 'Outro') {
            input.style.display = 'block';
            input.value = '';
        } else {
            input.style.display = 'none';
            input.value = value;
        }
    }

    function toggleChurchNameField() {
        const churchStatus = document.getElementById('marriag_church').value;
        const churchNameGroup = document.getElementById('church_name_marriag_group');

        if (churchStatus === 'y') {
            churchNameGroup.style.display = 'block';
        } else {
            churchNameGroup.style.display = 'none';
            document.getElementById('church_name_marriag').value = ''; // limpa valor se ocultar
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        toggleChurchNameField(); // executa ao carregar, útil após validação com erro
    });




    function toggleBaptismDate(value) {
        const group = document.getElementById('baptism_group');

        if (value === 'y') {
            group.style.display = 'block';


        } else {
            group.style.display = 'none';
            document.getElementById('date_baptism').value = ''; // Limpa se ocultar
        }
    }

    // Ao carregar a página, verificar o valor antigo
    document.addEventListener('DOMContentLoaded', function () {
        const currentValue = "{{ old('baptized') }}";
        toggleBaptismDate(currentValue);
    });



    let childCount = 0;

    function toggleMarriageFields() {
        const maritalStatus = document.getElementById('marital_status').value;

        const marriageDateGroup = document.getElementById('date_marriag_group');
        const marriageDateInput = document.getElementById('date_marriag');
        const spouseSection = document.getElementById('spouse-section');

        if (maritalStatus === 'casado' || maritalStatus === 'uniao_factos') {
            if (marriageDateGroup) marriageDateGroup.style.display = 'block';
            if (spouseSection) spouseSection.style.display = 'block';
        } else {
            if (marriageDateGroup) marriageDateGroup.style.display = 'none';
            if (spouseSection) spouseSection.style.display = 'none';
            if (marriageDateInput) marriageDateInput.value = '';
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        toggleMarriageFields(); // Inicializa com base no valor selecionado
    });

    function addChild() {
        childCount++;
        const container = document.getElementById('children-container');

        if (childCount === 1) {
            container.innerHTML = '';
        }

        const childHtml = `
        <div class="child-item border rounded p-3 mb-3" id="child-${childCount}">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="mb-0">Filho ${childCount}</h6>
                <button type="button" class="btn btn-danger btn-sm" onclick="removeChild(${childCount})">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Primeiro Nome *</label>
                    <input type="text" class="form-control" name="children[${childCount}][first_name]" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Sobrenome *</label>
                    <input type="text" class="form-control" name="children[${childCount}][last_name]" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Data de Nascimento *</label>
                    <input type="date" class="form-control" name="children[${childCount}][date_of_birth]" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Gênero *</label>
                    <select class="form-select" name="children[${childCount}][gender]" required>
                        <option value="">Selecione...</option>
                        <option value="masculino">Masculino</option>
                        <option value="feminino">Feminino</option>
                        <option value="outro">Outro</option>
                    </select>
                </div>
            </div>
        </div>
    `;

        container.insertAdjacentHTML('beforeend', childHtml);
    }

    function removeChild(childId) {
        const childElement = document.getElementById(`child-${childId}`);
        childElement.remove();

        const container = document.getElementById('children-container');
        if (container.children.length === 0) {
            container.innerHTML = '<p class="text-muted">Clique em "Adicionar Filho" para incluir informações dos filhos.</p>';
        }
    }



    function togglePositionInput(value) {
        const input = document.getElementById('position_input');
        if (value === 'Outro') {
            input.style.display = 'block';
            input.value = ''; // Limpa o valor, será preenchido manualmente
        } else {
            input.style.display = 'none';
            input.value = value; // Atualiza o input com o valor do select
        }
    }

    // Executa ao carregar a página
    document.addEventListener('DOMContentLoaded', function () {
        const select = document.getElementById('position_select');
        const currentValue = "{{ old('position') }}";
        const options = ['Operador', 'Diácono', 'Evangelista', 'Presbítero', 'Pastor'];

        if (!options.includes(currentValue) && currentValue !== '') {
            // Se o valor antigo não está nas opções padrão, mostrar input livre
            togglePositionInput('Outro');
            document.getElementById('position_input').value = currentValue;
            select.value = 'Outro';
        } else {
            // Se está entre as opções padrão, garantir consistência
            togglePositionInput(select.value);
        }
    });

</script>
@endsection

