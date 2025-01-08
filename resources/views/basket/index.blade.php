@extends('layouts.app')
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <style>
        h1 {
            margin-left: 120px;
        }

        #produkt {
            margin-left: 120px;
            margin-right: 120px;
        }

        #count {
            float: right;
        }

        #confirm {
            float: right;
            margin-left: 130px;
            margin-right: 130px;
        }

        #empty {
            margin-left: 130px;
            margin-right: 130px;
        }
    </style>
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    @section('content')
        <div>
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <h1>My basket</h1>
            <form action="{{ route('basket.confirm') }}" method="POST"
                onsubmit="return confirm('Do you want to confirm transaction?');">
                @csrf
                @method('PUT')
                @forelse ($baskets as $basket)
                    <div class="card" id="produkt" style="width: 95rem;">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <h3>{{ $basket->product->product_name }}</h3>
                                {{ $basket->product->price }} zł
                                <div id="count">
                                    <label for="quantity">Quantity:</label>
                                    <input type="number" name="{{ $basket->id }}" id="{{ $basket->id }}"
                                        value="{{ $basket->quantity }}" min="1"
                                        max="{{ $basket->product->stock }}" />
                                    <button type="button" class="btn btn-danger deleteButton"
                                        data-id="{{ $basket->product->id }}">Delete</button>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <br>
                @empty
                    <div class="alert alert-danger" id="empty" role="alert">
                        Your basket is empty! Please go back and find something you like!
                    </div>
                @endforelse
                <button type="submit" id="confirm" class="btn btn-primary"
                    @if (count($baskets) == 0) disabled @endif>
                    Confirm purchase
                </button>
            </form>
        </div>

        <script>
            const buttons = document.getElementsByClassName('deleteButton');
            Object.values(buttons).forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    fetch(`/basket/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        })
                        .then(res => location.reload())
                });
            });
        </script>
    @endsection
