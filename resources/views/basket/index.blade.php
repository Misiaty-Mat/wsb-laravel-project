@extends('layouts.app')
@section('content')
    <div class="container">
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
                <div class="card">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <h3>{{ $basket->product->product_name }}</h3>
                            {{ $basket->product->price }} zł
                            <div style="float: right;">
                                <label for="quantity">Quantity:</label>
                                <input type="number" name="{{ $basket->id }}" id="{{ $basket->id }}"
                                    value="{{ $basket->quantity }}" min="1" max="{{ $basket->product->stock }}" />
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
            <button type="submit" style="float: right; margin-left: 130px; margin-right: 130px;" class="btn btn-primary"
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
