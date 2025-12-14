@vite(['resources/css/app.css', 'resources/js/app.js']);
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet"/>
        <title>Details</title>
    </head>
    <body>
        <div class="container d-flex justify-content-center">
            <div class="col-md-8">
                <h2 class="mb-3">{{ $title }}</h2>
                <dl class="row">
                    <h4 class="col-sm-12">Naam leverancier: {{ $leverancier[0]->LeverancierNaam}}</h4>
                    <h4 class="col-sm-12 ">Contactpersoon: {{ $leverancier[0]->ContactPersoon}}</h4>
                    <h4 class="col-sm-12 ">Leverancier nr: {{ $leverancier[0]->LeverancierNummer}}</h4>
                    <h4 class="col-sm-12 ">Mobiel: {{ $leverancier[0]->Mobiel}}</h4>
                </dl>
                <table class="table">
                    <thead>
                        <th>Naam product</th>
                        <th>Aantal in magazijn</th>
                        <th>VerpakkingsEenhied</th>
                        <th>Laatste levering</th>
                        <th>Nieuwe levering</th>
                    </thead>
                    <tbody>
                            @if ($leverancier[0]->ProductNaam != null)
                                @foreach ($leverancier as $levering)
                                    <tr>
                                        <td>{{ $levering->ProductNaam }}</td>
                                        <td>{{ $levering->AantalAanwezig }}</td>
                                        <td>{{ $levering->VerpakkingsEenheid }}</td>
                                        <td>{{ $levering->DatumLevering }}</td>
                                        <td>
                                        <form action="{{ route('Leverancier.LeveringInfo', $levering->Id) }}" method="POST">
                                            @csrf
                                            @method('GET')
                                            <button type="submit" class="btn btn-sm"><i class="bi bi-plus-lg"></i></button>
                                        </form>
                                        </td>
                                    </tr>
                                    
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="12">Dit bedrijf heeft tot nu toe geen producten geleverd aan Jamin</td>
                                    <meta http-equiv="refresh" content="3;url={{ route('Leverancier.index') }}">
                                </tr>
                            @endif
                    </tbody>
                </table>

                <div class="mt-3 d-flex">
                    <a href="{{ route('Leverancier.index') }}" class="btn btn-secondary btn-sm ms-auto">Terug</a>
                    <a href="{{ route('home') }}" class="btn btn-secondary btn-sm ms-1">Home</a>
                </div>
            </div>
        </div>
    </body>
</html>