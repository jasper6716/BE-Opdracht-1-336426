@vite(['resources/css/app.css', 'resources/js/app.js'])
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create allergeen</title>
</head>
<body>
    <div class="container">


        <h2 class="my-3">{{ $title }}</h2>

    
        <form method="POST" action="{{ route('Allergenen.store') }}">
            @csrf
            <div class="mb-3">
                <label for="InputNaam" class="form-label">Naam</label>
                <input name="naam" type="text" class="form-control" id="InputNaam" aria-describedby="naamHelp">
                <div id="naamHelp" class="form-text">Noteer hier de naam van het allergeen</div>
            </div>
            <div class="mb-3">
                <label for="InputOmschrijving" class="form-label">Omschrijving</label>
                <input name="omschrijving" type="text" class="form-control" id="InputOmschrijving" aria-describedby="omschrijvingHelp">
                <div id="omschrijvingHelp" class="form-text">Noteer hier de Omschrijving van het allergeen</div>
            </div>

            <button type="submit" class="btn btn-primary">Verzend</button>
        </form>


    </div>
</body>
</html>