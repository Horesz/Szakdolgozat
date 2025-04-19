@extends('layouts.app')

@section('title', 'Szállítási információk - GamerShop')

@section('content')
<div class="shipping-page py-5">
    <!-- Hero section -->
    <div class="container mb-5">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-4 fw-bold mb-3">Szállítási információk</h1>
                <p class="lead mb-4">Mindent megteszünk, hogy rendelésed a lehető leggyorsabban és legbiztonságosabban eljusson hozzád.</p>
            </div>
        </div>
    </div>

    <!-- Main content section -->
    <div class="container mb-5">
        <div class="row g-5">
            <div class="col-lg-8">
                <!-- Shipping options -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-primary text-white py-3">
                        <h2 class="h4 mb-0"><i class="fas fa-truck-loading me-2"></i>Szállítási lehetőségek</h2>
                    </div>
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="shipping-option h-100 p-4 border rounded position-relative">
                                    <div class="position-absolute top-0 end-0 p-2">
                                        <span class="badge bg-success">Legnépszerűbb</span>
                                    </div>
                                    <div class="d-flex mb-3">
                                        <img src="{{ asset('images/shipping/gls.png') }}" alt="GLS Futárszolgálat" width="60" class="me-3">
                                        <div>
                                            <h5 class="mb-1">GLS Futárszolgálat</h5>
                                            <p class="text-muted mb-0">Házhozszállítás</p>
                                        </div>
                                    </div>
                                    <ul class="list-group list-group-flush mb-3">
                                        <li class="list-group-item border-0 ps-0 py-2 d-flex">
                                            <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                                            <span>Kiszállítás 1-2 munkanapon belül</span>
                                        </li>
                                        <li class="list-group-item border-0 ps-0 py-2 d-flex">
                                            <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                                            <span>SMS értesítés a kiszállítás előtt</span>
                                        </li>
                                        <li class="list-group-item border-0 ps-0 py-2 d-flex">
                                            <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                                            <span>Online nyomkövetés</span>
                                        </li>
                                    </ul>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="fw-bold">1.490 Ft</span>
                                        <small class="text-success">Ingyenes 25.000 Ft felett</small>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-4">
                                <div class="shipping-option h-100 p-4 border rounded">
                                    <div class="d-flex mb-3">
                                        <img src="{{ asset('images/shipping/foxpost.png') }}" alt="Foxpost" width="60" class="me-3">
                                        <div>
                                            <h5 class="mb-1">Foxpost</h5>
                                            <p class="text-muted mb-0">Csomagautomata</p>
                                        </div>
                                    </div>
                                    <ul class="list-group list-group-flush mb-3">
                                        <li class="list-group-item border-0 ps-0 py-2 d-flex">
                                            <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                                            <span>Kiszállítás 1-3 munkanapon belül</span>
                                        </li>
                                        <li class="list-group-item border-0 ps-0 py-2 d-flex">
                                            <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                                            <span>SMS kód az átvételhez</span>
                                        </li>
                                        <li class="list-group-item border-0 ps-0 py-2 d-flex">
                                            <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                                            <span>Rugalmas átvétel 0-24</span>
                                        </li>
                                    </ul>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="fw-bold">1.190 Ft</span>
                                        <small class="text-success">Ingyenes 20.000 Ft felett</small>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-4 mb-md-0">
                                <div class="shipping-option h-100 p-4 border rounded">
                                    <div class="d-flex mb-3">
                                        <img src="{{ asset('images/shipping/posta.png') }}" alt="Magyar Posta" width="60" class="me-3">
                                        <div>
                                            <h5 class="mb-1">Magyar Posta</h5>
                                            <p class="text-muted mb-0">PostaPont</p>
                                        </div>
                                    </div>
                                    <ul class="list-group list-group-flush mb-3">
                                        <li class="list-group-item border-0 ps-0 py-2 d-flex">
                                            <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                                            <span>Kiszállítás 2-4 munkanapon belül</span>
                                        </li>
                                        <li class="list-group-item border-0 ps-0 py-2 d-flex">
                                            <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                                            <span>SMS értesítés az érkezésről</span>
                                        </li>
                                        <li class="list-group-item border-0 ps-0 py-2 d-flex">
                                            <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                                            <span>Több mint 3000 átvételi pont</span>
                                        </li>
                                    </ul>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="fw-bold">1.290 Ft</span>
                                        <small class="text-success">Ingyenes 20.000 Ft felett</small>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="shipping-option h-100 p-4 border rounded">
                                    <div class="d-flex mb-3">
                                        <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                                            <i class="fas fa-store text-white fa-2x"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-1">Személyes átvétel</h5>
                                            <p class="text-muted mb-0">Budapesti bemutatótermünkben</p>
                                        </div>
                                    </div>
                                    <ul class="list-group list-group-flush mb-3">
                                        <li class="list-group-item border-0 ps-0 py-2 d-flex">
                                            <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                                            <span>Kiszállítási díj nélkül</span>
                                        </li>
                                        <li class="list-group-item border-0 ps-0 py-2 d-flex">
                                            <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                                            <span>E-mail értesítés, ha átvehető</span>
                                        </li>
                                        <li class="list-group-item border-0 ps-0 py-2 d-flex">
                                            <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                                            <span>Termék ellenőrzése átvételkor</span>
                                        </li>
                                    </ul>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="fw-bold">Ingyenes</span>
                                        <small class="text-muted">Nyitva: H-P 10:00-18:00</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Shipping process -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-primary text-white py-3">
                        <h2 class="h4 mb-0"><i class="fas fa-shipping-fast me-2"></i>Szállítási folyamat</h2>
                    </div>
                    <div class="card-body p-4">
                        <div class="shipping-process">
                            <div class="row g-0">
                                <div class="col-md-3 col-6 text-center position-relative">
                                    <div class="process-step active">
                                        <div class="step-icon">
                                            <i class="fas fa-shopping-cart"></i>
                                        </div>
                                        <h6 class="step-title mt-3">Rendelés</h6>
                                        <p class="small text-muted px-2">Leadod rendelésedet online</p>
                                    </div>
                                    <div class="connector"></div>
                                </div>
                                
                                <div class="col-md-3 col-6 text-center position-relative">
                                    <div class="process-step">
                                        <div class="step-icon">
                                            <i class="fas fa-clipboard-check"></i>
                                        </div>
                                        <h6 class="step-title mt-3">Feldolgozás</h6>
                                        <p class="small text-muted px-2">Ellenőrizzük és összeállítjuk</p>
                                    </div>
                                    <div class="connector"></div>
                                </div>
                                
                                <div class="col-md-3 col-6 text-center position-relative">
                                    <div class="process-step">
                                        <div class="step-icon">
                                            <i class="fas fa-box"></i>
                                        </div>
                                        <h6 class="step-title mt-3">Csomagolás</h6>
                                        <p class="small text-muted px-2">Biztonságosan csomagoljuk</p>
                                    </div>
                                    <div class="connector"></div>
                                </div>
                                
                                <div class="col-md-3 col-6 text-center">
                                    <div class="process-step">
                                        <div class="step-icon">
                                            <i class="fas fa-truck"></i>
                                        </div>
                                        <h6 class="step-title mt-3">Kiszállítás</h6>
                                        <p class="small text-muted px-2">Eljuttatjuk a megadott címre</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="shipping-timeline mt-5">
                                <h5 class="mb-4">Szállítási idők</h5>
                                
                                <div class="timeline-item d-flex mb-3">
                                    <div class="timeline-dot"></div>
                                    <div class="timeline-content">
                                        <h6 class="mb-1">Rendelés feldolgozása</h6>
                                        <p class="mb-0 text-muted">Az online leadott rendeléseket 24 órán belül feldolgozzuk munkanapokon. A hétvégén leadott rendeléseket hétfőn dolgozzuk fel.</p>
                                    </div>
                                </div>
                                
                                <div class="timeline-item d-flex mb-3">
                                    <div class="timeline-dot"></div>
                                    <div class="timeline-content">
                                        <h6 class="mb-1">Raktáron lévő termékek</h6>
                                        <p class="mb-0 text-muted">A raktáron lévő termékek esetében a rendelés feldolgozása után 1 munkanapon belül átadjuk a csomagot a futárszolgálatnak.</p>
                                    </div>
                                </div>
                                
                                <div class="timeline-item d-flex mb-3">
                                    <div class="timeline-dot"></div>
                                    <div class="timeline-content">
                                        <h6 class="mb-1">Előrendelés és nem raktárkészleten lévő termékek</h6>
                                        <p class="mb-0 text-muted">Az előrendelések és nem raktárkészleten lévő termékek esetében e-mailben értesítünk a várható szállítási időről. Általában 3-10 munkanap a beszerzési idő.</p>
                                    </div>
                                </div>
                                
                                <div class="timeline-item d-flex">
                                    <div class="timeline-dot"></div>
                                    <div class="timeline-content">
                                        <h6 class="mb-1">Kiszállítás</h6>
                                        <p class="mb-0 text-muted">A futárszolgálat a csomag átvételétől számított 1-2 munkanapon belül kézbesíti a rendelést. A csomagautomatába vagy PostaPontra történő szállítás is általában 1-2 munkanapot vesz igénybe.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Shipping policy -->
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-primary text-white py-3">
                        <h2 class="h4 mb-0"><i class="fas fa-file-contract me-2"></i>Szállítási szabályzat</h2>
                    </div>
                    <div class="card-body p-4">
                        <div class="accordion" id="shippingAccordion">
                            <div class="accordion-item border mb-3 rounded overflow-hidden">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Ingyenes szállítás feltételei
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#shippingAccordion">
                                    <div class="accordion-body">
                                        <p>A GamerShop ingyenes szállítást biztosít meghatározott rendelési érték felett:</p>
                                        <ul>
                                            <li>GLS futárszolgálattal történő kézbesítés esetén 25.000 Ft feletti rendelésnél</li>
                                            <li>Foxpost csomagautomatába történő kézbesítés esetén 20.000 Ft feletti rendelésnél</li>
                                            <li>Magyar Posta PostaPontra történő kézbesítés esetén 20.000 Ft feletti rendelésnél</li>
                                        </ul>
                                        <p class="mb-0">Az ingyenes szállítás csak Magyarország területén belüli kézbesítésre vonatkozik. A rendelési értékbe a termékek vételára számít bele, a szállítási díj és egyéb szolgáltatások díja nem.</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="accordion-item border mb-3 rounded overflow-hidden">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Utánvétes fizetés
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#shippingAccordion">
                                    <div class="accordion-body">
                                        <p>Az utánvétes fizetés minden szállítási mód esetén elérhető. Az utánvét kezelési díja 390 Ft, amely a szállítási díjon felül fizetendő. Az utánvétes fizetés során a csomag átvételekor a futárnak, vagy az átvételi ponton kell kifizetni a rendelés teljes összegét.</p>
                                        <p class="mb-0">Az utánvét készpénzben vagy bankkártyával is kifizethető a legtöbb esetben, de ez függ a választott szállítási módtól és a futárszolgálat feltételeitől.</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="accordion-item border mb-3 rounded overflow-hidden">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Sérült csomagok és reklamáció
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#shippingAccordion">
                                    <div class="accordion-body">
                                        <p>A csomag átvételekor kérjük, ellenőrizze a küldemény sértetlenségét a futár vagy az átvételi pont munkatársa jelenlétében. Ha a csomagolás sérült, kérjük, vetessen fel jegyzőkönyvet, és ne vegye át a terméket.</p>
                                        <p>Ha a csomag átvétele után észleli, hogy a termék sérült vagy hibás, 48 órán belül jelezze ügyfélszolgálatunknak a következő elérhetőségeken:</p>
                                        <ul>
                                            <li>E-mail: support@gamershop.hu</li>
                                            <li>Telefon: +36 1 123 4567</li>
                                        </ul>
                                        <p class="mb-0">A reklamáció kivizsgálása érdekében kérjük, készítsen fényképeket a sérült termékről és a csomagolásról, valamint őrizze meg a csomagolást és a szállítási dokumentumokat.</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="accordion-item border rounded overflow-hidden">
                                <h2 class="accordion-header" id="headingFour">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                        Nemzetközi szállítás
                                    </button>
                                </h2>
                                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#shippingAccordion">
                                    <div class="accordion-body">
                                        <p>A GamerShop jelenleg Magyarország egész területére, valamint korlátozott számú EU tagállamba szállít:</p>
                                        <ul>
                                            <li>Szlovákia, Románia, Ausztria, Horvátország, Szlovénia: 3-5 munkanap, 3.990 Ft-tól</li>
                                            <li>Egyéb EU országok: 5-7 munkanap, 5.990 Ft-tól</li>
                                        </ul>
                                        <p>A nemzetközi szállítás esetén a szállítási díj a csomag méretétől és súlyától függően változik. A pontos szállítási díjat a rendelési folyamat során, a szállítási cím megadása után kalkuláljuk ki.</p>
                                        <p class="mb-0">Nemzetközi rendelés esetén az ingyenes szállítás nem érvényesíthető, és bizonyos termékek (pl. nagy méretű termékek, monitoriok) nem rendelhetők külföldre.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <!-- Customer support -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-primary text-white py-3">
                        <h2 class="h5 mb-0"><i class="fas fa-headset me-2"></i>Ügyfélszolgálat</h2>
                    </div>
                    <div class="card-body p-4">
                        <p>Kérdésed van a szállítással kapcsolatban? Vedd fel velünk a kapcsolatot!</p>
                        
                        <div class="d-flex mb-3">
                            <div class="flex-shrink-0">
                                <i class="fas fa-phone-alt text-primary fa-fw fa-lg"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="mb-1">Telefonos ügyfélszolgálat</h6>
                                <p class="mb-0">+36 1 123 4567</p>
                                <p class="small text-muted mb-0">Hétfő-Péntek: 9:00-17:00</p>
                            </div>
                        </div>
                        
                        <div class="d-flex mb-3">
                            <div class="flex-shrink-0">
                                <i class="fas fa-envelope text-primary fa-fw fa-lg"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="mb-1">E-mail</h6>
                                <p class="mb-0">info@gamershop.hu</p>
                                <p class="small text-muted mb-0">Válaszidő: 24 órán belül</p>
                            </div>
                        </div>
                        
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-comment-dots text-primary fa-fw fa-lg"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="mb-1">Live chat</h6>
                                <p class="mb-0">Elérhető az oldal jobb alsó sarkában</p>
                                <p class="small text-muted mb-0">Hétfő-Péntek: 9:00-17:00</p>
                            </div>
                        </div>
                        
                        <div class="text-center mt-4">
                            <a href="{{ route('contact') }}" class="btn btn-primary px-4">
                                <i class="fas fa-paper-plane me-2"></i>Kapcsolatfelvétel
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Tracking -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-primary text-white py-3">
                        <h2 class="h5 mb-0"><i class="fas fa-search-location me-2"></i>Csomagkövetés</h2>
                    </div>
                    <div class="card-body p-4">
                        <p>Kövesd nyomon a már feladott csomagod állapotát a futárszolgálatok oldalán:</p>
                        
                        <form action="#" class="mb-4">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Csomagszám" aria-label="Csomagszám">
                                <button class="btn btn-primary" type="button">Keresés</button>
                            </div>
                            <div class="form-text">Add meg a csomagszámot, amit e-mailben kaptál.</div>
                        </form>
                        
                        <div class="list-group">
                            <a href="https://gls-group.eu/HU/hu/csomagkovetes" target="_blank" class="list-group-item list-group-item-action d-flex align-items-center">
                                <img src="{{ asset('images/shipping/gls.png') }}" alt="GLS" width="40" class="me-3">
                                <span>GLS csomagkövetés</span>
                                <i class="fas fa-external-link-alt ms-auto"></i>
                            </a>
                            <a href="https://www.foxpost.hu/csomagkovetes" target="_blank" class="list-group-item list-group-item-action d-flex align-items-center">
                                <img src="{{ asset('images/shipping/foxpost.png') }}" alt="Foxpost" width="40" class="me-3">
                                <span>Foxpost csomagkövetés</span>
                                <i class="fas fa-external-link-alt ms-auto"></i>
                            </a>
                            <a href="https://www.posta.hu/nyomkovetes/nyitooldal" target="_blank" class="list-group-item list-group-item-action d-flex align-items-center">
                                <img src="{{ asset('images/shipping/posta.png') }}" alt="Magyar Posta" width="40" class="me-3">
                                <span>Magyar Posta nyomkövetés</span>
                                <i class="fas fa-external-link-alt ms-auto"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- FAQ -->
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-primary text-white py-3">
                        <h2 class="h5 mb-0"><i class="fas fa-question-circle me-2"></i>Gyakori kérdések</h2>
                    </div>
                    <div class="card-body p-4">
                        <div class="accordion accordion-flush" id="faqAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="faq1">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse1" aria-expanded="false" aria-controls="faqCollapse1">
                                        Mennyi idő alatt érkezik meg a rendelésem?
                                    </button>
                                </h2>
                                <div id="faqCollapse1" class="accordion-collapse collapse" aria-labelledby="faq1" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        A raktáron lévő termékeket 1-2 munkanapon belül feladjuk, és a futárszolgálat általában további 1-2 munkanapon belül kézbesíti. Tehát a rendelés leadásától számítva 2-4 munkanapon belül megérkezik a csomag.
                                    </div>
                                </div>
                            </div>
                            
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="faq2">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse2" aria-expanded="false" aria-controls="faqCollapse2">
                                        Hogyan tudom módosítani a szállítási címet?
                                    </button>
                                </h2>
                                <div id="faqCollapse2" class="accordion-collapse collapse" aria-labelledby="faq2" data-bs-parent="#faqAccordion">
                                <div id="faqCollapse2" class="accordion-collapse collapse" aria-labelledby="faq2" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        A szállítási cím módosítását a rendelés feldolgozásának megkezdése előtt teheti meg. Jelentkezzen be a fiókjába, keresse meg a rendelést a "Rendeléseim" oldalon, és kattintson a "Cím módosítása" gombra. Ha a rendelés már feldolgozás alatt van, vegye fel a kapcsolatot ügyfélszolgálatunkkal a +36 1 123 4567 telefonszámon.
                                    </div>
                                </div>
                            </div>
                            
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="faq3">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse3" aria-expanded="false" aria-controls="faqCollapse3">
                                        Mi történik, ha nem vagyok otthon a kézbesítéskor?
                                    </button>
                                </h2>
                                <div id="faqCollapse3" class="accordion-collapse collapse" aria-labelledby="faq3" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Ha nem tartózkodik otthon a kézbesítés időpontjában, a futár értesítőt hagy, és általában még egy kézbesítési kísérletet tesz a következő munkanapon. A legtöbb futárszolgálat lehetőséget biztosít arra, hogy egyeztessen egy új kézbesítési időpontot, vagy kérheti a csomag átirányítását egy átvételi pontra.
                                    </div>
                                </div>
                            </div>
                            
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="faq4">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse4" aria-expanded="false" aria-controls="faqCollapse4">
                                        Milyen állapotban kell visszaküldeni egy terméket?
                                    </button>
                                </h2>
                                <div id="faqCollapse4" class="accordion-collapse collapse" aria-labelledby="faq4" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        A termék visszaküldésekor ügyeljen arra, hogy az eredeti csomagolásban, minden tartozékkal együtt küldje vissza. A terméknek sértetlennek és használati nyomoktól mentesnek kell lennie. Javasoljuk, hogy a visszaküldés előtt vegye fel a kapcsolatot ügyfélszolgálatunkkal a visszaküldés részleteinek egyeztetése céljából.
                                    </div>
                                </div>
                            </div>
                            
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="faq5">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse5" aria-expanded="false" aria-controls="faqCollapse5">
                                        Szállítanak külföldre is?
                                    </button>
                                </h2>
                                <div id="faqCollapse5" class="accordion-collapse collapse" aria-labelledby="faq5" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Igen, szállítunk külföldre is, elsősorban az Európai Unió országaiba. A nemzetközi szállítás díja a célországtól és a csomag súlyától/méretétől függ. A pontos szállítási díjat a rendelési folyamat során, a szállítási cím megadása után kalkuláljuk ki.
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="text-center mt-4">
                            <a href="{{ route('faq') }}" class="btn btn-outline-primary">
                                <i class="fas fa-question-circle me-2"></i>További GYIK
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- CTA section -->
    <div class="container">
        <div class="card border-0 bg-primary text-white shadow-lg p-4 p-md-5">
            <div class="card-body text-center">
                <h2 class="display-5 fw-bold mb-4">Böngéssz termékeink között!</h2>
                <p class="lead mb-4">Hatalmas választék, gyors és megbízható kiszállítás - Kezdj el vásárolni még ma!</p>
                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                    <a href="{{ route('products.browse') }}" class="btn btn-light btn-lg px-4 gap-3">
                        <i class="fas fa-shopping-bag me-2"></i>Termékek böngészése
                    </a>
                    <a href="{{ route('deals') }}" class="btn btn-outline-light btn-lg px-4">
                        <i class="fas fa-percentage me-2"></i>Akciós termékek
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Process steps */
    .process-step {
        position: relative;
        padding: 20px 10px;
    }
    
    .step-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background-color: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        font-size: 30px;
        color: #6c757d;
        border: 2px solid #e9ecef;
        transition: all 0.3s ease;
    }
    
    .process-step.active .step-icon {
        background-color: #0095FF;
        color: white;
        border-color: #0095FF;
    }
    
    .connector {
        position: absolute;
        top: 60px;
        right: 0;
        width: 50%;
        height: 2px;
        background-color: #e9ecef;
    }
    
    .col-md-3:first-child .connector {
        left: 50%;
        width: 50%;
    }
    
    .col-md-3:last-child .connector {
        display: none;
    }
    
    /* Timeline */
    .shipping-timeline {
        position: relative;
        padding-left: 30px;
    }
    
    .timeline-item {
        position: relative;
        padding-bottom: 20px;
    }
    
    .timeline-dot {
        position: absolute;
        left: -30px;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background-color: #0095FF;
        border: 3px solid white;
        box-shadow: 0 0 0 2px #0095FF;
    }
    
    .timeline-item:before {
        content: '';
        position: absolute;
        left: -23px;
        top: 16px;
        bottom: 0;
        width: 2px;
        background-color: #e9ecef;
    }
    
    .timeline-item:last-child:before {
        display: none;
    }
    
    /* Shipping option */
    .shipping-option {
        transition: all 0.3s ease;
    }
    
    .shipping-option:hover {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        border-color: #0095FF !important;
    }
    
    /* Accordion */
    .accordion-button:not(.collapsed) {
        background-color: rgba(0, 149, 255, 0.1);
        color: #0095FF;
    }
    
    .accordion-button:focus {
        border-color: #0095FF;
        box-shadow: 0 0 0 0.25rem rgba(0, 149, 255, 0.25);
    }
    
    /* Cards */
    .card {
        transition: transform 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-5px);
    }
    
    /* Responsive */
    @media (max-width: 767.98px) {
        .connector {
            display: none;
        }
        
        .process-step {
            margin-bottom: 30px;
        }
    }
</style>
@endpush