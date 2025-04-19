@extends('layouts.app')

@section('title', 'Rólunk - GamerShop')

@section('content')
<div class="about-page py-5">
    <!-- Hero section -->
    <div class="container-fluid mb-5 about-hero">
        <div class="row">
            <div class="col-12 px-0">
                <div class="position-relative">
                    <img src="{{ asset('images/about/office.jpg') }}" alt="GamerShop Iroda" class="w-100 about-hero-img">
                    <div class="about-hero-overlay"></div>
                    <div class="container position-absolute top-50 start-50 translate-middle text-center">
                        <h1 class="display-4 fw-bold text-white mb-3">Rólunk</h1>
                        <p class="lead text-white mb-4">Mi nem csak értékesítünk, közösséget építünk</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Story section -->
    <div class="container mb-5">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="ratio ratio-16x9 rounded overflow-hidden shadow-lg">
                    <img src="{{ asset('images/about/cv_kep.png') }}" alt="Alapítók" class="img-cover">
                </div>
            </div>
            <div class="col-lg-6">
                <span class="badge bg-primary text-white mb-3">A TÖRTÉNETÜNK</span>
                <h2 class="h1 mb-4">Gamerek az első naptól kezdve</h2>
                <p class="lead mb-4">A GamerShop-ot 2016-ban alapította két szenvedélyes gamer, Nagy Bálint és Kovács Márk, akik egyetemi éveik alatt ismerkedtek meg a programozó szakon.</p>
                <p class="mb-4">Közös gaming szenvedélyük és vállalkozói szemléletük vezetett arra az elhatározásra, hogy létrehozzanak egy olyan webáruházat, amely nemcsak termékeket árul, hanem valódi értéket és közösségi élményt nyújt a magyar gamereknek.</p>
                <p>A kezdetben garázscégként induló vállalkozás ma már 25 főt foglalkoztat, és Magyarország egyik vezető gaming webáruházává nőtte ki magát. A cég székhelye Budapesten található, ahol egy modern bemutatóterem is várja az érdeklődőket, ahol ki lehet próbálni a legújabb gaming eszközöket.</p>
            </div>
        </div>
    </div>

    <!-- Values section -->
    <div class="bg-light py-5 mb-5">
        <div class="container">
            <div class="text-center mb-5">
                <span class="badge bg-primary text-white mb-3">ALAPÉRTÉKEINK</span>
                <h2 class="h1 mb-4">Ami minket megkülönböztet</h2>
                <p class="lead w-md-75 mx-auto">Az értékeink határozzák meg minden döntésünket - a termékkínálattól kezdve a vásárlói szolgáltatásokig.</p>
            </div>
            
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center mx-auto mb-4" style="width: 80px; height: 80px;">
                                <i class="fas fa-award text-white fa-2x"></i>
                            </div>
                            <h5 class="card-title mb-3">Minőség</h5>
                            <p class="card-text">Csak ellenőrzött, megbízható termékeket kínálunk, amelyek kiállják az igényes gamerek próbáját.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center mx-auto mb-4" style="width: 80px; height: 80px;">
                                <i class="fas fa-brain text-white fa-2x"></i>
                            </div>
                            <h5 class="card-title mb-3">Szakértelem</h5>
                            <p class="card-text">Minden munkatársunk szenvedélyes gamer, így személyes tapasztalatból ismerjük a termékeinket.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center mx-auto mb-4" style="width: 80px; height: 80px;">
                                <i class="fas fa-users text-white fa-2x"></i>
                            </div>
                            <h5 class="card-title mb-3">Közösség</h5>
                            <p class="card-text">Nem csak értékesítünk, hanem közösséget építünk. Rendszeresen szervezünk versenyeket és eseményeket.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center mx-auto mb-4" style="width: 80px; height: 80px;">
                                <i class="fas fa-lightbulb text-white fa-2x"></i>
                            </div>
                            <h5 class="card-title mb-3">Innováció</h5>
                            <p class="card-text">Mindig a legújabb trendeket és technológiákat követjük, hogy a lehető legjobb termékeket kínáljuk.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Team section -->
    <div class="container mb-5">
        <div class="text-center mb-5">
            <span class="badge bg-primary text-white mb-3">CSAPATUNK</span>
            <h2 class="h1 mb-4">Ismerd meg a vezetőséget</h2>
            <p class="lead w-md-75 mx-auto">Tapasztalt szakemberek csapata, akik mind megosztják a gaming iránti szenvedélyt.</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="card team-card border-0 shadow-sm h-100">
                    <div class="position-relative">
                        <img src="{{ asset('images/about/Balint.png') }}" class="card-img-top team-img" alt="Nagy Bálint">
                        <div class="team-social position-absolute bottom-0 end-0 p-3">
                            <a href="#" class="btn btn-sm btn-primary rounded-circle me-1"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#" class="btn btn-sm btn-primary rounded-circle"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <h5 class="card-title mb-1">Nagy Bálint</h5>
                        <p class="text-muted small mb-3">Alapító, Ügyvezető</p>
                        <p class="card-text">Szenvedélyes e-sport rajongó, különösen az FPS játékok világában. Felelős a vállalati stratégiáért és a beszállítói kapcsolatokért.</p>
                        <p class="fst-italic mt-3">"Célunk, hogy minden magyar gamer számára elérhetővé tegyük a legmodernebb technológiát."</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-3">
                <div class="card team-card border-0 shadow-sm h-100">
                    <div class="position-relative">
                        <img src="{{ asset('images/about/mark.png') }}" class="card-img-top team-img" alt="Kovács Márk">
                        <div class="team-social position-absolute bottom-0 end-0 p-3">
                            <a href="#" class="btn btn-sm btn-primary rounded-circle me-1"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#" class="btn btn-sm btn-primary rounded-circle"><i class="fab fa-github"></i></a>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <h5 class="card-title mb-1">Kovács Márk</h5>
                        <p class="text-muted small mb-3">Alapító, Technológiai Igazgató</p>
                        <p class="card-text">A MOBA játékok szakértője. Napi szinten foglalkozik a webshop fejlesztésével és az IT infrastruktúra menedzselésével.</p>
                        <p class="fst-italic mt-3">"A technológia mögött emberek vannak – mi ezt soha nem felejtjük el."</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-3">
                <div class="card team-card border-0 shadow-sm h-100">
                    <div class="position-relative">
                        <img src="{{ asset('images/about/eszter.png') }}" class="card-img-top team-img" alt="Horváth Eszter">
                        <div class="team-social position-absolute bottom-0 end-0 p-3">
                            <a href="#" class="btn btn-sm btn-primary rounded-circle me-1"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#" class="btn btn-sm btn-primary rounded-circle"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <h5 class="card-title mb-1">Horváth Eszter</h5>
                        <p class="text-muted small mb-3">Marketing Igazgató</p>
                        <p class="card-text">A játékipar és online marketing szakértője. Vezeti a marketing osztályt, a márkaépítéstől a kampányok menedzseléséig.</p>
                        <p class="fst-italic mt-3">"A jó gaming élmény megosztott élmény. Közösséget építünk, nem csak vásárlókat szerzünk."</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-3">
                <div class="card team-card border-0 shadow-sm h-100">
                    <div class="position-relative">
                        <img src="{{ asset('images/about/david.png') }}" class="card-img-top team-img" alt="Tóth Dávid">
                        <div class="team-social position-absolute bottom-0 end-0 p-3">
                            <a href="#" class="btn btn-sm btn-primary rounded-circle me-1"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#" class="btn btn-sm btn-primary rounded-circle"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <h5 class="card-title mb-1">Tóth Dávid</h5>
                        <p class="text-muted small mb-3">Pénzügyi Igazgató</p>
                        <p class="card-text">Stratégiai játékos, Civilization és Total War sorozat rajongója. A vállalat pénzügyi stabilitásáért és növekedéséért felel.</p>
                        <p class="fst-italic mt-3">"A fenntartható növekedés a célunk, hogy hosszú távon szolgálhassuk a magyar gamer közösséget."</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Engagement section -->
    <div class="bg-light py-5 mb-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <span class="badge bg-primary text-white mb-3">KÖZÖSSÉGI SZEREPVÁLLALÁS</span>
                    <h2 class="h1 mb-4">Visszaadunk a közösségnek</h2>
                    <p class="lead mb-4">A GamerShop nem csak webáruházként működik, hanem aktívan részt vesz a magyar gaming közösség életében.</p>
                    
                    <div class="d-flex mb-3">
                        <div class="flex-shrink-0">
                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                <i class="fas fa-trophy text-white"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5>Versenyek</h5>
                            <p class="mb-0">Havonta szervezünk gaming versenyeket amatőr csapatok számára</p>
                        </div>
                    </div>
                    
                    <div class="d-flex mb-3">
                        <div class="flex-shrink-0">
                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                <i class="fas fa-headset text-white"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5>E-sport támogatás</h5>
                            <p class="mb-0">Támogatjuk a hazai e-sport csapatokat felszereléssel és anyagi hozzájárulással</p>
                        </div>
                    </div>
                    
                    <div class="d-flex mb-3">
                        <div class="flex-shrink-0">
                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                <i class="fas fa-graduation-cap text-white"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5>Ösztöndíjprogram</h5>
                            <p class="mb-0">Gaming ösztöndíjprogramot működtetünk tehetséges fiatal gamerek számára</p>
                        </div>
                    </div>
                    
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                <i class="fas fa-hospital text-white"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5>Adománygyűjtés</h5>
                            <p class="mb-0">Éves adománygyűjtést szervezünk gyermekkórházak számára gaming felszerelések beszerzésére</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="ratio ratio-16x9 rounded overflow-hidden shadow-lg">
                        <img src="{{ asset('images/about/esemeny.png') }}" alt="Közösségi esemény" class="img-cover">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA section -->
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card border-0 bg-primary text-white shadow-lg p-4 p-md-5">
                    <div class="card-body text-center">
                        <h2 class="display-5 fw-bold mb-4">Csatlakozz a GamerShop közösséghez!</h2>
                        <p class="lead mb-4">Kövesd a közösségi média profiljainkat a legfrissebb hírekért, eseményekért és exkluzív ajánlatokért.</p>
                        <div class="social-links mb-4">
                            <a href="#" class="btn btn-lg btn-outline-light rounded-circle mx-2"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="btn btn-lg btn-outline-light rounded-circle mx-2"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="btn btn-lg btn-outline-light rounded-circle mx-2"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="btn btn-lg btn-outline-light rounded-circle mx-2"><i class="fab fa-youtube"></i></a>
                            <a href="#" class="btn btn-lg btn-outline-light rounded-circle mx-2"><i class="fab fa-discord"></i></a>
                        </div>
                        <a href="/contact" class="btn btn-light btn-lg px-5">Lépj kapcsolatba velünk</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Hero section */
    .about-hero-img {
        height: 500px;
        object-fit: cover;
        object-position: center;
    }
    
    .about-hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(rgba(18, 24, 54, 0.7), rgba(18, 24, 54, 0.9));
    }
    
    /* Team cards */
    .team-img {
        height: 280px;
        object-fit: cover;
        transition: all 0.3s ease;
    }
    
    .team-card:hover .team-img {
        transform: scale(1.05);
    }
    
    .team-social {
        opacity: 0;
        transition: all 0.3s ease;
    }
    
    .team-card:hover .team-social {
        opacity: 1;
    }
    
    /* Util */
    .img-cover {
        object-fit: cover;
        width: 100%;
        height: 100%;
    }
    
    /* Animation */
    .card {
        transition: transform 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-5px);
    }
</style>
@endpush