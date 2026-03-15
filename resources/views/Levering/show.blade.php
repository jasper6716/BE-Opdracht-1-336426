@vite(['resources/css/app.css', 'resources/js/app.js'])
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet"/>
    <title>levering pagina</title>
</head>
<body>
    <div class="container">

        <h1>{{ $title }}</h1>
    
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }} 
                <button type="button" class="btn-close" aria-label="sluiten" data-bs-dismiss="alert"></button>
            </div>
            <meta http-equiv="refresh" content="3;url={{ route('Levering.index') }}">
            @endif

        <div class="mt-3">
            <form action="{{ route('Levering.index') }}" method="POST">
                @csrf
                @method('GET')
                Startdatum: <input type="date" name="startDatum" value="{{ request('startDatum') }}">
                einddatum: <input type="date" name="eindDatum" value="{{ request('eindDatum') }}">
                <button type="submit" class="btn btn-secondary btn-sm">Maak selectie</button>
            </form>
        </div>

        <table class="table">
            <thead>
                <th>Naam leverancier</th>
                <th>ContactPersoon</th>
                <th>Productnaam</th>
                <th>Totaal geleverd</th>
                <th>Specificatie</th>
            </thead>
            <tbody>
                
                @forelse ($leveringen as $levering)
                <tr>
                    <td>{{ $levering->LeverancierNaam }}</td>
                    <td>{{ $levering->ContactPersoon }}</td>
                    <td>{{ $levering->ProductNaam }}</td>
                    <td>{{ $levering->TotaalGeleverd }}</td>
                     <td>
                        <form action="{{ route('Levering.show', $levering->ProductNaam) }}" method="POST">
                            @csrf
                            @method('GET')
                            <button type="submit" class="btn btn-warning btn-sm"><i class="bi bi-patch-question"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3">Er zijn geen leveringen geweest van producten in deze periode</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>