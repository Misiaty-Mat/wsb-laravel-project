@extends('layouts.app')

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
                <div>
                    <strong>{{ $basket->product->product_name }}</strong><br>
                    <p>{{ $basket->product->price }} zł</p>
                    <label for="quantity">Quantity:</label>
                    <input type="number" name="{{ $basket->id }}" id="{{ $basket->id }}" value="{{ $basket->quantity }}"
                        min="1" max="{{ $basket->product->stock }}" />
                    <button type="button" class="btn btn-danger deleteButton"
                        data-id="{{ $basket->product->id }}">Delete</button>
                </div>
            @empty
                <div class="alert alert-danger" role="alert">
                    Your basket is empty! Please go back and find something you like!
                </div>
            @endforelse
            <button type="submit" class="btn btn-primary" @if (count($baskets) == 0) disabled @endif>
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
