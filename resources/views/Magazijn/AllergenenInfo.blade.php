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
                    <h2 class="col-sm-12">Naam: {{ $magazijn[0]->ProductNaam}}</h>
                    <h2 class="col-sm-12 ">Barcode: {{ $magazijn[0]->Barcode}}</h2>
                </dl>
                <table class="table">
                    <thead>
                        <th>Naam</th>
                        <th>Omschrijving</th>
                    </thead>
                    <tbody>
                        @if ($magazijn[0]->AllergeenNaam != null)
                            @foreach ($magazijn as $product)
                            <tr>
                                <td>{{ $product->AllergeenNaam }}</td>
                                <td>{{ $product->Omschrijving }}</td>
                            </tr>
                            @endforeach
                        @else
                        <tr>
                            <td colspan="3">In dit product zitten geen stoffen die een allergische reactie kunnen veroorzaken</td>
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