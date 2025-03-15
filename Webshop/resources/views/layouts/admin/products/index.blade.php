@extends('layouts.app')

@section('title', 'Termékek kezelése')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Termékek kezelése</h1>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle mr-2"></i>Új termék hozzáadása
        </a>
    </div>

    <!-- Szűrő panel -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-filter mr-1"></i> Szűrők
            </h6>
            <button class="btn btn-link btn-sm" type="button" data-toggle="collapse" data-target="#filterCollapse">
                <i class="fas fa-chevron-down"></i>
            </button>
        </div>
        <div class="collapse show" id="filterCollapse">
            <div class="card-body">
                <form action="{{ route('admin.products.index') }}" method="GET" class="row">
                    <!-- Kategória szűrő -->
                    <div class="col-md-3 mb-3">
                        <label for="category_filter">Kategória</label>
                        <select name="category" id="category_filter" class="form-control">
                            <option value="">Minden kategória</option>
                            @foreach(\App\Models\Category::all() as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- Termék státusz -->
                    <div class="col-md-2 mb-3">
                        <label for="status_filter">Státusz</label>
                        <select name="status" id="status_filter" class="form-control text-black">
                            <option value="">Minden státusz</option>
                            <option class="" value="Aktív" {{ request('status') == 'Aktív' ? 'selected' : '' }}>Aktív</option>
                            <option value="Inaktív" {{ request('status') == 'Inaktív' ? 'selected' : '' }}>Inaktív</option>
                        </select>
                    </div>
                    
                    <!-- Ár tartomány -->
                    <div class="col-md-3 mb-3">
                        <label>Ár tartomány</label>
                        <div class="row">
                            <div class="col-6">
                                <input type="number" name="min_price" class="form-control" placeholder="Min" value="{{ request('min_price') }}">
                            </div>
                            <div class="col-6">
                                <input type="number" name="max_price" class="form-control" placeholder="Max" value="{{ request('max_price') }}">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Keresés -->
                    <div class="col-md-4 mb-3">
                        <label for="search">Keresés</label>
                        <div class="input-group">
                            <input type="text" name="search" id="search" class="form-control" placeholder="Termék neve, cikkszáma vagy leírása" value="{{ request('search') }}">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Extra szűrők -->
                    <div class="col-md-7 mb-3">
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" class="custom-control-input" id="is_featured" name="is_featured" value="1" {{ request('is_featured') ? 'checked' : '' }}>
                            <label class="custom-control-label" for="is_featured">Kiemelt termékek</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" class="custom-control-input" id="is_new" name="is_new_arrival" value="1" {{ request('is_new_arrival') ? 'checked' : '' }}>
                            <label class="custom-control-label" for="is_new">Új termékek</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" class="custom-control-input" id="has_discount" name="has_discount" value="1" {{ request('has_discount') ? 'checked' : '' }}>
                            <label class="custom-control-label" for="has_discount">Akciós termékek</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" class="custom-control-input" id="low_stock" name="low_stock" value="1" {{ request('low_stock') ? 'checked' : '' }}>
                            <label class="custom-control-label" for="low_stock">Alacsony készlet</label>
                        </div>
                    </div>
                    
                    <!-- Gombok -->
                    <div class="col-md-5 mb-3 text-right text-white">
                        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary text-white">
                            <i class="fas fa-sync-alt mr-1 text-white"></i>Alapállapot
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-filter mr-1"></i>Szűrés
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Termék lista kártya -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-box mr-1"></i> Termékek listája 
                <span class="badge badge-primary ml-2">{{ $products->total() }} db</span>
            </h6>
            <div class="dropdown">
                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="bulkActionsDropdown" data-toggle="dropdown">
                    <i class="fas fa-cog mr-1"></i>Műveletek
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="bulkActionsDropdown">
                    <a class="dropdown-item" href="#" id="exportSelected">
                        <i class="fas fa-file-export mr-1"></i>Kiválasztottak exportálása
                    </a>
                    <a class="dropdown-item text-danger" href="#" id="deleteSelected">
                        <i class="fas fa-trash mr-1"></i>Kiválasztottak törlése
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-bordered m-0">
                    <thead class="thead-dark">
                        <tr>
                            <th width="40">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="selectAll">
                                    <label class="custom-control-label" for="selectAll"></label>
                                </div>
                            </th>
                            <th width="70">Kép</th>
                            <th>
                                <a href="{{ route('admin.products.index', ['sort' => 'name', 'direction' => request('direction') == 'asc' && request('sort') == 'name' ? 'desc' : 'asc'] + request()->except(['sort', 'direction', 'page'])) }}" class="text-white d-flex justify-content-between">
                                    Termék neve
                                    @if(request('sort') == 'name')
                                        <i class="fas fa-chevron-{{ request('direction') == 'asc' ? 'up' : 'down' }}"></i>
                                    @endif
                                </a>
                            </th>
                            <th>Kategória</th>
                            <th>
                                <a href="{{ route('admin.products.index', ['sort' => 'price', 'direction' => request('direction') == 'asc' && request('sort') == 'price' ? 'desc' : 'asc'] + request()->except(['sort', 'direction', 'page'])) }}" class="text-white d-flex justify-content-between">
                                    Ár
                                    @if(request('sort') == 'price')
                                        <i class="fas fa-chevron-{{ request('direction') == 'asc' ? 'up' : 'down' }}"></i>
                                    @endif
                                </a>
                            </th>
                            <th width="90">
                                <a href="{{ route('admin.products.index', ['sort' => 'stock_quantity', 'direction' => request('direction') == 'asc' && request('sort') == 'stock_quantity' ? 'desc' : 'asc'] + request()->except(['sort', 'direction', 'page'])) }}" class="text-black d-flex justify-content-between">
                                    Készlet
                                    @if(request('sort') == 'stock_quantity')
                                        <i class="fas fa-chevron-{{ request('direction') == 'asc' ? 'up' : 'down' }}"></i>
                                    @endif
                                </a>
                            </th>
                            <th width="100">Státusz</th>
                            <th width="130">Műveletek</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td class="align-middle">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input product-checkbox" id="product{{ $product->id }}" value="{{ $product->id }}">
                                        <label class="custom-control-label" for="product{{ $product->id }}"></label>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    @if($product->images()->exists())
                                        <img src="{{ asset($product->images()->where('is_primary', 1)->first()->image_path) }}" 
                                             alt="{{ $product->name }}" class="img-thumbnail" width="50">
                                    @else
                                        <div class="bg-light d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                            <i class="fas fa-image text-muted"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="align-middle">
                                    <div class="font-weight-bold">{{ $product->name }}</div>
                                    <div class="small text-muted">
                                        <span class="mr-2"><i class="fas fa-tag mr-1"></i>{{ $product->brand }}</span>
                                        @if($product->is_featured)
                                            <span class="badge bg-info mr-1">Kiemelt</span>
                                        @endif
                                        @if($product->is_new_arrival)
                                            <span class="badge bg-success mr-1">Új</span>
                                        @endif
                                        @if($product->discount_percentage > 0)
                                            <span class="badge bg-danger">-{{ $product->discount_percentage }}%</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="align-middle">
                                    @if($product->category)
                                        {{ $product->category->name }}
                                    @else
                                        <span class="text-muted">Nincs kategória</span>
                                    @endif
                                </td>
                                <td class="align-middle">
                                    <div class="font-weight-bold">{{ number_format($product->price, 0, ',', ' ') }} Ft</div>
                                    @if($product->original_price > $product->price)
                                        <div class="small text-muted text-decoration-line-through">
                                            {{ number_format($product->original_price, 0, ',', ' ') }} Ft
                                        </div>
                                    @endif
                                </td>
                                <td class="align-middle">
                                    @if($product->stock_quantity > 10)
                                        <span class="badge bg-success badge-pill stock-badge">{{ $product->stock_quantity }} db</span>
                                    @elseif($product->stock_quantity > 3)
                                        <span class="badge bg-warning badge-pill stock-badge">{{ $product->stock_quantity }} db</span>
                                    @elseif($product->stock_quantity > 0)
                                        <span class="badge bg-danger badge-pill stock-badge">{{ $product->stock_quantity }} db</span>
                                    @else
                                        <span class="badge badge-dark badge-pill stock-badge">Elfogyott</span>
                                    @endif
                                </td>
                                <td class="align-middle">
                                    @if($product->status == 'Aktív')
                                        <span class="badge bg-success status-badge">Aktív</span>
                                    @elseif($product->status == 'Inaktív')
                                        <span class="badge bg-secondary status-badge">Inaktív</span>
                                    @elseif($product->status == 'Elfogyott')
                                        <span class="badge bg-danger status-badge">Elfogyott</span>
                                    @else
                                        <span class="badge bg-warning status-badge">Hamarosan Érkezik</span>
                                    
                                    @endif
                                </td>
                                <td class="align-middle">
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('products.show', $product->slug) }}" class="btn btn-info" target="_blank" title="Megtekintés">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-primary text-white" title="Szerkesztés">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-danger delete-product" data-id="{{ $product->id }}" title="Törlés">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4">
                                    <div class="py-5">
                                        <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                                        <h4>Nem található termék</h4>
                                        <p class="text-muted">A keresési feltételeknek megfelelő termék nem található.</p>
                                        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-primary mt-3">
                                            <i class="fas fa-sync-alt mr-1"></i>Összes termék mutatása
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <div class="row align-items-center">
                <div class="col-md-6 small">
                    Összesen: <strong>{{ $products->total() }}</strong> termék, 
                    <strong>{{ $products->firstItem() ?? 0 }}</strong> - <strong>{{ $products->lastItem() ?? 0 }}</strong> mutatása
                </div>
                <div class="col-md-6">
                    <div class="pagination-container d-flex justify-content-end">
                        @if ($products->hasPages())
                            <nav aria-label="Termék lapozás">
                                <ul class="pagination pagination-modern">
                                    {{-- Előző oldal link --}}
                                    @if ($products->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link page-arrow prev-arrow">
                                                <i class="fas fa-chevron-left"></i>
                                            </span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link page-arrow prev-arrow" href="{{ $products->previousPageUrl() }}" rel="prev">
                                                <i class="fas fa-chevron-left"></i>
                                            </a>
                                        </li>
                                    @endif

                                    {{-- Oldalszámok --}}
                                    @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                                        <li class="page-item {{ $page == $products->currentPage() ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endforeach

                                    {{-- Következő oldal link --}}
                                    @if ($products->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link page-arrow next-arrow" href="{{ $products->nextPageUrl() }}" rel="next">
                                                <i class="fas fa-chevron-right"></i>
                                            </a>
                                        </li>
                                    @else
                                        <li class="page-item disabled">
                                            <span class="page-link page-arrow next-arrow">
                                                <i class="fas fa-chevron-right"></i>
                                            </span>
                                        </li>
                                    @endif
                                </ul>
                            </nav>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Törlés megerősítő modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">
                    <i class="fas fa-exclamation-triangle mr-2"></i>Termék törlése
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Biztosan törölni szeretnéd ezt a terméket? Ez a művelet nem visszavonható!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Mégsem</button>
                <form id="deleteForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Törlés megerősítése</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Több termék törlése modal -->
<div class="modal fade" id="bulkDeleteModal" tabindex="-1" role="dialog" aria-labelledby="bulkDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="bulkDeleteModalLabel">
                    <i class="fas fa-exclamation-triangle mr-2"></i>Több termék törlése
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Biztosan törölni szeretnéd a kiválasztott termékeket? Ez a művelet nem visszavonható!</p>
                <div id="selectedProductsInfo" class="alert alert-info">
                    <span id="selectedCount">0</span> termék kiválasztva
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Mégsem</button>
                {{-- <form id="bulkDeleteForm" method="POST" action="{{ route('admin.products.bulk-delete') }}">
                    @csrf
                    <input type="hidden" name="product_ids" id="productIdsToDelete">
                    <button type="submit" class="btn btn-danger">Törlés megerősítése</button>
                </form> --}}
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
/* Modern lapozás stílusok - Hover nélkül */
.pagination-modern {
    display: flex;
    padding-left: 0;
    list-style: none;
    border-radius: 0.25rem;
    margin-bottom: 0;
}

.pagination-modern .page-item:first-child .page-link {
    border-top-left-radius: 0.5rem;
    border-bottom-left-radius: 0.5rem;
}

.pagination-modern .page-item:last-child .page-link {
    border-top-right-radius: 0.5rem;
    border-bottom-right-radius: 0.5rem;
}

.pagination-modern .page-item.active .page-link {
    background-color: #2563eb;  /* Kék alapszín */
    border-color: #2563eb;
    color: #fff;
    box-shadow: 0 2px 5px rgba(37, 99, 235, 0.2);
    font-weight: 600;
}

.pagination-modern .page-item.disabled .page-link {
    color: #b9c3ce;
    background-color: #f8fafc;
    border-color: #e9ecef;
}

.pagination-modern .page-link {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    min-width: 38px;
    height: 38px;
    padding: 0.375rem 0.75rem;
    margin-left: -1px;
    line-height: 1.25;
    color: #495057;
    background-color: #fff;
    border: 1px solid #e9ecef;
}

/* Modern nyilak - Statikus */
.pagination-modern .page-arrow {
    background-color: #f8fafc;
    padding: 0.375rem 0.95rem;
}

.pagination-modern .next-arrow {
    background: linear-gradient(to right, #f8fafc, #2563eb);
    color: white;
    border-top-right-radius: 0.5rem !important;
    border-bottom-right-radius: 0.5rem !important;
}

.pagination-modern .prev-arrow {
    background: linear-gradient(to left, #f8fafc, #2563eb);
    color: white;
    border-top-left-radius: 0.5rem !important;
    border-bottom-left-radius: 0.5rem !important;
}

.pagination-modern .page-item.disabled .next-arrow {
    background: linear-gradient(to right, #f8fafc, #b9c3ce);
    color: #e2e8f0;
}

.pagination-modern .page-item.disabled .prev-arrow {
    background: linear-gradient(to left, #f8fafc, #b9c3ce);
    color: #e2e8f0;
}

/* Készlet jelzések */
.stock-badge {
    min-width: 60px;
    font-weight: bold;
}

.status-badge {
    min-width: 60px;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.table td, .table th {
    vertical-align: middle;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Törlés gomb kezelése
    const deleteButtons = document.querySelectorAll('.delete-product');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.dataset.id;
            const deleteForm = document.getElementById('deleteForm');
            deleteForm.action = '{{ route("admin.products.destroy", "") }}/' + productId;
            $('#deleteModal').modal('show');
        });
    });
    
    // "Összes kijelölése" gomb kezelése
    const selectAllCheckbox = document.getElementById('selectAll');
    if (selectAllCheckbox) {
        selectAllCheckbox.addEventListener('change', function() {
            const productCheckboxes = document.querySelectorAll('.product-checkbox');
            productCheckboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
            updateSelectedCount();
        });
    }
    
    // Egyedi termék kijelölések nyomon követése
    const productCheckboxes = document.querySelectorAll('.product-checkbox');
    productCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateSelectedCount);
    });
    
    // Kiválasztott termékek számának frissítése
    function updateSelectedCount() {
        const selectedCheckboxes = document.querySelectorAll('.product-checkbox:checked');
        const selectedCount = document.getElementById('selectedCount');
        if (selectedCount) {
            selectedCount.textContent = selectedCheckboxes.length;
        }
    }
    
    // Tömeges törlés gomb kezelése
    const deleteSelectedButton = document.getElementById('deleteSelected');
    if (deleteSelectedButton) {
        deleteSelectedButton.addEventListener('click', function(e) {
            e.preventDefault();
            const selectedCheckboxes = document.querySelectorAll('.product-checkbox:checked');
            if (selectedCheckboxes.length === 0) {
                alert('Kérjük, válassz ki legalább egy terméket a törléshez!');
                return;
            }
            
            const productIds = Array.from(selectedCheckboxes).map(checkbox => checkbox.value);
            document.getElementById('productIdsToDelete').value = productIds.join(',');
            $('#bulkDeleteModal').modal('show');
        });
    }
});
</script>
@endpush