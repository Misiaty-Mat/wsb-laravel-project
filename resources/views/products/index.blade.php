<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produkty</title>
</head>
<body>
    <h1>Lista produktów</h1>
    <ul>
        @foreach ($products as $product)
            <li>
                <strong>{{ $product->name }}</strong><br>
                Cena: {{ $product->price }} zł<br>
                Opis: {{ $product->description }}<br>
                Dostępne: {{ $product->stock }}
            </li>
        @endforeach
    </ul>
</body>
</html>