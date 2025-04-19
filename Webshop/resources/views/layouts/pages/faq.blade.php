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
                                            </ul>
                                            <ul>
                                                <li><strong>Házhozszállítás futárszolgálattal (GLS):</strong> 1-2 munkanapon belül, 1.490 Ft (25.000 Ft felett ingyenes)</li>
                                                <li><strong>Csomagautomata (Foxpost):</strong> 1-3 munkanapon belül, 1.190 Ft (20.000 Ft felett ingyenes)</li>
                                                <li><strong>PostaPont:</strong> 2-4 munkanapon belül, 1.290 Ft (20.000 Ft felett ingyenes)</li>
                                                <li><strong>Személyes átvétel:</strong> Budapesti bemutatótermünkben, ingyenes</li>
                                            </ul>
                                            <p>A szállítási idő a raktárkészleten lévő termékekre vonatkozik. A nem raktárkészleten lévő termékek esetében a termék oldalán feltüntetjük a várható szállítási időt.</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="accordion-item border mb-3 rounded overflow-hidden">
                                    <h3 class="accordion-header" id="headingShipping2">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseShipping2" aria-expanded="false" aria-controls="collapseShipping2">
                                            Mennyi idő alatt érkezik meg a rendelésem?
                                        </button>
                                    </h3>
                                    <div id="collapseShipping2" class="accordion-collapse collapse" aria-labelledby="headingShipping2" data-bs-parent="#accordionShipping">
                                        <div class="accordion-body">
                                            <p>A szállítási idő több tényezőtől függ:</p>
                                            <ol>
                                                <li><strong>Rendelés feldolgozása:</strong> A rendelés leadása után 24 órán belül feldolgozzuk a rendelést munkanapokon.</li>
                                                <li><strong>Készletállapot:</strong>
                                                    <ul>
                                                        <li>Raktáron lévő termékek: 1 munkanapon belül átadjuk a futárszolgálatnak</li>
                                                        <li>Nem raktárkészleten lévő termékek: a termék adatlapján feltüntetett várható szállítási idő alapján (általában 3-10 munkanap)</li>
                                                    </ul>
                                                </li>
                                                <li><strong>Kiszállítás:</strong> A választott szállítási módtól függően:
                                                    <ul>
                                                        <li>GLS futárszolgálat: 1-2 munkanap</li>
                                                        <li>Foxpost csomagautomata: 1-3 munkanap</li>
                                                        <li>PostaPont: 2-4 munkanap</li>
                                                    </ul>
                                                </li>
                                            </ol>
                                            <p>Raktáron lévő termékek esetén tehát a rendelés leadásától számítva általában 2-5 munkanapon belül érkezik meg a csomag. A pontos szállítási időről e-mailben értesítünk.</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="accordion-item border mb-3 rounded overflow-hidden">
                                    <h3 class="accordion-header" id="headingShipping3">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseShipping3" aria-expanded="false" aria-controls="collapseShipping3">
                                            Hogyan működik a személyes átvétel?
                                        </button>
                                    </h3>
                                    <div id="collapseShipping3" class="accordion-collapse collapse" aria-labelledby="headingShipping3" data-bs-parent="#accordionShipping">
                                        <div class="accordion-body">
                                            <p>A személyes átvétel a budapesti bemutatótermünkben történik:</p>
                                            <p><strong>Cím:</strong> 1134 Budapest, Gamer utca 42.</p>
                                            <p><strong>Nyitvatartás:</strong>
                                                <br>Hétfő-Péntek: 10:00-18:00
                                                <br>Szombat: 10:00-14:00
                                                <br>Vasárnap: Zárva
                                            </p>
                                            <p>A személyes átvétel folyamata:</p>
                                            <ol>
                                                <li>Add le rendelésedet a webáruházban, és válaszd a "Személyes átvétel" szállítási módot</li>
                                                <li>Válaszd ki a számodra megfelelő fizetési módot (bankkártyás, banki átutalás, vagy készpénz/kártya átvételkor)</li>
                                                <li>E-mailben értesítünk, amikor a rendelésed átvehető (raktáron lévő termékek esetén általában 1 munkanapon belül)</li>
                                                <li>Az értesítő e-mailben található rendelésszámmal és személyazonosító igazolvánnyal veheted át a csomagot</li>
                                            </ol>
                                            <p>A személyes átvétel előnye, hogy ingyenes, és átvétel előtt lehetőséged van ellenőrizni a terméket. Emellett szakértő kollégáink helyben segítenek, ha bármilyen kérdésed lenne.</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="accordion-item border mb-3 rounded overflow-hidden">
                                    <h3 class="accordion-header" id="headingShipping4">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseShipping4" aria-expanded="false" aria-controls="collapseShipping4">
                                            Mi történik, ha nem vagyok otthon a kézbesítéskor?
                                        </button>
                                    </h3>
                                    <div id="collapseShipping4" class="accordion-collapse collapse" aria-labelledby="headingShipping4" data-bs-parent="#accordionShipping">
                                        <div class="accordion-body">
                                            <p>Ha a kézbesítés időpontjában nem tartózkodsz a megadott címen, a futárszolgálat a következőképpen jár el:</p>
                                            <ul>
                                                <li><strong>GLS futárszolgálat:</strong>
                                                    <ul>
                                                        <li>A futár értesítőt hagy a postaládában</li>
                                                        <li>E-mailben és/vagy SMS-ben értesítenek a sikertelen kézbesítésről</li>
                                                        <li>Következő munkanapon újra megkísérlik a kézbesítést</li>
                                                        <li>Az értesítőben vagy e-mailben található linken keresztül újra időpontot foglalhatsz vagy átirányíthatod a csomagot GLS csomagpontra</li>
                                                    </ul>
                                                </li>
                                                <li><strong>Foxpost csomagautomata:</strong>
                                                    <ul>
                                                        <li>SMS-ben és e-mailben értesítenek, amikor a csomag megérkezett az automatába</li>
                                                        <li>A kódot 3 napon belül tudod felhasználni, 0-24 órában</li>
                                                        <li>Ha nem veszed át 3 napon belül, visszaküldik a csomagot</li>
                                                    </ul>
                                                </li>
                                                <li><strong>PostaPont:</strong>
                                                    <ul>
                                                        <li>A csomagot 5 munkanapon keresztül őrzik az átvételi ponton</li>
                                                        <li>SMS-ben és e-mailben értesítenek, amikor a csomag megérkezett</li>
                                                        <li>Ha nem veszed át 5 munkanapon belül, visszaküldik a csomagot</li>
                                                    </ul>
                                                </li>
                                            </ul>
                                            <p>Ha a második kézbesítési kísérlet is sikertelen, vagy nem veszed át a csomagot az átvételi határidőn belül, a csomag visszakerül hozzánk. Ebben az esetben felvesszük veled a kapcsolatot az újbóli kézbesítés egyeztetése érdekében.</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="accordion-item border mb-3 rounded overflow-hidden">
                                    <h3 class="accordion-header" id="headingShipping5">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseShipping5" aria-expanded="false" aria-controls="collapseShipping5">
                                            Hogyan ellenőrizhetem a csomagom állapotát átvételkor?
                                        </button>
                                    </h3>
                                    <div id="collapseShipping5" class="accordion-collapse collapse" aria-labelledby="headingShipping5" data-bs-parent="#accordionShipping">
                                        <div class="accordion-body">
                                            <p>A csomag átvételekor érdemes a következőket ellenőrizni:</p>
                                            <ol>
                                                <li><strong>Külső sérülések:</strong> Vizsgáld meg a csomagolást, hogy nincs-e rajta sérülés, szakadás, vagy olyan nyom, ami a belső tartalom sérülésére utalhat.</li>
                                                <li><strong>Csomag tartalma:</strong> Futáros kézbesítés esetén kérd meg a futárt, hogy várjon, amíg meggyőződsz róla, hogy a megfelelő termék van a csomagban, és az nem sérült.</li>
                                            </ol>
                                            <p><strong>Ha a csomag sérült:</strong></p>
                                            <ul>
                                                <li>Futáros kézbesítés esetén kérj jegyzőkönyvet a sérülésről, és ne vedd át a csomagot.</li>
                                                <li>Csomagautomata vagy PostaPont esetén készíts fotót a sérülésről, és jelezd ügyfélszolgálatunknak a lehető leghamarabb.</li>
                                            </ul>
                                            <p><strong>Ha a termék sérült vagy nem megfelelő:</strong></p>
                                            <ul>
                                                <li>Készíts fotót a sérülésről</li>
                                                <li>Jelezd az ügyfélszolgálatnak a problémát 48 órán belül a info@gamershop.hu e-mail címen vagy a +36 1 123 4567 telefonszámon</li>
                                                <li>A sérült vagy hibás terméket díjmentesen cseréljük</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="accordion-item border rounded overflow-hidden">
                                    <h3 class="accordion-header" id="headingShipping6">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseShipping6" aria-expanded="false" aria-controls="collapseShipping6">
                                            Mikor ingyenes a szállítás?
                                        </button>
                                    </h3>
                                    <div id="collapseShipping6" class="accordion-collapse collapse" aria-labelledby="headingShipping6" data-bs-parent="#accordionShipping">
                                        <div class="accordion-body">
                                            <p>Az ingyenes szállítás feltételei a választott szállítási módtól függenek:</p>
                                            <ul>
                                                <li><strong>GLS futárszolgálat:</strong> 25.000 Ft feletti rendelés esetén ingyenes</li>
                                                <li><strong>Foxpost csomagautomata:</strong> 20.000 Ft feletti rendelés esetén ingyenes</li>
                                                <li><strong>PostaPont:</strong> 20.000 Ft feletti rendelés esetén ingyenes</li>
                                                <li><strong>Személyes átvétel:</strong> Minden esetben ingyenes</li>
                                            </ul>
                                            <p>Az ingyenes szállítás csak Magyarország területén belül érvényes. Külföldi szállítás esetén mindig felszámításra kerül a szállítási díj.</p>
                                            <p>A rendelés összértékébe a termékek vételára számít bele, a szállítási díj és egyéb szolgáltatások díja nem.</p>
                                            <p>Időszakos akciók keretében előfordulhat, hogy a fentieknél kedvezőbb feltételekkel is elérhető az ingyenes szállítás. Az aktuális akciókról a webáruház főoldalán, vagy hírlevelünkben értesülhetsz.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                
                <!-- Returns FAQs -->
                <section id="returns" class="mb-5">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-primary text-white py-3">
                            <h2 class="h4 mb-0"><i class="fas fa-exchange-alt me-2"></i>Visszaküldés és garancia</h2>
                        </div>
                        <div class="card-body p-4">
                            <div class="accordion" id="accordionReturns">
                                <div class="accordion-item border mb-3 rounded overflow-hidden">
                                    <h3 class="accordion-header" id="headingReturns1">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseReturns1" aria-expanded="true" aria-controls="collapseReturns1">
                                            Mennyi időn belül küldhetek vissza egy terméket?
                                        </button>
                                    </h3>
                                    <div id="collapseReturns1" class="accordion-collapse collapse show" aria-labelledby="headingReturns1" data-bs-parent="#accordionReturns">
                                        <div class="accordion-body">
                                            <p>A vonatkozó jogszabályok szerint a termék átvételétől számított 14 napon belül indoklás nélkül elállhatsz a vásárlástól. Ehhez a következőket kell tenned:</p>
                                            <ol>
                                                <li>Jelezd elállási szándékodat írásban az info@gamershop.hu e-mail címen, vagy az <a href="{{ route('contact') }}">elállási nyilatkozat</a> kitöltésével</li>
                                                <li>A terméket az elállási nyilatkozat elküldésétől számított 14 napon belül vissza kell juttatnod a címünkre: 1134 Budapest, Gamer utca 42.</li>
                                                <li>A terméknek sértetlennek, használati nyomoktól mentesnek kell lennie, és tartalmaznia kell minden tartozékot, az eredeti csomagolást és a dokumentációt</li>
                                            </ol>
                                            <p>A visszaküldés költsége téged terhel, kivéve, ha a termék hibás volt vagy nem a megrendelt terméket szállítottuk ki.</p>
                                            <p>A 14 napos elállási időn túl is visszavehető a termék, ha az még bontatlan csomagolásban van, de ebben az esetben csak a termék értékének 80%-át térítjük vissza vásárlási utalvány formájában. Ez a lehetőség a termék átvételétől számított 30 napig áll fenn.</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="accordion-item border mb-3 rounded overflow-hidden">
                                    <h3 class="accordion-header" id="headingReturns2">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseReturns2" aria-expanded="false" aria-controls="collapseReturns2">
                                            Milyen garanciát vállaltok a termékekre?
                                        </button>
                                    </h3>
                                    <div id="collapseReturns2" class="accordion-collapse collapse" aria-labelledby="headingReturns2" data-bs-parent="#accordionReturns">
                                        <div class="accordion-body">
                                            <p>Minden terméket gyártói garancia véd, amelynek időtartama terméktípusonként eltérő lehet:</p>
                                            <ul>
                                                <li><strong>Általános garancia:</strong> A legtöbb termékre 2 év (24 hónap) garancia vonatkozik</li>
                                                <li><strong>Kiterjesztett garancia:</strong> Egyes termékekre a gyártó hosszabb garanciát vállal (pl. bizonyos monitorok esetében 3-5 év)</li>
                                                <li><strong>Üzleti garancia:</strong> Üzleti célú felhasználás esetén általában 1 év garancia érvényes</li>
                                            </ul>
                                            <p>A pontos garanciális feltételek a termék adatlapján és a termékhez mellékelt jótállási jegyen találhatók. A garancia érvényesítéséhez a vásárlást igazoló számla és a jótállási jegy megőrzése szükséges.</p>
                                            <p>A garancia nem vonatkozik a nem rendeltetésszerű használatból eredő károkra, a természetes elhasználódásra, valamint a fogyóeszközökre (pl. elemek, akkumulátorok).</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="accordion-item border mb-3 rounded overflow-hidden">
                                    <h3 class="accordion-header" id="headingReturns3">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseReturns3" aria-expanded="false" aria-controls="collapseReturns3">
                                            Mi a teendő, ha a termék meghibásodik a garanciális időn belül?
                                        </button>
                                    </h3>
                                    <div id="collapseReturns3" class="accordion-collapse collapse" aria-labelledby="headingReturns3" data-bs-parent="#accordionReturns">
                                        <div class="accordion-body">
                                            <p>Ha a termék a garanciális időn belül meghibásodik, a következő lehetőségeid vannak:</p>
                                            <ol>
                                                <li><strong>Jelezd a problémát:</strong> Vedd fel a kapcsolatot ügyfélszolgálatunkkal a +36 1 123 4567 telefonszámon vagy az info@gamershop.hu e-mail címen. Részletesen írd le a hibát, és ha lehetséges, csatolj fotókat vagy videót.</li>
                                                <li><strong>Hibabejelentés:</strong> Töltsd ki a <a href="{{ route('service') }}">garanciális hibabejelentő űrlapot</a>, így a folyamat gyorsabb és hatékonyabb lesz.</li>
                                                <li><strong>Termék visszaküldése:</strong> A hibás terméket a vásárlást igazoló számlával és a jótállási jeggyel együtt juttasd el címünkre (1134 Budapest, Gamer utca 42.) vagy add le személyesen a bemutatótermünkben.</li>
                                            </ol>
                                            <p>A garanciális ügyintézés menete:</p>
                                            <ul>
                                                <li>A terméket átvizsgáljuk, és megállapítjuk, hogy a hiba garanciális-e</li>
                                                <li>Garanciális hiba esetén elsősorban megjavítjuk a terméket</li>
                                                <li>Ha a javítás nem lehetséges, vagy aránytalan költséggel járna, kicseréljük a terméket</li>
                                                <li>Ha a csere sem megoldható, a vételárat visszatérítjük</li>
                                            </ul>
                                            <p>A garanciális ügyintézés általában 2-3 hetet vesz igénybe, de egyes termékeknél (pl. laptopok, monitorok) a gyártói szerviz miatt ez hosszabb időt is igénybe vehet.</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="accordion-item border rounded overflow-hidden">
                                    <h3 class="accordion-header" id="headingReturns4">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseReturns4" aria-expanded="false" aria-controls="collapseReturns4">
                                            Cserélhetek terméket, ha nem tetszik vagy nem megfelelő?
                                        </button>
                                    </h3>
                                    <div id="collapseReturns4" class="accordion-collapse collapse" aria-labelledby="headingReturns4" data-bs-parent="#accordionReturns">
                                        <div class="accordion-body">
                                            <p>Igen, lehetőséged van termékcserére a termék átvételétől számított 14 napon belül, az alábbi feltételekkel:</p>
                                            <ul>
                                                <li>A termék sértetlen, használati nyomoktól mentes</li>
                                                <li>Minden tartozék, dokumentáció és az eredeti csomagolás megvan</li>
                                                <li>A csere csak készleten lévő termékre lehetséges</li>
                                            </ul>
                                            <p>A termékcserét kezdeményezheted:</p>
                                            <ul>
                                                <li>E-mailben: info@gamershop.hu címen</li>
                                                <li>Telefonon: +36 1 123 4567 számon</li>
                                                <li>Személyesen: budapesti bemutatótermünkben</li>
                                            </ul>
                                            <p>Ha a cseretermék drágább, mint az eredeti, a különbözetet ki kell fizetned. Ha olcsóbb, a különbözetet visszatérítjük az eredeti fizetési módnak megfelelően.</p>
                                            <p>Fontos: a 14 napos elállási jog után is biztosítunk termékcserét bontatlan csomagolású termékek esetén, a vásárlástól számított 30 napig. Ebben az esetben azonban csak vásárlási utalványt tudunk biztosítani a termék értékének 80%-áig.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                
                <!-- Account FAQs -->
                <section id="account" class="mb-5">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-primary text-white py-3">
                            <h2 class="h4 mb-0"><i class="fas fa-user me-2"></i>Felhasználói fiókkal kapcsolatos kérdések</h2>
                        </div>
                        <div class="card-body p-4">
                            <div class="accordion" id="accordionAccount">
                                <!-- Ide jönnének a fiókkezeléssel kapcsolatos kérdések és válaszok -->
                            </div>
                        </div>
                    </div>
                </section>
                
                <!-- Products FAQs -->
                <section id="products">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-primary text-white py-3">
                            <h2 class="h4 mb-0"><i class="fas fa-box me-2"></i>Termékekkel kapcsolatos kérdések</h2>
                        </div>
                        <div class="card-body p-4">
                            <div class="accordion" id="accordionProducts">
                                <!-- Ide jönnének a termékekkel kapcsolatos kérdések és válaszok -->
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    
    <!-- CTA section -->
    <div class="container">
        <div class="card border-0 bg-primary text-white shadow-lg p-4 p-md-5">
            <div class="card-body text-center">
                <h2 class="display-5 fw-bold mb-4">Továbbra is kérdésed van?</h2>
                <p class="lead mb-4">Ügyfélszolgálatunk készséggel áll rendelkezésedre minden kérdésben!</p>
                <div class="row justify-content-center mb-4">
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="d-flex align-items-center bg-white bg-opacity-10 p-3 rounded h-100">
                            <i class="fas fa-phone-alt fa-2x text-white me-3"></i>
                            <div class="text-start">
                                <h5 class="mb-1">Telefonos ügyfélszolgálat</h5>
                                <p class="mb-0">+36 1 123 4567</p>
                                <small>H-P: 9:00-17:00</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="d-flex align-items-center bg-white bg-opacity-10 p-3 rounded h-100">
                            <i class="fas fa-envelope fa-2x text-white me-3"></i>
                            <div class="text-start">
                                <h5 class="mb-1">E-mail</h5>
                                <p class="mb-0">info@gamershop.hu</p>
                                <small>Válaszidő: 24 órán belül</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex align-items-center bg-white bg-opacity-10 p-3 rounded h-100">
                            <i class="fas fa-comments fa-2x text-white me-3"></i>
                            <div class="text-start">
                                <h5 class="mb-1">Chat</h5>
                                <p class="mb-0">Élő chat az oldal jobb alsó sarkában</p>
                                <small>H-P: 9:00-17:00</small>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('contact') }}" class="btn btn-light btn-lg px-5">
                    <i class="fas fa-envelope me-2"></i>Kapcsolatfelvétel
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Sticky sidebar */
    @media (min-width: 992px) {
        .sticky-lg-top {
            position: -webkit-sticky;
            position: sticky;
            top: 2rem;
            z-index: 1000;
        }
    }
    
    /* Smooth scrolling */
    html {
        scroll-behavior: smooth;
        scroll-padding-top: 2rem;
    }
    
    /* Active section highlight */
    .list-group-item.active {
        background-color: #0095FF;
        border-color: #0095FF;
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
    
    .accordion-item {
        transition: transform 0.2s ease;
    }
    
    .accordion-item:hover {
        transform: translateY(-2px);
    }
    
    /* Timeline items */
    .timeline-item {
        padding-left: 20px;
        position: relative;
    }
    
    .timeline-item::before {
        content: '';
        position: absolute;
        left: 0;
        top: 6px;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background-color: #0095FF;
    }
    
    /* FAQ search styling */
    .faq-search .form-control:focus {
        border-color: #0095FF;
        box-shadow: 0 0 0 0.25rem rgba(0, 149, 255, 0.25);
    }
    
    /* Cards */
    .card {
        transition: all 0.3s ease;
    }
    
    /* Section padding */
    section {
        scroll-margin-top: 2rem;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // FAQ search functionality
        const searchInput = document.getElementById('faqSearch');
        const accordionItems = document.querySelectorAll('.accordion-item');
        
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                
                if (searchTerm.length < 2) {
                    // If search term is too short, show all items
                    accordionItems.forEach(item => {
                        item.style.display = 'block';
                        // Collapse all items when clearing search
                        if (searchTerm.length === 0) {
                            const collapseElement = item.querySelector('.accordion-collapse');
                            const button = item.querySelector('.accordion-button');
                            if (!button.classList.contains('collapsed')) {
                                button.classList.add('collapsed');
                                collapseElement.classList.remove('show');
                            }
                        }
                    });
                    return;
                }
                
                // Filter the accordion items
                accordionItems.forEach(item => {
                    const question = item.querySelector('.accordion-button').textContent.toLowerCase();
                    const answer = item.querySelector('.accordion-body').textContent.toLowerCase();
                    
                    if (question.includes(searchTerm) || answer.includes(searchTerm)) {
                        item.style.display = 'block';
                        // Expand the matching items
                        const collapseElement = item.querySelector('.accordion-collapse');
                        const button = item.querySelector('.accordion-button');
                        if (button.classList.contains('collapsed')) {
                            button.classList.remove('collapsed');
                            collapseElement.classList.add('show');
                        }
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        }
        
        // Scroll to section and highlight active category
        const categories = document.querySelectorAll('#faq-categories a');
        const sections = document.querySelectorAll('section');
        
        // Function to set active category
        function setActiveCategory() {
            // Find which section is currently in view
            let currentSection = null;
            let smallestDistance = Infinity;
            
            sections.forEach(section => {
                const rect = section.getBoundingClientRect();
                const distance = Math.abs(rect.top);
                
                if (distance < smallestDistance) {
                    smallestDistance = distance;
                    currentSection = section.id;
                }
            });
            
            // Set active class for the current section
            if (currentSection) {
                categories.forEach(category => {
                    if (category.getAttribute('href') === `#${currentSection}`) {
                        category.classList.add('active');
                    } else {
                        category.classList.remove('active');
                    }
                });
            }
        }
        
        // Set active category on scroll
        window.addEventListener('scroll', function() {
            setActiveCategory();
        });
        
        // Set active category on initial load
        setActiveCategory();
        
        // Smooth scroll to the section when clicking on category
        categories.forEach(category => {
            category.addEventListener('click', function(e) {
                e.preventDefault();
                
                const targetId = this.getAttribute('href').substring(1);
                const targetElement = document.getElementById(targetId);
                
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 20,
                        behavior: 'smooth'
                    });
                    
                    // Set active class
                    categories.forEach(cat => cat.classList.remove('active'));
                    this.classList.add('active');
                }
            });
        });
    });
</script>
@endpush