@vite(['resources/css/app.css', 'resources/js/app.js']);
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Details</title>
    </head>
    <body>
        <div class="container d-flex justify-content-center">
            <div class="col-md-8">
                <h2 class="mb-3">{{ $title }}</h2>

                <div class="card shadow-sm">
                    <div class="card-body">
                        <dl class="row">
                            <dt class="col-sm-3">Naam</dt>
                            <dd class="col-sm-9">{{ $allergeen->Naam}}</dd>

                            <dt class="col-sm-3">Omschrijving</dt>
                            <dd class="col-sm-9">{{ $allergeen->Omschrijving}}</dd>

                            <dt class="col-sm-3">Datum gewijzigd</dt>
                            <dd class="col-sm-9">{{ $allergeen->DatumGewijzigd}}</dd>
                        </dl>
                    </div>
                </div> 

                <div class="mt-3 d-flex gap-2">
                    <form action="{{ route('allergeen.edit', $allergeen->Id) }}" method="POST">
                        @csrf
                        @method('GET')
                        <button type="submit" class="btn btn-success btn-sm">Wijzig</button>
                    </form>
                
                    <form action="{{ route('allergeen.destroy', $allergeen->Id) }}" method="POST" 
                        onsubmit="return confirm('Weet je zeker dat je dit allergeen wilt verwijderen?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Verwijderen</button>
                    </form>
                    <a href="{{ route('allergeen.index') }}" class="btn btn-secondary btn-sm ms-auto">Terug</a>
                </div>
            </div>
        </div>
    </body>
</html>