@vite(['resources/css/app.css', 'resources/js/app.js'])
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet"/>
    <title>Magazijn pagina</title>
</head>
<body>
    <div class="container">

        <h1>{{ $title }}</h1>
    
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }} 
                <button type="button" class="btn-close" aria-label="sluiten" data-bs-dismiss="alert"></button>
            </div>
            <meta http-equiv="refresh" content="3;url={{ route('Leverancier.index') }}">
            @endif
    
        <table class="table">
            <thead>
                <th>Naam</th>
                <th>Contactpersoon</th>
                <th>Leveranciernummer</th>
                <th>Mobiel</th>
                <th>Aantal verschillende producten</th>
                <th>Toon producten</th>
            </thead>
            <tbody>
                
                @forelse ($leverancier as $leverancierInfo)
                <tr>
                    <td>{{ $leverancierInfo->Naam }}</td>
                    <td>{{ $leverancierInfo->ContactPersoon }}</td>
                    <td>{{ $leverancierInfo->LeverancierNummer }}</td>
                    <td>{{ $leverancierInfo->Mobiel }}</td>
                    <td>{{ $leverancierInfo->VerschillendeProducten }}</td>
                    <td>
                        <form action="{{ route('Leverancier.LeveringInfo', $leverancierInfo->Id) }}" method="POST">
                            @csrf
                            @method('GET')
                            <button type="submit" class="btn btn-sm"><i class="bi bi-box"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3">Geen leveranciers gevonden</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-3 d-flex">
                    <a href="{{ route('home') }}" class="btn btn-secondary btn-sm ms-auto">Home</a>
        </div>
    </div>
</body>
</html>