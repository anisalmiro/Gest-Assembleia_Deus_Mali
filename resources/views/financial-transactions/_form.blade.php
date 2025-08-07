<form action="{{ $route }}" method="POST">
    @csrf
    @if($method === 'PUT') @method('PUT') @endif

    <div class="mb-3">
        <label>Membro</label>
        <select name="member_id" class="form-control">
            <option value="">-- Nenhum --</option>
            @foreach($members as $member)
            <option value="{{ $member->id }}"
                    {{ old('member_id', $transaction->member_id ?? '') == $member->id ? 'selected' : '' }}>
            {{ $member->first_name }} {{ $member->last_name }}
            </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Tipo</label>
        <select name="type" class="form-control" required>
            @foreach([
            'dizimo' => 'Dízimo',
            'doacao' => 'Doação',
            'colecta' => 'Coleta',
            'colecta_missoes' => 'Colecta de Missões',
            'accao_social' => 'Acção social',
            'agradecimentos' => 'Agradecimentos',
            'jovens' => 'Jovens',
            'celula_central' => 'Célula Central',
            'celula_2' => 'Célula 2',
            'celula_3' => 'Célula 3',
            'celula_4' => 'Célula 4',
            'celula_5' => 'Célula 5',
            'celula_6' => 'Célula 6',
            'celula_7' => 'Célula 7',
            'celula_8' => 'Célula 8',
            'dizimos_dos_dizimos' => 'Dízimos dos Dízimos',
            'xicotelas' => 'Xicotelas'
            ] as $key => $label)
            <option value="{{ $key }}" {{ old('type', $transaction->type ?? '') == $key ? 'selected' : '' }}>
            {{ $label }}
            </option>
            @endforeach
        </select>
    </div>


    <div class="mb-3">
        <label>Valor</label>
        <input type="number" step="0.01" name="amount" class="form-control" value="{{ old('amount', $transaction->amount ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label>Data da Transação</label>
        <input type="date" name="transaction_date" class="form-control" value="{{ old('transaction_date', isset($transaction) ? \Carbon\Carbon::parse($transaction->transaction_date)->format('Y-m-d') : '') }}" required>
    </div>

    <div class="mb-3">
        <label>Notas</label>
        <textarea name="notes" class="form-control">{{ old('notes', $transaction->notes ?? '') }}</textarea>
    </div>

    <button type="submit" class="btn btn-success">Salvar</button>
</form>
