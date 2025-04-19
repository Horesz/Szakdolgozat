@extends('layouts.app')

@section('title', 'Gyakran Ismételt Kérdések - GamerShop')

@section('content')
<div class="faq-page py-5">
    <!-- Hero section -->
    <div class="container mb-5">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-4 fw-bold mb-3">Gyakran Ismételt Kérdések</h1>
                <p class="lead mb-4">Válaszokat találsz a GamerShop-pal kapcsolatos leggyakoribb kérdésekre. Ha nem találod amit keresel, írj nekünk bátran!</p>
                
                <div class="mt-4">
                    <form action="#" class="faq-search">
                        <div class="input-group input-group-lg">
                            <input type="text" class="form-control" placeholder="Miben segíthetünk?" id="faqSearch">
                            <button class="btn btn-primary px-4" type="button">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="container mb-5">
        <div class="row g-5">
            <div class="col-lg-3">
                <!-- FAQ Categories -->
                <div class="card border-0 shadow-sm mb-4 sticky-lg-top" style="top: 2rem; z-index: 999;">
                    <div class="card-header bg-primary text-white py-3">
                        <h2 class="h5 mb-0"><i class="fas fa-list me-2"></i>Kategóriák</h2>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush" id="faq-categories">
                            <a href="#ordering" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center active">
                                <span><i class="fas fa-shopping-cart fa-fw me-2"></i>Rendelés</span>
                                <span class="badge bg-primary rounded-pill">6</span>
                            </a>
                            <a href="#payment" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-credit-card fa-fw me-2"></i>Fizetés</span>
                                <span class="badge bg-primary rounded-pill">5</span>
                            </a>
                            <a href="#shipping" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-truck fa-fw me-2"></i>Szállítás</span>
                                <span class="badge bg-primary rounded-pill">6</span>
                            </a>
                            <a href="#returns" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-exchange-alt fa-fw me-2"></i>Visszaküldés, garancia</span>
                                <span class="badge bg-primary rounded-pill">4</span>
                            </a>
                            <a href="#account" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-user fa-fw me-2"></i>Fiókok kezelése</span>
                                <span class="badge bg-primary rounded-pill">4</span>
                            </a>
                            <a href="#products" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-box fa-fw me-2"></i>Termékek</span>
                                <span class="badge bg-primary rounded-pill">5</span>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Contact box -->
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4 text-center">
                        <div class="mb-3">
                            <i class="fas fa-headset fa-3x text-primary"></i>
                        </div>
                        <h5 class="card-title mb-3">Nem találtad amit kerestél?</h5>
                        <p class="card-text mb-3">Ügyfélszolgálatunk készséggel áll rendelkezésedre minden kérdésben!</p>
                        <div class="d-grid gap-2">
                            <a href="{{ route('contact') }}" class="btn btn-primary">
                                <i class="fas fa-envelope me-2"></i>Írd meg kérdésed
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-9">
                <!-- Ordering FAQs -->
                <section id="ordering" class="mb-5">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-primary text-white py-3">
                            <h2 class="h4 mb-0"><i class="fas fa-shopping-cart me-2"></i>Rendeléssel kapcsolatos kérdések</h2>
                        </div>
                        <div class="card-body p-4">
                            <div class="accordion" id="accordionOrdering">
                                <div class="accordion-item border mb-3 rounded overflow-hidden">
                                    <h3 class="accordion-header" id="headingOrdering1">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOrdering1" aria-expanded="true" aria-controls="collapseOrdering1">
                                            Hogyan tudok rendelést leadni a webáruházban?
                                        </button>
                                    </h3>
                                    <div id="collapseOrdering1" class="accordion-collapse collapse show" aria-labelledby="headingOrdering1" data-bs-parent="#accordionOrdering">
                                        <div class="accordion-body">
                                            <p>Rendelés leadása a következő lépésekben történik:</p>
                                            <ol>
                                                <li>Böngéssz termékeink között és add hozzá a kosárhoz, amit szeretnél megvásárolni</li>
                                                <li>Kattints a jobb felső sarokban található kosár ikonra, vagy a "Kosár megtekintése" gombra</li>
                                                <li>Ellenőrizd a kosár tartalmát, módosítsd a mennyiségeket, ha szükséges</li>
                                                <li>Kattints a "Tovább a pénztárhoz" gombra</li>
                                                <li>Jelentkezz be meglévő fiókoddal, vagy vásárolj vendégként</li>
                                                <li>Add meg a szállítási és számlázási adataidat</li>
                                                <li>Válaszd ki a számodra megfelelő szállítási és fizetési módot</li>
                                                <li>Ellenőrizd a rendelés összesítőt, majd kattints a "Rendelés véglegesítése" gombra</li>
                                            </ol>
                                            <p>A rendelés leadásáról e-mailben visszaigazolást küldünk, amely tartalmazza a rendelés részleteit és a rendelésszámot.</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="accordion-item border mb-3 rounded overflow-hidden">
                                    <h3 class="accordion-header" id="headingOrdering2">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOrdering2" aria-expanded="false" aria-controls="collapseOrdering2">
                                            Kell regisztrálnom a rendeléshez?
                                        </button>
                                    </h3>
                                    <div id="collapseOrdering2" class="accordion-collapse collapse" aria-labelledby="headingOrdering2" data-bs-parent="#accordionOrdering">
                                        <div class="accordion-body">
                                            <p>Nem szükséges regisztrálnod, lehetőséged van vendégként is rendelni. Azonban a regisztráció számos előnnyel jár:</p>
                                            <ul>
                                                <li>Gyorsabb rendelési folyamat, mivel nem kell minden alkalommal megadnod az adataidat</li>
                                                <li>Rendeléseid nyomon követése</li>
                                                <li>Korábbi rendelések megtekintése és újrarendelés</li>
                                                <li>Személyre szabott ajánlatok és kedvezmények</li>
                                                <li>Hűségpontok gyűjtése, amelyeket későbbi vásárláskor beválthatsz</li>
                                            </ul>
                                            <p>A regisztráció ingyenes és csak néhány percet vesz igénybe.</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="accordion-item border mb-3 rounded overflow-hidden">
                                    <h3 class="accordion-header" id="headingOrdering3">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOrdering3" aria-expanded="false" aria-controls="collapseOrdering3">
                                            Hogyan tudom nyomon követni a rendelésemet?
                                        </button>
                                    </h3>
                                    <div id="collapseOrdering3" class="accordion-collapse collapse" aria-labelledby="headingOrdering3" data-bs-parent="#accordionOrdering">
                                        <div class="accordion-body">
                                            <p>A rendelésed állapotát többféleképpen is nyomon követheted:</p>
                                            <ul>
                                                <li><strong>Fiókodon keresztül:</strong> Jelentkezz be a GamerShop fiókodba, és a "Rendeléseim" menüpontban láthatod a rendeléseid státuszát.</li>
                                                <li><strong>E-mail értesítések:</strong> A rendelési folyamat különböző szakaszaiban e-mailben értesítünk (rendelés feldolgozása, fizetés, szállításra kész, átvehető stb.).</li>
                                                <li><strong>Csomagkövetés:</strong> Amikor a csomagot átadtuk a futárszolgálatnak, e-mailben küldünk egy csomagkövető linket, amelyen keresztül nyomon követheted a kiszállítást.</li>
                                            </ul>
                                            <p>Ha bármilyen kérdésed van a rendeléseddel kapcsolatban, az ügyfélszolgálatunk készséggel áll rendelkezésedre a +36 1 123 4567 telefonszámon vagy az info@gamershop.hu e-mail címen.</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="accordion-item border mb-3 rounded overflow-hidden">
                                    <h3 class="accordion-header" id="headingOrdering4">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOrdering4" aria-expanded="false" aria-controls="collapseOrdering4">
                                            Tudom módosítani a már leadott rendelésemet?
                                        </button>
                                    </h3>
                                    <div id="collapseOrdering4" class="accordion-collapse collapse" aria-labelledby="headingOrdering4" data-bs-parent="#accordionOrdering">
                                        <div class="accordion-body">
                                            <p>A rendelés módosítása vagy lemondása csak a rendelés feldolgozásának megkezdése előtt lehetséges. Ezt a következőképpen teheted meg:</p>
                                            <ul>
                                                <li>A fiókodon keresztül, a "Rendeléseim" menüpontban, ha a rendelés "Feldolgozás alatt" státuszban van</li>
                                                <li>Telefonon keresztül a +36 1 123 4567 számon (munkanapokon 9:00-17:00 között)</li>
                                                <li>E-mailben az info@gamershop.hu címen (kérjük, tüntesd fel a rendelésszámodat)</li>
                                            </ul>
                                            <p>Amennyiben a rendelés már feldolgozás alatt áll vagy kiszállításra került, módosításra nincs lehetőség. Ebben az esetben a rendelés átvétele után élhetsz a 14 napos elállási jogoddal, és új rendelést adhatsz le.</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="accordion-item border mb-3 rounded overflow-hidden">
                                    <h3 class="accordion-header" id="headingOrdering5">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOrdering5" aria-expanded="false" aria-controls="collapseOrdering5">
                                            Kaphatok számlát a vásárlásról?
                                        </button>
                                    </h3>
                                    <div id="collapseOrdering5" class="accordion-collapse collapse" aria-labelledby="headingOrdering5" data-bs-parent="#accordionOrdering">
                                        <div class="accordion-body">
                                            <p>Természetesen, minden vásárlásról automatikusan kiállítunk elektronikus számlát. A számla a következő módokon érhető el:</p>
                                            <ul>
                                                <li>E-mailben elküldjük a rendelés visszaigazolásával együtt</li>
                                                <li>A fiókodon belül a "Rendeléseim" menüpontban letöltheted</li>
                                                <li>A csomagban nyomtatott formában is megtalálható</li>
                                            </ul>
                                            <p>Ha céges vásárlást szeretnél lebonyolítani, a rendelés során az "Adatok megadása" lépésnél választhatod a "Cég" opciót, és megadhatod a céges adatokat (cégnév, székhely, adószám). A számlát ez alapján állítjuk ki.</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="accordion-item border rounded overflow-hidden">
                                    <h3 class="accordion-header" id="headingOrdering6">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOrdering6" aria-expanded="false" aria-controls="collapseOrdering6">
                                            Külföldi címre is tudok rendelni?
                                        </button>
                                    </h3>
                                    <div id="collapseOrdering6" class="accordion-collapse collapse" aria-labelledby="headingOrdering6" data-bs-parent="#accordionOrdering">
                                        <div class="accordion-body">
                                            <p>Igen, a GamerShop az alábbi országokba szállít:</p>
                                            <ul>
                                                <li>Magyarország</li>
                                                <li>EU országok (Ausztria, Szlovákia, Románia, Horvátország, Szlovénia, Németország, stb.)</li>
                                                <li>Svájc, Egyesült Királyság</li>
                                            </ul>
                                            <p>A külföldi szállítás díja az adott országtól és a csomag súlyától/méretétől függ. A pontos szállítási díjat a rendelési folyamat során, a szállítási cím megadása után láthatod.</p>
                                            <p>Kérjük, vedd figyelembe, hogy egyes termékek (például nagy méretű monitorok, gamer székek) nem rendelhetők minden külföldi címre. A termék oldalán mindig feltüntetjük, ha a termék csak belföldre rendelhető.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                
                <!-- Payment FAQs -->
                <section id="payment" class="mb-5">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-primary text-white py-3">
                            <h2 class="h4 mb-0"><i class="fas fa-credit-card me-2"></i>Fizetéssel kapcsolatos kérdések</h2>
                        </div>
                        <div class="card-body p-4">
                            <div class="accordion" id="accordionPayment">
                                <div class="accordion-item border mb-3 rounded overflow-hidden">
                                    <h3 class="accordion-header" id="headingPayment1">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePayment1" aria-expanded="true" aria-controls="collapsePayment1">
                                            Milyen fizetési módok közül választhatok?
                                        </button>
                                    </h3>
                                    <div id="collapsePayment1" class="accordion-collapse collapse show" aria-labelledby="headingPayment1" data-bs-parent="#accordionPayment">
                                        <div class="accordion-body">
                                            <p>A GamerShop webáruházban a következő fizetési módok közül választhatsz:</p>
                                            <ul>
                                                <li><strong>Online bankkártyás fizetés:</strong> Visa, MasterCard, Maestro kártyákkal a Barion biztonságos fizetési rendszerén keresztül</li>
                                                <li><strong>PayPal:</strong> Fizethetsz PayPal fiókkal vagy vendégként bankkártyával</li>
                                                <li><strong>Banki átutalás:</strong> Előre utalás a megadott bankszámlaszámra</li>
                                                <li><strong>Utánvét:</strong> Fizetés a csomag átvételekor készpénzben vagy kártyával (390 Ft kezelési díj ellenében)</li>
                                                <li><strong>Részletfizetés:</strong> 50.000 Ft feletti vásárlás esetén elérhető kamatmentes részletfizetési konstrukciók</li>
                                            </ul>
                                            <p>A választható fizetési módok a szállítási módtól is függhetnek. Például egyes csomagautomatáknál vagy személyes átvételnél nem minden fizetési mód érhető el.</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="accordion-item border mb-3 rounded overflow-hidden">
                                    <h3 class="accordion-header" id="headingPayment2">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePayment2" aria-expanded="false" aria-controls="collapsePayment2">
                                            Biztonságos-e az online bankkártyás fizetés?
                                        </button>
                                    </h3>
                                    <div id="collapsePayment2" class="accordion-collapse collapse" aria-labelledby="headingPayment2" data-bs-parent="#accordionPayment">
                                        <div class="accordion-body">
                                            <p>Igen, az online fizetés teljes mértékben biztonságos. A GamerShop webáruházban a Barion Payment Zrt. biztonságos fizetési rendszerét használjuk, amely a legmagasabb szintű védelmet biztosítja:</p>
                                            <ul>
                                                <li>256-bites SSL titkosítással védett adatátvitel</li>
                                                <li>PCI DSS tanúsítvánnyal rendelkező rendszer</li>
                                                <li>3D Secure technológia (Verified by Visa / Mastercard SecureCode)</li>
                                                <li>A bankkártyaadatok nem jutnak el hozzánk, azokat közvetlenül a Barion kezeli</li>
                                            </ul>
                                            <p>A Barion elektronikus fizetéseket lebonyolító szolgáltató, melynek tevékenységét a Magyar Nemzeti Bank felügyeli. A Barion Payment Zrt. a Magyar Nemzeti Bank felügyelete alatt álló intézmény.</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="accordion-item border mb-3 rounded overflow-hidden">
                                    <h3 class="accordion-header" id="headingPayment3">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePayment3" aria-expanded="false" aria-controls="collapsePayment3">
                                            Mikor kerül levonásra a vásárlás összege a bankkártyámról?
                                        </button>
                                    </h3>
                                    <div id="collapsePayment3" class="accordion-collapse collapse" aria-labelledby="headingPayment3" data-bs-parent="#accordionPayment">
                                        <div class="accordion-body">
                                            <p>Az összeg levonásának időpontja a választott fizetési módtól függ:</p>
                                            <ul>
                                                <li><strong>Online bankkártyás fizetés:</strong> A rendelés leadásakor azonnal megtörténik a teljes összeg levonása</li>
                                                <li><strong>PayPal:</strong> A rendelés leadásakor azonnal megtörténik a terhelés</li>
                                                <li><strong>Banki átutalás:</strong> Te indítod az utalást, miután megkaptad a visszaigazoló e-mailt a rendelésről</li>
                                                <li><strong>Utánvét:</strong> A csomag átvételekor fizeted ki az összeget</li>
                                                <li><strong>Részletfizetés:</strong> A választott konstrukciótól függően, általában az első részlet a rendelés leadásakor, a további részletek havonta kerülnek levonásra</li>
                                            </ul>
                                            <p>Ha a termék valamilyen okból nem elérhető, vagy a rendelés nem teljesíthető, a kifizetett összeget 5 munkanapon belül visszatérítjük az eredeti fizetési módnak megfelelően.</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="accordion-item border mb-3 rounded overflow-hidden">
                                    <h3 class="accordion-header" id="headingPayment4">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePayment4" aria-expanded="false" aria-controls="collapsePayment4">
                                            Milyen részletfizetési lehetőségek érhetőek el?
                                        </button>
                                    </h3>
                                    <div id="collapsePayment4" class="accordion-collapse collapse" aria-labelledby="headingPayment4" data-bs-parent="#accordionPayment">
                                        <div class="accordion-body">
                                            <p>50.000 Ft feletti vásárlás esetén különböző részletfizetési konstrukciók érhetőek el:</p>
                                            <ul>
                                                <li><strong>Kamatmentes részletfizetés:</strong> 6 vagy 10 havi részletben, 0% THM-mel fizetheted ki a vásárlás összegét</li>
                                                <li><strong>Fix kamatozású részletfizetés:</strong> 12, 24 vagy 36 havi futamidővel</li>
                                                <li><strong>Cofidis Áruhitel:</strong> Rugalmas feltételekkel, online igényelhető</li>
                                            </ul>
                                            <p>A részletfizetési kalkulátorral kiszámolhatod, hogy a vásárlási összeghez mekkora havi törlesztőrészlet tartozik a különböző konstrukciók esetén. A kalkulátor a termék oldalán vagy a kosárban is elérhető, 50.000 Ft feletti kosárérték esetén.</p>
                                            <p>A részletfizetési igénylés elbírálása általában 24 órán belül megtörténik. Pozitív elbírálás esetén a termék szállítása a normál szállítási feltételek szerint történik.</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="accordion-item border rounded overflow-hidden">
                                    <h3 class="accordion-header" id="headingPayment5">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePayment5" aria-expanded="false" aria-controls="collapsePayment5">
                                            Hogyan kapok visszatérítést, ha visszaküldöm a terméket?
                                        </button>
                                    </h3>
                                    <div id="collapsePayment5" class="accordion-collapse collapse" aria-labelledby="headingPayment5" data-bs-parent="#accordionPayment">
                                        <div class="accordion-body">
                                            <p>A termék visszaküldése esetén a visszatérítés az eredeti fizetési módnak megfelelően történik:</p>
                                            <ul>
                                                <li><strong>Bankkártyás fizetés:</strong> A vásárlás összegét a bankkártyádra utaljuk vissza</li>
                                                <li><strong>PayPal:</strong> A PayPal-fiókodra történik a visszatérítés</li>
                                                <li><strong>Banki átutalás:</strong> Az általad megadott bankszámlaszámra utaljuk az összeget</li>
                                                <li><strong>Utánvét:</strong> Banki átutalással térítjük vissza az általad megadott bankszámlaszámra</li>
                                                <li><strong>Részletfizetés:</strong> A finanszírozó partner felé törlesztjük a fennmaradó összeget, a már befizetett részleteket pedig visszatérítjük</li>
                                            </ul>
                                            <p>A visszatérítés a termék visszaérkezését és állapotának ellenőrzését követően 14 napon belül megtörténik. A visszaküldés költsége a vásárlót terheli, kivéve, ha a termék hibás volt vagy nem a megrendelt terméket szállítottuk.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                
                <!-- Shipping FAQs -->
                <section id="shipping" class="mb-5">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-primary text-white py-3">
                            <h2 class="h4 mb-0"><i class="fas fa-truck me-2"></i>Szállítással kapcsolatos kérdések</h2>
                        </div>
                        <div class="card-body p-4">
                            <div class="accordion" id="accordionShipping">
                                <div class="accordion-item border mb-3 rounded overflow-hidden">
                                    <h3 class="accordion-header" id="headingShipping1">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseShipping1" aria-expanded="true" aria-controls="collapseShipping1">
                                            Milyen szállítási módok közül választhatok?
                                        </button>
                                    </h3>
                                    <div id="collapseShipping1" class="accordion-collapse collapse show" aria-labelledby="headingShipping1" data-bs-parent="#accordionShipping">
                                        <div class="accordion-body">
                                            <p>A GamerShop webáruházban a következő szállítási módok közül választhatsz:</p>
                                            <ul>
                                                <li><strong>Házhozszállítás futárszolgálattal (GLS):</strong> 1-2 munkanapon belül, 1.490 Ft (25.000 Ft felett ingyenes)</li>
                                                <li><strong>Csomagautomata (Foxpost):</strong> 1-3 munkanapon belül, 1.190 Ft (20.000 Ft felett ingyenes)</li>
                                                <li><strong>PostaPont:</strong> 2-4 munkanapon belül,</li>