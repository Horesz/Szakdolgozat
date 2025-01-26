@extends('layouts.admin')

@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-2xl font-bold mb-6">Termékek listája</h1>

    <a href="{{ route('admin.products.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
        Új termék hozzáadása
    </a>

    <table class="table-auto w-full mt-6 border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="border border-gray-300 px-4 py-2">Név</th>
                <th class="border border-gray-300 px-4 py-2">Ár</th>
                <th class="border border-gray-300 px-4 py-2">Raktáron</th>
                <th class="border border-gray-300 px-4 py-2">Típus</th>
                <th class="border border-gray-300 px-4 py-2">Kategória</th>
                <th class="border border-gray-300 px-4 py-2">Műveletek</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{{ $product->name }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $product->price }} Ft</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $product->stock_quantity }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $product->type }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $product->category->name }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="text-blue-500">Szerkesztés</a> | 
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500" onclick="return confirm('Biztosan törölni szeretnéd?')">Törlés</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-4">Nincs elérhető termék.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $products->links() }}
    </div>
</div>
@endsection
