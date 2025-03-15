@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-5">
    <div class="card shadow-lg border-0 rounded-lg">
        <div class="card-header bg-gradient-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="m-0 text-black fs-4">Kategóriák kezelése</h2>
                <a href="{{ route('admin.categories.create') }}" class="btn btn-light">
                    <i class="fas fa-plus-circle me-2"></i>Új kategória
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
                    <thead class="table-light text-secondary">
                        <tr>
                            <th scope="col" width="5%">#</th>
                            <th scope="col" width="20%">Kategória</th>
                            <th scope="col" width="25%">Leírás</th>
                            <th scope="col" width="15%">Termékek száma</th>
                            <th scope="col" width="10%">Állapot</th>
                            <th scope="col" width="25%">Műveletek</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <!-- Kategória képe -->
                                        @if($category->image)
                                            <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" 
                                                class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
                                        @else
                                            <div class="bg-light d-flex align-items-center justify-content-center" 
                                                style="width: 50px; height: 50px;">
                                                <i class="fas fa-folder fa-lg text-secondary"></i>
                                            </div>
                                        @endif
                                        <div class="ms-3">
                                            <h6 class="mb-0">{{ $category->name }}</h6>
                                            <small class="text-muted">{{ $category->slug }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div style="max-height: 50px; overflow: hidden;">
                                        {{ Str::limit($category->description, 100) }}
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-info">{{ $category->products->count() }} termék</span>
                                </td>
                                <td>
                                    @if($category->status == 'active')
                                        <span class="badge bg-success">Aktív</span>
                                    @else
                                        <span class="badge bg-secondary">Inaktív</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-edit me-1"></i>Szerkesztés
                                        </a>
                                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger ms-1" 
                                                onclick="return confirm('Biztosan törölni szeretnéd ezt a kategóriát? A kapcsolódó termékek kategória nélkül maradnak!')">
                                                <i class="fas fa-trash-alt me-1"></i>Törlés
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                                        <h5>Még nincsenek kategóriák</h5>
                                        <p class="text-muted">Kattints az "Új kategória" gombra a hozzáadáshoz</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Lapozás -->
            <div class="d-flex justify-content-center mt-4">
                {{ $categories->links() }}
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