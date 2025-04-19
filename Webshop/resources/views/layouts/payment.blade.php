@extends('layouts.app')

@section('title', 'Fizetési módok - GamerShop')

@section('content')
<div class="payment-page py-5">
    <!-- Hero section -->
    <div class="container mb-5">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-4 fw-bold mb-3">Fizetési módok</h1>
                <p class="lead mb-4">Válaszd ki a számodra legkényelmesebb fizetési módot. Biztonságos és egyszerű fizetési lehetőségeket biztosítunk.</p>
            </div>
        </div>
    </div>

    <!-- Main content section -->
    <div class="container mb-5">
        <div class="row g-5">
            <div class="col-lg-8">
                <!-- Payment options -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-primary text-white py-3">
                        <h2 class="h4 mb-0"><i class="fas fa-credit-card me-2"></i>Fizetési lehetőségek</h2>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-4">
                            <div class="col-md-6 mb-4">
                                <div class="payment-option h-100 p-4 border rounded position-relative">
                                    <div class="position-absolute top-0 end-0 p-2">
                                        <span class="badge bg-success">Legnépszerűbb</span>
                                    </div>
                                    <div class="d-flex mb-3">
                                        <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                                            <i class="fas fa-credit-card text-white fa-2x"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-1">Bankkártyás fizetés</h5>
                                            <p class="text-muted mb-0">Online, biztonságos</p>
                                        </div>
                                    </div>
                                    <p class="mb-3">Fizess gyorsan és biztonságosan bankkártyával az interneten keresztül.</p>
                                    
                                    <div class="payment-cards mb-3">
                                        <img src="{{ asset('images/payment/visa.png') }}" alt="Visa" height="30" class="me-2">
                                        <img src="{{ asset('images/payment/mastercard.png') }}" alt="Mastercard" height="30" class="me-2">
                                        <img src="{{ asset('images/payment/maestro.png') }}" alt="Maestro" height="30">
                                    </div>
                                    
                                    <ul class="list-group list-group-flush mb-3">
                                        <li class="list-group-item border-0 ps-0 py-2 d-flex">
                                            <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                                            <span>Azonnali feldolgozás</span>
                                        </li>
                                        <li class="list-group-item border-0 ps-0 py-2 d-flex">
                                            <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                                            <span>Biztonságos SSL titkosítás</span>
                                        </li>
                                        <li class="list-group-item border-0 ps-0 py-2 d-flex">
                                            <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                                            <span>Nincs külön díj</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-4">
                                <div class="payment-option h-100 p-4 border rounded">
                                    <div class="d-flex mb-3">
                                        <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                                            <i class="fas fa-money-bill-wave text-white fa-2x"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-1">Utánvét</h5>
                                            <p class="text-muted mb-0">Fizetés átvételkor</p>
                                        </div>
                                    </div>
                                    <p class="mb-3">Fizess a csomag átvételekor készpénzben vagy bankkártyával a futárnál.</p>
                                    
                                    <div class="payment-cards mb-3">
                                        <img src="{{ asset('images/payment/cash.png') }}" alt="Készpénz" height="30" class="me-2">
                                        <img src="{{ asset('images/payment/pos.png') }}" alt="POS terminál" height="30">
                                    </div>
                                    
                                    <ul class="list-group list-group-flush mb-3">
                                        <li class="list-group-item border-0 ps-0 py-2 d-flex">
                                            <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                                            <span>Fizetés csak átvételkor</span>
                                        </li>
                                        <li class="list-group-item border-0 ps-0 py-2 d-flex">
                                            <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                                            <span>Készpénz vagy bankkártya</span>
                                        </li>
                                        <li class="list-group-item border-0 ps-0 py-2 d-flex">
                                            <i class="fas fa-info-circle text-primary me-2 mt-1"></i>
                                            <span>390 Ft utánvét kezelési díj</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-4 mb-md-0">
                                <div class="payment-option h-100 p-4 border rounded">
                                    <div class="d-flex mb-3">
                                        <img src="{{ asset('images/payment/paypal.png') }}" alt="PayPal" height="60" class="me-3">
                                        <div>
                                            <h5 class="mb-1">PayPal</h5>
                                            <p class="text-muted mb-0">Online fizetés</p>
                                        </div>
                                    </div>
                                    <p class="mb-3">Fizess biztonságosan PayPal fiókodon keresztül vagy vendégként.</p>
                                    
                                    <ul class="list-group list-group-flush mb-3">
                                        <li class="list-group-item border-0 ps-0 py-2 d-flex">
                                            <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                                            <span>Gyors és egyszerű fizetés</span>
                                        </li>
                                        <li class="list-group-item border-0 ps-0 py-2 d-flex">
                                            <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                                            <span>Vásárlói védelem</span>
                                        </li>
                                        <li class="list-group-item border-0 ps-0 py-2 d-flex">
                                            <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                                            <span>Nincs külön díj</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="payment-option h-100 p-4 border rounded">
                                    <div class="d-flex mb-3">
                                        <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                                            <i class="fas fa-university text-white fa-2x"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-1">Banki átutalás</h5>
                                            <p class="text-muted mb-0">Előre utalás</p>
                                        </div>
                                    </div>
                                    <p class="mb-3">Fizess banki átutalással közvetlenül a bankszámlánkra.</p>
                                    
                                    <ul class="list-group list-group-flush mb-3">
                                        <li class="list-group-item border-0 ps-0 py-2 d-flex">
                                            <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                                            <span>Nincs külön díj</span>
                                        </li>
                                        <li class="list-group-item border-0 ps-0 py-2 d-flex">
                                            <i class="fas fa-info-circle text-primary me-2 mt-1"></i>
                                            <span>1-3 munkanap feldolgozási idő</span>
                                        </li>
                                        <li class="list-group-item border-0 ps-0 py-2 d-flex">
                                            <i class="fas fa-info-circle text-primary me-2 mt-1"></i>
                                            <span>A termék befizetés után kerül kiszállításra</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Installment payment -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-primary text-white py-3">
                        <h2 class="h4 mb-0"><i class="fas fa-calendar-alt me-2"></i>Részletfizetési lehetőségek</h2>
                    </div>
                    <div class="card-body p-4">
                        <div class="alert alert-primary mb-4">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-info-circle fa-2x text-primary"></i>
                                </div>
                                <div class="ms-3">
                                    <h5>Kényelmes részletfizetés</h5>
                                    <p class="mb-0">50.000 Ft feletti vásárlás esetén kamatmentes részletfizetési lehetőséget biztosítunk partnereink segítségével.</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="payment-option p-4 border rounded">
                                    <div class="d-flex mb-3">
                                        <img src="{{ asset('images/payment/creditcard.png') }}" alt="Hitelkártya" height="50" class="me-3">
                                        <div>
                                            <h5 class="mb-1">Áruhitel</h5>
                                            <p class="text-muted mb-0">Minimum 50.000 Ft értéktől</p>
                                        </div>
                                    </div>
                                    
                                    <p class="mb-3">Vásárolj most, fizess később - akár 10 havi kamatmentes részletben!</p>
                                    
                                    <div class="installment-example p-3 mb-3 bg-light rounded">
                                        <h6>Példa</h6>
                                        <p class="mb-1">100.000 Ft értékű vásárlás esetén:</p>
                                        <ul class="mb-0 ps-3">
                                            <li>6 havi részlet: <strong>16.667 Ft/hó</strong></li>
                                            <li>10 havi részlet: <strong>10.000 Ft/hó</strong></li>
                                        </ul>
                                    </div>
                                    
                                    <a href="#" class="btn btn-outline-primary">
                                        <i class="fas fa-calculator me-2"></i>Részletfizetés kalkulátor
                                    </a>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="payment-option p-4 border rounded">
                                    <div class="d-flex mb-3">
                                        <img src="{{ asset('images/payment/cofidis.png') }}" alt="Cofidis" height="50" class="me-3">
                                        <div>
                                            <h5 class="mb-1">Cofidis Áruhitel</h5>
                                            <p class="text-muted mb-0">Online igényelhető</p>
                                        </div>
                                    </div>
                                    
                                    <p class="mb-3">Egyszerűen, online igényelhető Cofidis áruhitel - 24 órán belüli elbírálással.</p>
                                    
                                    <ul class="list-group list-group-flush mb-3">
                                        <li class="list-group-item border-0 ps-0 py-2 d-flex">
                                            <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                                            <span>Gyors, online ügyintézés</span>
                                        </li>
                                        <li class="list-group-item border-0 ps-0 py-2 d-flex">
                                            <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                                            <span>Fix havi részletek</span>
                                        </li>
                                        <li class="list-group-item border-0 ps-0 py-2 d-flex">
                                            <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                                            <span>Kamatmentes konstrukció elérhető</span>
                                        </li>
                                    </ul>
                                    
                                    <a href="#" class="btn btn-outline-primary">
                                        <i class="fas fa-info-circle me-2"></i>Részletek
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Payment security -->
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-primary text-white py-3">
                        <h2 class="h4 mb-0"><i class="fas fa-shield-alt me-2"></i>Fizetési biztonság</h2>
                    </div>
                    <div class="card-body p-4">
                        <div class="row align-items-center g-4">
                            <div class="col-md-6">
                                <h3 class="h5 mb-3">Biztonságos online fizetés</h3>
                                <p>A GamerShop webáruházban a kártyás fizetések a Barion Payment Zrt. biztonságos fizetési rendszerén keresztül történnek. Az online bankkártyás fizetések a Barion rendszerén keresztül valósulnak meg. A bankkártya adatok a kereskedőhöz nem jutnak el.</p>
                                
                                <h3 class="h5 mb-3 mt-4">Adatvédelem</h3>
                                <p>A fizetési folyamat során megadott adataidat bizalmasan kezeljük, azokat kizárólag a vásárlás lebonyolításához használjuk fel, és nem adjuk ki harmadik félnek. Webáruházunk az adatokat SSL titkosítással védett biztonságos csatornán keresztül továbbítja.</p>
                                
                                <div class="d-flex align-items-center mt-4">
                                    <i class="fas fa-lock fa-2x text-primary me-3"></i>
                                    <p class="mb-0">Az oldalon történő vásárlás és fizetés <strong>256-bites SSL titkosítással</strong> védett, amely biztosítja adataid biztonságát.</p>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="security-badges text-center">
                                    <div class="row g-4">
                                        <div class="col-6">
                                            <div class="security-badge p-3 border rounded">
                                                <img src="{{ asset('images/payment/ssl.png') }}" alt="SSL" height="60" class="mb-3">
                                                <h6>SSL Titkosítás</h6>
                                                <p class="small mb-0 text-muted">256-bites titkosítás a biztonságos adatátvitelért</p>
                                            </div>
                                        </div>
                                        
                                        <div class="col-6">
                                            <div class="security-badge p-3 border rounded">
                                                <img src="{{ asset('images/payment/verified.png') }}" alt="Verified by Visa" height="60" class="mb-3">
                                                <h6>3D Secure</h6>
                                                <p class="small mb-0 text-muted">Visa és Mastercard által hitelesített biztonsági rendszer</p>
                                            </div>
                                        </div>
                                        
                                        <div class="col-6">
                                            <div class="security-badge p-3 border rounded">
                                                <img src="{{ asset('images/payment/pci.png') }}" alt="PCI DSS" height="60" class="mb-3">
                                                <h6>PCI DSS</h6>
                                                <p class="small mb-0 text-muted">Megfelelünk a bankkártya társaságok biztonsági szabványainak</p>
                                            </div>
                                        </div>
                                        
                                        <div class="col-6">
                                            <div class="security-badge p-3 border rounded">
                                                <img src="{{ asset('images/payment/gdpr.png') }}" alt="GDPR" height="60" class="mb-3">
                                                <h6>GDPR</h6>
                                                <p class="small mb-0 text-muted">Adatkezelésünk megfelel az EU adatvédelmi rendeletének</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <!-- Order process -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-primary text-white py-3">
                        <h2 class="h5 mb-0"><i class="fas fa-shopping-cart me-2"></i>Rendelési folyamat</h2>
                    </div>
                    <div class="card-body p-4">
                        <div class="order-process">
                            <div class="timeline-item d-flex mb-4">
                                <div class="timeline-dot"></div>
                                <div class="timeline-content">
                                    <h6 class="mb-1">1. Termékek kiválasztása</h6>
                                    <p class="mb-0 text-muted">Válaszd ki a megvásárolni kívánt termékeket és add hozzá a kosaradhoz.</p>
                                </div>
                            </div>
                            
                            <div class="timeline-item d-flex mb-4">
                                <div class="timeline-dot"></div>
                                <div class="timeline-content">
                                    <h6 class="mb-1">2. Kosár ellenőrzése</h6>
                                    <p class="mb-0 text-muted">Ellenőrizd a kosár tartalmát, módosítsd a mennyiségeket ha szükséges.</p>
                                </div>
                            </div>
                            
                            <div class="timeline-item d-flex mb-4">
                                <div class="timeline-dot"></div>
                                <div class="timeline-content">
                                    <h6 class="mb-1">3. Szállítási és számlázási adatok</h6>
                                    <p class="mb-0 text-muted">Add meg a szállítási és számlázási adatokat, valamint válaszd ki a szállítási módot.</p>
                                </div>
                            </div>
                            
                            <div class="timeline-item d-flex mb-4">
                                <div class="timeline-dot"></div>
                                <div class="timeline-content">
                                    <h6 class="mb-1">4. Fizetési mód kiválasztása</h6>
                                    <p class="mb-0 text-muted">Válaszd ki a számodra legmegfelelőbb fizetési módot.</p>
                                </div>
                            </div>
                            
                            <div class="timeline-item d-flex">
                                <div class="timeline-dot"></div>
                                <div class="timeline-content">
                                    <h6 class="mb-1">5. Rendelés véglegesítése</h6>
                                    <p class="mb-0 text-muted">Ellenőrizd a rendelés adatait, majd erősítsd meg a rendelést.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- FAQ -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-primary text-white py-3">
                        <h2 class="h5 mb-0"><i class="fas fa-question-circle me-2"></i>Gyakori kérdések</h2>
                    </div>
                    <div class="card-body p-4">
                        <div class="accordion accordion-flush" id="faqAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="faq1">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse1" aria-expanded="false" aria-controls="faqCollapse1">
                                        Melyek a támogatott bankkártya típusok?
                                    </button>
                                </h2>
                                <div id="faqCollapse1" class="accordion-collapse collapse" aria-labelledby="faq1" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        A webáruházunkban a következő kártyatípusokkal fizethetsz: Visa, MasterCard, Maestro, American Express és Visa Electron.
                                    </div>
                                </div>
                            </div>
                            
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="faq2">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse2" aria-expanded="false" aria-controls="faqCollapse2">
                                        Biztonságos az online bankkártyás fizetés?
                                    </button>
                                </h2>
                                <div id="faqCollapse2" class="accordion-collapse collapse" aria-labelledby="faq2" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Igen, az online fizetés teljes mértékben biztonságos. A bankkártyaadatokat a Barion Payment Zrt. biztonságos, titkosított csatornán keresztül kezeli, azok nem jutnak el hozzánk. A fizetési folyamat megfelel a legmagasabb biztonsági előírásoknak (PCI DSS).
                                    </div>
                                </div>
                            </div>
                            
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="faq3">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse3" aria-expanded="false" aria-controls="faqCollapse3">
                                        Hogyan igényelhetek számlaigénylést?
                                    </button>
                                </h2>
                                <div id="faqCollapse3" class="accordion-collapse collapse" aria-labelledby="faq3" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        A rendelési folyamat során, a számlázási adatok megadásakor jelölheted, hogy magánszemélyként vagy cégként kéred a számlát. Minden rendelésről automatikusan ÁFÁ-s számlát állítunk ki, melyet a csomagban találsz meg, illetve elektronikus formában e-mailben is megküldünk.
                                    </div>
                                </div>
                            </div>
                            
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="faq4">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse4" aria-expanded="false" aria-controls="faqCollapse4">
                                        Mi történik, ha elutasítják a bankkártyás fizetést?
                                    </button>
                                </h2>
                                <div id="faqCollapse4" class="accordion-collapse collapse" aria-labelledby="faq4" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Ha a bankkártyás fizetést elutasítják, akkor a rendelésed nem kerül feldolgozásra. Erről e-mail értesítést küldünk, és lehetőséged van másik fizetési módot választani vagy újra próbálkozni a bankkártyás fizetéssel. Az elutasítás oka lehet például: fedezethiány, hibás kártyaadatok, lejárt kártya vagy a bank által blokkolt tranzakció.
                                    </div>
                                </div>
                            </div>
                            
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="faq5">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse5" aria-expanded="false" aria-controls="faqCollapse5">
                                        Mikor terhelik meg a kártyámat?
                                    </button>
                                </h2>
                                <div id="faqCollapse5" class="accordion-collapse collapse" aria-labelledby="faq5" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Online bankkártyás fizetés esetén a kártyádat azonnal megterheljük a rendelés összegével. Banki átutalás esetén a rendelésed csak akkor kerül feldolgozásra, amikor a befizetésed beérkezik a bankszámlánkra. Utánvétes fizetés esetén a rendelés értékét a csomag átvételekor kell kifizetned.
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
                
                <!-- Customer support -->
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-primary text-white py-3">
                        <h2 class="h5 mb-0"><i class="fas fa-headset me-2"></i>Segítségre van szükséged?</h2>
                    </div>
                    <div class="card-body p-4 text-center">
                        <img src="{{ asset('images/payment/support.png') }}" alt="Customer Support" class="mb-4" height="120">
                        <h5 class="mb-3">Ügyfélszolgálatunk készséggel áll rendelkezésedre</h5>
                        <p>Ha kérdésed van a fizetéssel vagy a rendeléssel kapcsolatban, vedd fel velünk a kapcsolatot!</p>
                        <div class="d-grid gap-2">
                            <a href="tel:+3611234567" class="btn btn-outline-primary">
                                <i class="fas fa-phone me-2"></i>+36 1 123 4567
                            </a>
                            <a href="mailto:info@gamershop.hu" class="btn btn-outline-primary">
                                <i class="fas fa-envelope me-2"></i>info@gamershop.hu
                            </a>
                            <a href="{{ route('contact') }}" class="btn btn-primary">
                                <i class="fas fa-comment-dots me-2"></i>Kapcsolatfelvétel
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
                <h2 class="display-5 fw-bold mb-4">Kezdj el vásárolni!</h2>
                <p class="lead mb-4">Egyszerű rendelés, könnyű és biztonságos fizetés - Válogass termékeink között most!</p>
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
    /* Payment options */
    .payment-option {
        transition: all 0.3s ease;
    }
    
    .payment-option:hover {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        border-color: #0095FF !important;
    }
    
    .security-badge {
        transition: all 0.3s ease;
    }
    
    .security-badge:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
    }
    
    /* Timeline */
    .timeline-item {
        position: relative;
        padding-left: 30px;
        padding-bottom: 20px;
    }
    
    .timeline-dot {
        position: absolute;
        left: 0;
        top: 0;
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
        left: 7px;
        top: 16px;
        bottom: 0;
        width: 2px;
        background-color: #e9ecef;
    }
    
    .timeline-item:last-child:before {
        display: none;
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
</style>
@endpush