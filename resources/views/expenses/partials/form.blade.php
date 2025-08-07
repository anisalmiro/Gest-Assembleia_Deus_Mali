<div class="mb-3">
    <label for="category" class="form-label">Categoria</label>
    <select name="category" class="form-control" id="category" required onchange="toggleCustomCategory()">
        @foreach([
        '' => 'Selecionar',
        'agua' => 'Água',
        'luz' => 'Luz',
        'energia' => 'Energia',
        'despesas_guarda' => 'Despesas Com Guarda',
        'com_lider_local' => 'Com Líder Local',
        'visitas' => 'Visitas',
        'disputas_missoes' => 'Disputas com Missões',
        'dispensas_construcao' => 'Dispensas de Construção da Igreja',
        'dispensas_som' => 'Dispensas de Som',
        'dispensas_limpeza' => 'Dispensas com Limpeza',
        'ref_abate' => 'Ref. Abate',
        'outras' => 'Outras'
        ] as $key => $label)
        <option value="{{ $key }}" {{ old('category', $transaction->category ?? '') == $key ? 'selected' : '' }}>
        {{ $label }}
        </option>
        @endforeach
    </select>
</div>

<div class="mb-3" id="custom-category-group" style="display: none;">
    <label for="custom_category" class="form-label">Outra Categoria</label>
    <input type="text" name="custom_category" id="custom_category" class="form-control" value="{{ old('custom_category') }}">
</div>

<div class="mb-3">
    <label for="description" class="form-label">Descrição</label>
    <input type="text" name="description" id="description" class="form-control" value="{{ old('description', optional($expense)->description) }}" required>
</div>

<div class="mb-3">
    <label for="amount" class="form-label">Valor (MZN)</label>
    <input type="number" name="amount" id="amount" class="form-control" value="{{ old('amount', optional($expense)->amount) }}" step="0.01" required>
</div>

<div class="mb-3">
    <label for="expense_date" class="form-label">Data da Despesa</label>
    <input type="date" name="expense_date" id="expense_date" class="form-control" value="{{ old('expense_date', optional($expense)->expense_date) }}" required>
</div>



<script>
    function toggleCustomCategory() {
        const select = document.getElementById('category');
        const customGroup = document.getElementById('custom-category-group');
        if (select.value === 'outras') {
            customGroup.style.display = 'block';
        } else {
            customGroup.style.display = 'none';
            document.getElementById('custom_category').value = '';
        }
    }

    // Garantir que funcione ao recarregar a página com valor antigo
    document.addEventListener('DOMContentLoaded', function () {
        toggleCustomCategory();
    });
</script>



<div class="mb-3">
    <label for="notes" class="form-label">Notas</label>
    <textarea name="notes" id="notes" class="form-control">{{ old('notes', optional($expense)->notes) }}</textarea>
</div>
