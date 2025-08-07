<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Relatório de Membros</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 6px; text-align: left; vertical-align: top; }
        th { background-color: #eee; }
        ul { margin: 0; padding-left: 15px; }
    </style>
</head>
<body>
<h2>Relatório de Membros</h2>

<table>
    <thead>
    <tr>
        <th>Nome</th>
        <th>Data de Nascimento</th>
        <th>Gênero</th>
        <th>Estado Civil</th>
        <th>Esposa</th>
        <th>Filhos</th>
    </tr>
    </thead>
    <tbody>
    @foreach($members as $member)
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
            <ul>
                @foreach($member->children as $child)
                <li>{{ $child->first_name }} {{ $child->last_name }} ({{ ucfirst($child->gender) }})</li>
                @endforeach
            </ul>
            @else
            -
            @endif
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
