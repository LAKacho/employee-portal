<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<h1>Список сотрудников</h1>

<form action="{{ url('/employees-list') }}" method="GET">
    <input type="text" name="name" placeholder="Имя" value="{{ $filters['name'] ?? '' }}">
    <input type="text" name="departament" placeholder="Отдел" value="{{ $filters['departament'] ?? '' }}">
    <button type="submit">Фильтровать</button>
    <a href="{{ url('/employees-list') }}">Сбросить</a>
</form>

@forelse ($employees as $emp)
    <p>{{ $emp->name }} — {{ $emp->departament }} — {{ $emp->salary }}</p>
@empty
    <p>Сотрудники не найдены</p>
@endforelse

{{ $employees->appends($filters)->links() }}

<button onclick="alert('Привет!')">Нажми меня</button>

<script>
    console.log("Страница загружена");
</script>

<button id="loadBtn">Загрузить данные</button>
<div id="result"></div>

<script>
document.getElementById('loadBtn').addEventListener('click', function() {
    fetch('/employees')
        .then(response => response.json())
        .then(data => {
            document.getElementById('result').innerText = JSON.stringify(data);
        });
});
</script>

<form action="http://localhost:8000/employees" method="POST">
    @csrf
    <input type="text" name="name" placeholder="Имя">
    <input type="text" name="departament" placeholder="Отдел">
    <input type="number" name="salary" placeholder="Зарплата">
    <button type="submit">Добавить</button>
</form>
