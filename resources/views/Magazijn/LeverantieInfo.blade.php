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
                <dl class="row">
                    <h2 class="col-sm-12">Naam leverancier: {{ $magazijn[0]->LeverancierNaam}}</h>
                    <h2 class="col-sm-12 ">Contactpersoon leverancier: {{ $magazijn[0]->ContactPersoon}}</h2>
                    <h2 class="col-sm-12 ">Leverancier nummer: {{ $magazijn[0]->LeverancierNummer}}</h2>
                    <h2 class="col-sm-12 ">Mobiel: {{ $magazijn[0]->Mobiel}}</h2>
                </dl>
                <table class="table">
                    <thead>
                        <th>Naam product</th>
                        <th>Datum laatste levering</th>
                        <th>Aantal</th>
                        <th>Eerstvolgende levering</th>
                    </thead>
                    <tbody>
                        @if ($magazijn[0]->AantalAanwezig > 0)
                            @foreach ($magazijn as $product)
                            <tr>
                                <td>{{ $product->ProductNaam }}</td>
                                <td>{{ $product->DatumLevering }}</td>
                                <td>{{ $product->Aantal }}</td>
                                <td>{{ $product->DatumEerstVolgendeLevering }}</td>
                            </tr>
                            @endforeach
                        @else
                        <tr>
                            <td colspan="3">Er is van dit product op dit moment geen voorraad aanwezig, de verwachte eerstvolgende levering is: {{ $magazijn[0]->DatumEerstVolgendeLevering }}</td>
                            <meta http-equiv="refresh" content="4;url={{ route('Magazijn.index') }}">
                        </tr>
                        @endif
                    </tbody>
                </table>

                <div class="mt-3 d-flex gap-2">
                    <a href="{{ route('Magazijn.index') }}" class="btn btn-secondary btn-sm ms-auto">Terug</a>
                </div>
            </div>
        </div>
    </body>
</html>