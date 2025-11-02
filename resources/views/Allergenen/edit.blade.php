@vite(['resources/css/app.css', 'resources/js/app.js'])
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container d-flex justify-content-center">
        <div class="col-md-8">
            <h2>{{ $title  }}</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('Allergenen.update', $allergenen->Id) }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="InputNaam" class="form-label">Naam</label>
                <input name="naam" type="text" class="form-control" id="InputNaam" aria-describedby="naamHelp" 
                    value="{{ old('naam', $allergenen->Naam) }}">
            </div>
            <div class="mb-3">
                <label for="InputOmschrijving" class="form-label">Omschrijving</label>
                <input name="omschrijving" type="text" class="form-control" id="InputOmschrijving" aria-describedby="omschrijvingHelp"
                    value="{{ old('naam', $allergenen->Omschrijving) }}">
            </div>

            <button type="submit" class="btn btn-primary">Opslaan</button>
            <a href="{{ route('Allergenen.index') }}" class="btn-secondary btn">Annuleren</a>
        </form>
        </div>
    </div>
</body>
</html>