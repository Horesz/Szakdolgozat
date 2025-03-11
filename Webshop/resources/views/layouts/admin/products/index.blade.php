@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-5">
    <div class="card shadow-lg border-0 rounded-lg">
        <div class="card-header bg-gradient-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="m-0 fs-4">Termékek kezelése</h2>
                <a href="{{ route('admin.products.create') }}" class="btn btn-light">
                    <i class="fas fa-plus-circle me-2"></i>Új termék
                </a>
            </div>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table align-middle">
                    <!-- A table-hover osztályt eltávolítottam -->
                    <thead class="table-light text-secondary">
                        <tr>
                            <th scope="col" width="5%">#</th>
                            <th scope="col" width="25%">Termék</th>
                            <th scope="col" width="10%">Ár</th>
                            <th scope="col" width="15%">Kategória</th>
                            <th scope="col" width="10%">Készlet</th>
                            <th scope="col" width="10%">Állapot</th>
                            <th scope="col" width="25%">Műveletek</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <!-- Biztonságos ellenőrzés a képekhez -->
                                        @php
                                            $primaryImage = null;
                                            if (method_exists($product, 'images') && $product->images) {
                                                $primaryImage = $product->images()->where('is_primary', 1)->first();
                                                if (!$primaryImage) {
                                                    $primaryImage = $product->images()->first();
                                                }
                                            }
                                        @endphp
                                        
                                        @if($primaryImage)
                                            <img src="{{ $primaryImage->image_path }}" 
                                                alt="{{ $product->name }}" class="me-3 rounded" style="width: 50px; height: 50px; object-fit: cover;">
                                        @else
                                            <div class="me-3 rounded bg-light d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                                <i class="fas fa-image text-secondary"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <h6 class="mb-0">{{ $product->name }}</h6>
                                            <small class="text-muted">{{ $product->brand }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if($product->original_price > 0 && $product->original_price > $product->price)
                                        <span class="text-decoration-line-through text-muted">{{ number_format($product->original_price, 0, ',', ' ') }} Ft</span><br>
                                        <span class="fw-bold text-danger">{{ number_format($product->price, 0, ',', ' ') }} Ft</span>
                                    @else
                                        <span class="fw-bold">{{ number_format($product->price, 0, ',', ' ') }} Ft</span>
                                    @endif
                                </td>
                                <td>{{ $product->category->name ?? 'Nincs kategória' }}</td>
                                <td>
                                    @if($product->stock_quantity > 10)
                                        <span class="badge bg-success">{{ $product->stock_quantity }} db</span>
                                    @elseif($product->stock_quantity > 0)
                                        <span class="badge bg-warning text-dark">{{ $product->stock_quantity }} db</span>
                                    @else
                                        <span class="badge bg-danger">Elfogyott</span>
                                    @endif
                                </td>
                                <td>
                                    @if($product->status == 'Aktív')
                                        <span class="badge bg-success">Aktív</span>
                                    @elseif($product->status =='Elfogyott')
                                        <span class="badge bg-danger">Elfogyott</span>
                                    @elseif($product->status =='Hamarosan érkezik')
                                        <span class="badge bg-warning">Hamarosan érkezik</span>
                                    @else
                                        <span class="badge bg-secondary">{{ $product->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-edit me-1"></i>Szerkesztés
                                        </a>
                                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger ms-1" 
                                                onclick="return confirm('Biztosan törölni szeretnéd ezt a terméket?')">
                                                <i class="fas fa-trash-alt me-1"></i>Törlés
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                                        <h5>Még nincsenek termékek</h5>
                                        <p class="text-muted">Kattints az "Új termék" gombra a hozzáadáshoz</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Lapozás -->
            <div class="d-flex justify-content-center mt-4">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Automatikusan eltűnő üzenetek
    document.addEventListener('DOMContentLoaded', function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
            setTimeout(function() {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }, 5000);
        });
    });
</script>
@endpush

@endsection