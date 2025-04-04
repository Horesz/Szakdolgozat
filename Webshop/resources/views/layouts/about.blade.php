@extends('layouts.app')

@section('title', 'Rólunk - GamerShop')

@section('content')
<!-- Fejléc banner -->
<div class="about-hero bg-dark text-white text-center py-5">
    <div class="container">
        <h1 class="display-4 fw-bold mb-4">Rólunk</h1>
        <p class="lead mb-0">Ismerd meg a GamerShop történetét és a csapatot a játékszenvedély mögött</p>
    </div>
</div>

<!-- Fő tartalom -->
<div class="bg-light py-5">
    <div class="container">
        <!-- Történetünk -->
        <div class="row align-items-center mb-5">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="position-relative">
                    <img src="{{ asset('images/about/store.jpg') }}" alt="A GamerShop története" class="img-fluid rounded-3 shadow-lg">
                    <div class="position-absolute top-0 start-0 translate-middle bg-primary text-white p-3 rounded-3 shadow-lg d-none d-md-block">
                        <h4 class="h5 mb-0">2016 óta</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card border-0 bg-white shadow-sm p-4">
                    <h2 class="border-bottom border-primary pb-3 mb-4">Történetünk</h2>
                    <p>A GamerShop története 2016-ban kezdődött, amikor két játékszenvedéllyel megáldott barát úgy döntött, hogy létrehoz egy olyan webáruházat, ahol minden gamer megtalálja a számára legmegfelelőbb eszközöket.</p>
                    <p>Az első kis raktárból indulva mára Magyarország egyik vezető gaming e-kereskedelmi platformjává nőttük ki magunkat. Büszkék vagyunk arra, hogy több mint 50.000 elégedett vásárlót szolgáltunk ki az évek során.</p>
                    <p>Filozófiánk egyszerű: a legjobb termékeket kínáljuk, versenyképes áron, kiváló vásárlói támogatással. Hisszük, hogy a játék öröme mindenkié, és küldetésünk, hogy ezt mindenkihez eljuttassuk.</p>
                </div>
            </div>
        </div>

        <!-- Küldetésünk és Értékeink -->
        <div class="row mb-5">
            <div class="col-md-6 mb-4 mb-md-0">
                <div class="card border-0 h-100 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <span class="bg-primary p-2 rounded-circle text-white me-3">
                                <i class="fas fa-bullseye"></i>
                            </span>
                            <h3 class="h4 mb-0">Küldetésünk</h3>
                        </div>
                        <p>Küldetésünk, hogy a legjobb játékélményt biztosítsuk minden gamer számára, függetlenül attól, hogy kezdő vagy profi, PC-n, konzolon vagy mobilon játszik.</p>
                        <p>Célunk, hogy széles választékkal, szakértői tanácsadással és gyors kiszolgálással segítsük a magyar gaming közösség fejlődését.</p>
                        <p>Folyamatosan figyeljük a technológiai újdonságokat és trendeket, hogy mindig a legfrissebb és legkeresettebb termékeket kínálhassuk vásárlóinknak.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0 h-100 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <span class="bg-primary p-2 rounded-circle text-white me-3">
                                <i class="fas fa-star"></i>
                            </span>
                            <h3 class="h4 mb-0">Értékeink</h3>
                        </div>
                        <ul class="list-unstyled">
                            <li class="mb-3 d-flex">
                                <i class="fas fa-check-circle text-primary me-2 mt-1"></i>
                                <div>
                                    <strong>Minőség</strong> - Csak olyan termékeket forgalmazunk, amelyekben mi magunk is megbízunk.
                                </div>
                            </li>
                            <li class="mb-3 d-flex">
                                <i class="fas fa-check-circle text-primary me-2 mt-1"></i>
                                <div>
                                    <strong>Szakértelem</strong> - Munkatársaink maguk is gamerek, így első kézből származó tapasztalattal segítenek.
                                </div>
                            </li>
                            <li class="mb-3 d-flex">
                                <i class="fas fa-check-circle text-primary me-2 mt-1"></i>
                                <div>
                                    <strong>Közösség</strong> - Nem csak terméket adunk el, hanem közösséget építünk és támogatunk.
                                </div>
                            </li>
                            <li class="mb-3 d-flex">
                                <i class="fas fa-check-circle text-primary me-2 mt-1"></i>
                                <div>
                                    <strong>Megbízhatóság</strong> - Amit ígérünk, azt betartjuk, legyen szó szállítási időről vagy garanciáról.
                                </div>
                            </li>
                            <li class="d-flex">
                                <i class="fas fa-check-circle text-primary me-2 mt-1"></i>
                                <div>
                                    <strong>Innováció</strong> - Folyamatosan fejlesztjük szolgáltatásainkat és kínálatunkat.
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Csapatunk -->
        <h2 class="text-center mb-5">Csapatunk</h2>
        <div class="row g-4 mb-5">
            <!-- Csapattag 1 -->
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm h-100 team-card">
                    <div class="position-relative">
                        <img src="{{ asset('images/team/team1.jpg') }}" class="card-img-top" alt="Kovács István">
                        <div class="team-social">
                            <a href="#" class="btn btn-sm btn-primary rounded-circle me-1"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#" class="btn btn-sm btn-primary rounded-circle"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title mb-1">Kovács István</h5>
                        <p class="text-muted small mb-2">Alapító & CEO</p>
                        <p class="card-text small">Szenvedélyes PC-gamer, aki 15 éves e-kereskedelmi tapasztalattal rendelkezik.</p>
                    </div>
                </div>
            </div>
            
            <!-- Csapattag 2 -->
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm h-100 team-card">
                    <div class="position-relative">
                        <img src="{{ asset('images/team/team2.jpg') }}" class="card-img-top" alt="Nagy Eszter">
                        <div class="team-social">
                            <a href="#" class="btn btn-sm btn-primary rounded-circle me-1"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#" class="btn btn-sm btn-primary rounded-circle"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title mb-1">Nagy Eszter</h5>
                        <p class="text-muted small mb-2">Marketing Vezető</p>
                        <p class="card-text small">E-sport rajongó, aki a digitális marketing világában szerzett széleskörű tapasztalatot.</p>
                    </div>
                </div>
            </div>
            
            <!-- Csapattag 3 -->
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm h-100 team-card">
                    <div class="position-relative">
                        <img src="{{ asset('images/team/team3.jpg') }}" class="card-img-top" alt="Szabó Gergő">
                        <div class="team-social">
                            <a href="#" class="btn btn-sm btn-primary rounded-circle me-1"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#" class="btn btn-sm btn-primary rounded-circle"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title mb-1">Szabó Gergő</h5>
                        <p class="text-muted small mb-2">Termékfelelős</p>
                        <p class="card-text small">Konzol szakértő, aki a gaming iparban töltött 10 év alatt széleskörű terméktudást szerzett.</p>
                    </div>
                </div>
            </div>
            
            <!-- Csapattag 4 -->
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm h-100 team-card">
                    <div class="position-relative">
                        <img src="{{ asset('images/team/team4.jpg') }}" class="card-img-top" alt="Kiss Júlia">
                        <div class="team-social">
                            <a href="#" class="btn btn-sm btn-primary rounded-circle me-1"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#" class="btn btn-sm btn-primary rounded-circle"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title mb-1">Kiss Júlia</h5>
                        <p class="text-muted small mb-2">Ügyfélszolgálati Vezető</p>
                        <p class="card-text small">Mobilgamer, aki elhivatott a kiváló ügyfélélmény mellett, és mindig a legjobb megoldást keresi.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Számok -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="card border-0 shadow-lg">
                    <div class="card-body p-4">
                        <div class="row text-center">
                            <div class="col-md-3 col-6 mb-4 mb-md-0">
                                <div class="counter-item">
                                    <div class="display-4 fw-bold text-primary">7+</div>
                                    <p class="mb-0 text-muted">Év tapasztalat</p>
                                </div>
                            </div>
                            <div class="col-md-3 col-6 mb-4 mb-md-0">
                                <div class="counter-item">
                                    <div class="display-4 fw-bold text-primary">50k+</div>
                                    <p class="mb-0 text-muted">Elégedett vásárló</p>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="counter-item">
                                    <div class="display-4 fw-bold text-primary">5k+</div>
                                    <p class="mb-0 text-muted">Termék</p>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="counter-item">
                                    <div class="display-4 fw-bold text-primary">20+</div>
                                    <p class="mb-0 text-muted">Szakértő munkatárs</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Partnereink -->
        <h2 class="text-center mb-4">Partnereink</h2>
        <div class="row mb-5">
            <div class="col-12">
                <div class="card border-0 shadow-sm p-4">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-4 col-md-2 text-center mb-4 mb-md-0">
                            <img src="{{ asset('images/partners/partner1.png') }}" alt="Partner 1" class="img-fluid partner-logo">
                        </div>
                        <div class="col-4 col-md-2 text-center mb-4 mb-md-0">
                            <img src="{{ asset('images/partners/partner2.png') }}" alt="Partner 2" class="img-fluid partner-logo">
                        </div>
                        <div class="col-4 col-md-2 text-center mb-4 mb-md-0">
                            <img src="{{ asset('images/partners/partner3.png') }}" alt="Partner 3" class="img-fluid partner-logo">
                        </div>
                        <div class="col-4 col-md-2 text-center mb-4 mb-md-0">
                            <img src="{{ asset('images/partners/partner4.png') }}" alt="Partner 4" class="img-fluid partner-logo">
                        </div>
                        <div class="col-4 col-md-2 text-center mb-4 mb-md-0">
                            <img src="{{ asset('images/partners/partner5.png') }}" alt="Partner 5" class="img-fluid partner-logo">
                        </div>
                        <div class="col-4 col-md-2 text-center">
                            <img src="{{ asset('images/partners/partner6.png') }}" alt="Partner 6" class="img-fluid partner-logo">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA -->
        <div class="row">
            <div class="col-12">
                <div class="card border-0 bg-primary text-white shadow-lg p-4">
                    <div class="row align-items-center">
                        <div class="col-lg-8 mb-3 mb-lg-0">
                            <h3 class="h4 mb-2">Van kérdésed? Vedd fel velünk a kapcsolatot!</h3>
                            <p class="mb-0">Csapatunk készen áll, hogy segítsen a tökéletes gaming felszerelés kiválasztásában.</p>
                        </div>
                        <div class="col-lg-4 text-center text-lg-end">
                            <a href="{{ route('contact') }}" class="btn btn-light">
                                <i class="fas fa-envelope me-2"></i>Kapcsolatfelvétel
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    /* Rólunk oldal stílusok */
    .about-hero {
        background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('{{ asset("images/about/hero.jpg") }}') center/cover no-repeat;
        padding: 80px 0;
    }
    
    /* Csapat kártyák stílusai */
    .team-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        overflow: hidden;
    }
    
    .team-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1) !important;
    }
    
    .team-card img {
        transition: transform 0.5s ease;
        height: 250px;
        object-fit: cover;
    }
    
    .team-card:hover img {
        transform: scale(1.05);
    }
    
    .team-social {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent);
        padding: 15px;
        opacity: 0;
        transition: opacity 0.3s ease;
        display: flex;
        justify-content: center;
    }
    
    .team-card:hover .team-social {
        opacity: 1;
    }
    
    /* Partner logók */
    .partner-logo {
        max-height: 60px;
        filter: grayscale(100%);
        opacity: 0.7;
        transition: all 0.3s ease;
    }
    
    .partner-logo:hover {
        filter: grayscale(0%);
        opacity: 1;
    }
    
    /* Számláló elemek */
    .counter-item {
        position: relative;
    }
    
    .counter-item::after {
        content: '';
        position: absolute;
        right: 0;
        top: 20%;
        bottom: 20%;
        width: 1px;
        background-color: #e5e5e5;
    }
    
    .col-md-3:last-child .counter-item::after,
    .col-6:nth-child(even) .counter-item::after {
        display: none;
    }
    
    @media (max-width: 767.98px) {
        .col-6:nth-child(n+3) .counter-item::after {
            display: none;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // Opcionális: Számláló animáció
    document.addEventListener('DOMContentLoaded', function() {
        const counters = document.querySelectorAll('.counter-item .display-4');
        const speed = 200;
        
        counters.forEach(counter => {
            const animate = () => {
                const value = +counter.innerText.replace(/\D/g, '');
                const data = +counter.getAttribute('data-target');
                const time = data / speed;
                
                if (value < data) {
                    counter.innerText = Math.ceil(value + time) + '+';
                    setTimeout(animate, 1);
                } else {
                    counter.innerText = data + '+';
                }
            }
            
            // Az egyszerűség kedvéért most nem implementáljuk a scrollhoz kötött animációt,
            // csak beállítjuk a kezdőértékeket
            
            // A "7+" formátumot megtartjuk, mivel már eleve így szerepel a HTML-ben
            if (!counter.innerText.includes('+')) {
                counter.innerText = counter.innerText + '+';
            }
        });
    });
</script>
@endpush
@endsection