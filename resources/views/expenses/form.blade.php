@csrf

<div class="mb-3">
    <label for="category_id" class="form-label">Категория</label>
    <select id="category_id" name="category_id" class="form-select @error('category_id') is-invalid @enderror">
        <option value="">— выберите —</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" @selected(old('category_id', $expense->category_id ?? '') == $category->id)>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
    @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label for="amount" class="form-label">Количество токенов</label>
    <input id="amount" type="number" name="amount" value="{{ old('amount', $expense->amount ?? '') }}"
            class="form-control @error('amount') is-invalid @enderror">
    @error('amount')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label for="description" class="form-label">Описание (что за задание)</label>
    <input id="description" type="text" name="description" value="{{ old('description', $expense->description ?? '') }}"
            class="form-control @error('description') is-invalid @enderror">
    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label for="spent_at" class="form-label">Дата траты</label>
    <input id="spent_at" type="date" name="spent_at"
            value="{{ old('spent_at', isset($expense) ? $expense->spent_at->toDateString() : now()->toDateString()) }}"
            class="form-control @error('spent_at') is-invalid @enderror">
    @error('spent_at')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<button class="btn btn-primary" type="submit">Сохранить</button>
<a class="btn btn-link" href="{{ route('expenses.index') }}">Отмена</a>
