@extends('layouts.app')

@section('title', 'Kapcsolat - GamerShop')

@section('content')
<div class="contact-page py-5">
    <!-- Hero section -->
    <div class="container mb-5">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4 fw-bold mb-3">Kapcsolat</h1>
                <p class="lead mb-5 w-md-75 mx-auto">Kérdésed van? Segítünk! Vedd fel velünk a kapcsolatot az alábbi módokon.</p>
            </div>
        </div>
    </div>

    <!-- Info cards section -->
    <div class="container mb-5">
        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center mx-auto mb-4" style="width: 80px; height: 80px;">
                            <i class="fas fa-map-marker-alt text-white fa-2x"></i>
                        </div>
                        <h5 class="card-title mb-3">Címünk</h5>
                        <p class="card-text mb-0">1134 Budapest,</p>
                        <p class="card-text">Gamer utca 42.</p>
                        <a href="https://maps.google.com" target="_blank" class="btn btn-sm btn-outline-primary mt-3">Térkép</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center mx-auto mb-4" style="width: 80px; height: 80px;">
                            <i class="fas fa-phone-alt text-white fa-2x"></i>
                        </div>
                        <h5 class="card-title mb-3">Telefonszám</h5>
                        <p class="card-text mb-0">Ügyfélszolgálat:</p>
                        <p class="card-text">+36 1 123 4567</p>
                        <p class="card-text small text-muted">H-P: 9:00-17:00</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center mx-auto mb-4" style="width: 80px; height: 80px;">
                            <i class="fas fa-envelope text-white fa-2x"></i>
                        </div>
                        <h5 class="card-title mb-3">E-mail</h5>
                        <p class="card-text mb-0">Általános:</p>
                        <p class="card-text">info@gamershop.hu</p>
                        <p class="card-text mb-0 mt-2">Ügyfélszolgálat:</p>
                        <p class="card-text">support@gamershop.hu</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center mx-auto mb-4" style="width: 80px; height: 80px;">
                            <i class="fas fa-clock text-white fa-2x"></i>
                        </div>
                        <h5 class="card-title mb-3">Nyitvatartás</h5>
                        <p class="card-text mb-1"><strong>Bemutatóterem:</strong></p>
                        <p class="card-text mb-0">Hétfő-Péntek: 10:00-18:00</p>
                        <p class="card-text mb-0">Szombat: 10:00-14:00</p>
                        <p class="card-text">Vasárnap: Zárva</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Map & Form section -->
    <div class="container mb-5">
        <div class="row g-5">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h3 class="mb-4">Hol találsz meg minket</h3>
                <div class="ratio ratio-16x9 rounded shadow-sm overflow-hidden">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2694.729801898132!2d19.0749!3d47.5173!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNDfCsDMxJzAyLjMiTiAxOcKwMDQnMjkuNiJF!5e0!3m2!1sen!2shu!4v1619789322518!5m2!1sen!2shu" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
                
                <div class="mt-4">
                    <h4 class="h5 mb-3">Megközelítés</h4>
                    <div class="d-flex mb-2">
                        <div class="flex-shrink-0 me-3">
                            <div class="bg-primary text-white rounded d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                <i class="fas fa-subway"></i>
                            </div>
                        </div>
                        <div>
                            <p class="mb-0"><strong>Metróval:</strong> M3-as metró, Árpád híd megálló, 5 perc séta</p>
                        </div>
                    </div>
                    
                    <div class="d-flex mb-2">
                        <div class="flex-shrink-0 me-3">
                            <div class="bg-primary text-white rounded d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                <i class="fas fa-bus"></i>
                            </div>
                        </div>
                        <div>
                            <p class="mb-0"><strong>Busszal:</strong> 15, 115 járatok, Gamer utca megálló</p>
                        </div>
                    </div>
                    
                    <div class="d-flex">
                        <div class="flex-shrink-0 me-3">
                            <div class="bg-primary text-white rounded d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                <i class="fas fa-car"></i>
                            </div>
                        </div>
                        <div>
                            <p class="mb-0"><strong>Autóval:</strong> Ingyenes parkolás az épület előtt</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <h3 class="mb-4">Írj nekünk</h3>
                
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                <form action="{{ route('contact.submit') }}" method="POST" class="contact-form">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Neved" value="{{ old('name') }}" required>
                                <label for="name">Neved</label>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email címed" value="{{ old('email') }}" required>
                                <label for="email">Email címed</label>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control @error('subject') is-invalid @enderror" id="subject" name="subject" placeholder="Tárgy" value="{{ old('subject') }}" required>
                                <label for="subject">Tárgy</label>
                                @error('subject')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <select class="form-select @error('topic') is-invalid @enderror" id="topic" name="topic" required>
                                    <option value="" selected disabled>Válassz témát</option>
                                    <option value="general" {{ old('topic') == 'general' ? 'selected' : '' }}>Általános kérdés</option>
                                    <option value="order" {{ old('topic') == 'order' ? 'selected' : '' }}>Rendeléssel kapcsolatos</option>
                                    <option value="product" {{ old('topic') == 'product' ? 'selected' : '' }}>Termékkel kapcsolatos</option>
                                    <option value="warranty" {{ old('topic') == 'warranty' ? 'selected' : '' }}>Garancia, szerviz</option>
                                    <option value="other" {{ old('topic') == 'other' ? 'selected' : '' }}>Egyéb</option>
                                </select>
                                <label for="topic">Téma</label>
                                @error('topic')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" placeholder="Üzeneted" style="height: 150px" required>{{ old('message') }}</textarea>
                                <label for="message">Üzeneted</label>
                                @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <div class="form-check mb-3">
                                <input class="form-check-input @error('privacy') is-invalid @enderror" type="checkbox" id="privacy" name="privacy" required {{ old('privacy') ? 'checked' : '' }}>
                                <label class="form-check-label" for="privacy">
                                    Elolvastam és elfogadom az <a href="/privacy" target="_blank">adatvédelmi tájékoztatót</a>
                                </label>
                                @error('privacy')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-lg px-5">
                                <i class="fas fa-paper-plane me-2"></i>Üzenet küldése
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- FAQ section -->
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-4">
                <h3 class="mb-3">Gyakori kérdések</h3>
                <p class="text-muted">Nézd meg a leggyakrabban feltett kérdéseket és válaszokat</p>
            </div>
            
            <div class="col-lg-10 mx-auto">
                <div class="accordion" id="contactFAQ">
                    <div class="accordion-item border mb-3 shadow-sm rounded overflow-hidden">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Mennyi idő alatt szállítjátok ki a rendeléseket?
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#contactFAQ">
                            <div class="accordion-body">
                                <p class="mb-0">A raktáron lévő termékeket általában 1-2 munkanapon belül kiszállítjuk. A futárszolgálat a csomag átvételétől számított 1-2 munkanapon belül kézbesíti a csomagot. A pontos szállítási időről a rendelés leadása után e-mailben értesítünk.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item border mb-3 shadow-sm rounded overflow-hidden">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Hogyan tudom nyomon követni a rendelésemet?
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#contactFAQ">
                            <div class="accordion-body">
                                <p class="mb-0">A rendelésed állapotát a fiókodba belépve a "Rendeléseim" menüpont alatt követheted nyomon. Emellett e-mailben is értesítünk a rendelésed állapotának változásáról, valamint a futárszolgálat is küld egy nyomkövetési linket, amikor a csomag útnak indul.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item border mb-3 shadow-sm rounded overflow-hidden">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Mi a teendő, ha hibás terméket kaptam?
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#contactFAQ">
                            <div class="accordion-body">
                                <p class="mb-0">Ha a termék hibás vagy sérült, kérjük, vedd fel velünk a kapcsolatot az info@gamershop.hu e-mail címen vagy a +36 1 123 4567 telefonszámon. A hiba jellegétől függően vagy kicseréljük a terméket, vagy javításra küldjük. Minden termékre gyártói garancia vonatkozik, amely a vásárlástól számított legalább 12 hónapig érvényes.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item border mb-3 shadow-sm rounded overflow-hidden">
                        <h2 class="accordion-header" id="headingFour">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                Hogyan tudok visszatérítést vagy cserét kérni?
                            </button>
                        </h2>
                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#contactFAQ">
                            <div class="accordion-body">
                                <p class="mb-0">A vásárlástól számított 14 napon belül indoklás nélkül visszaküldheted a terméket. A visszaküldés költségei téged terhelnek. A visszatérítés a vételár 100%-a, amit a visszaküldött termék megérkezése és állapotának ellenőrzése után utalunk vissza az eredeti fizetési módra. A csere igényét is jelezheted ügyfélszolgálatunknak.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-center mt-4">
                        <a href="/faq" class="btn btn-outline-primary px-4">
                            <i class="fas fa-question-circle me-2"></i>Összes GYIK megtekintése
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Form styling */
    .form-floating > label {
        padding-left: 1rem;
    }
    
    .form-control:focus,
    .form-select:focus {
        border-color: #0095FF;
        box-shadow: 0 0 0 0.25rem rgba(0, 149, 255, 0.25);
    }
    
    /* Card hover effects */
    .card {
        transition: transform 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-5px);
    }
    
    /* Accordion styling */
    .accordion-button:not(.collapsed) {
        background-color: rgba(0, 149, 255, 0.1);
        color: #0095FF;
    }
    
    .accordion-button:focus {
        border-color: #0095FF;
        box-shadow: 0 0 0 0.25rem rgba(0, 149, 255, 0.25);
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Form validation script
        const form = document.querySelector('.contact-form');
        
        if (form) {
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                
                form.classList.add('was-validated');
            }, false);
        }
    });
</script>
@endpush