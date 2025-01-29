@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg p-4 bg-white rounded-lg">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Termékek kezelése</h2>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-3">Új termék hozzáadása</a>
        
        <table class="table table-hover">
            <thead class="bg-blue-500 text-white">
                <tr>
                    <th>ID</th>
                    <th>Név</th>
                    <th>Ár</th>
                    <th>Kategória</th>
                    <th>Állapot</th>
                    <th>Műveletek</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ number_format($product->price, 2) }} Ft</td>
                    <td>{{ $product->category->name ?? 'N/A' }}</td>
                    <td class="{{ $product->status == 'Aktív' ? 'text-green-500 font-bold' : 'text-red-500 font-bold' }}">{{ $product->status }}</td>
                    <td>
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning btn-sm">Szerkesztés</a>
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Biztosan törölni szeretnéd?')">Törlés</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $products->links() }} <!-- Lapozás -->
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection
