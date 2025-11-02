@vite(['resources/css/app.css', 'resources/js/app.js'])
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Allergenen pagina</title>
</head>
<body>
    <div class="container">

        <h1>{{ $title }}</h1>
    
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }} 
                <button type="button" class="btn-close" aria-label="sluiten" data-bs-dismiss="alert"></button>
            </div>
            <meta http-equiv="refresh" content="3;url={{ route('Allergenen.index') }}">
            @endif
    
        <a href="{{ route('Allergenen.create') }}" class="btn btn-primary mt-2">Nieuwe allergeen</a>
    
        <table class="table">
            <thead>
                <th>Naam</th>
                <th>Omschrijving</th>
                <th>Verwijderen</th>
                <th>Wijzigen</th>
            </thead>
            <tbody>
                
                @forelse ($allergenen as $allergeen)
                <tr>
                    <td>{{ $allergeen->Naam }}</td>
                    <td>{{ $allergeen->Omschrijving }}</td>
                    <td>
                        <form action="{{ route('Allergenen.destroy', $allergeen->Id) }}" method="POST" 
                        onsubmit="return confirm('weet u zeker dat u dit allergeen wilt verwijderen?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Verwijderen</button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('Allergenen.edit', $allergeen->Id) }}" method="POST">
                            @csrf
                            @method('GET')
                            <button type="submit" class="btn btn-success btn-sm">Wijzig</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3">Geen Allergenen gevonden</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>