<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryCount = Category::count();
    if ($categoryCount == 0) {
        $this->command->info('Nincsenek kategóriák. Először a CategorySeeder-t futtasd!');
        return;
    }
    
    // Töröljük a korábbi termékeket és képeket
    $this->command->info('Termékek és termékképek törlése...');
    DB::statement('SET FOREIGN_KEY_CHECKS=0');
    Product::truncate();
    ProductImage::truncate();
    DB::statement('SET FOREIGN_KEY_CHECKS=1');
    
    $categoryIds = Category::pluck('id')->toArray();
    
    // Gaming PC termékek
    $this->createGamingPCs($categoryIds[0]);
        
        // Konzolok
        $this->createConsoles($categoryIds[1]);
        
        // Monitorok
        $this->createMonitors($categoryIds[2]);
        
        // Billentyűzetek
        $this->createKeyboards($categoryIds[3]);
        
        // Egerek
        $this->createMice($categoryIds[4]);
        
        // Fejhallgatók
        $this->createHeadsets($categoryIds[5]);
        
        // Videójátékok
        $this->createGames($categoryIds[6]);
        
        // Gamer székek
        $this->createChairs($categoryIds[7]);
        
        // Számítógép alkatrészek
        $this->createComponents($categoryIds[8]);
        
        // Gamer kiegészítők
        $this->createAccessories($categoryIds[9]);
        
        $this->command->info('30 termék sikeresen létrehozva!');
    }
    
    /**
     * Gaming PC-k létrehozása
     */
    private function createGamingPCs($categoryId)
    {
        $products = [
            [
                'name' => 'Razor GXT-5000 Gaming PC',
                'short_description' => 'Csúcsteljesítményű gamer PC RTX 4080 videokártyával és Ryzen 9 processzorral.',
                'full_description' => 'A Razor GXT-5000 a legújabb generációs gamer PC, amely kiváló teljesítményt nyújt a legújabb AAA játékokhoz is. Az NVIDIA RTX 4080 videokártya és az AMD Ryzen 9 7900X processzor kombinációja biztosítja a zökkenőmentes játékélményt akár 4K felbontáson is. Az elegáns RGB házban 32GB DDR5 memória és 2TB NVMe SSD található a villámgyors betöltési időkért.',
                'price' => 999900,
                'original_price' => 1099900,
                'stock_quantity' => 15,
                'brand' => 'Razor',
                'type' => 'Gaming PC',
                'specifications' => json_encode([
                    'Processzor' => 'AMD Ryzen 9 7900X',
                    'Videokártya' => 'NVIDIA GeForce RTX 4080 16GB',
                    'Memória' => '32GB DDR5 5200MHz',
                    'Tárhely' => '2TB NVMe SSD',
                    'Tápegység' => '850W 80+ Gold',
                    'Hűtés' => 'RGB Vízhűtés'
                ]),
                'status' => 'Aktív',
                'is_featured' => true,
                'is_new_arrival' => true,
                'warranty_months' => 36
            ],
            [
                'name' => 'TitanForce Pro Gaming PC',
                'short_description' => 'Középkategóriás játékra optimalizált számítógép Intel i5 processzorral.',
                'full_description' => 'A TitanForce Pro egy kiváló ár-érték arányú gaming számítógép, amely megfizethető áron kínál jó teljesítményt. Az Intel Core i5-13600K processzor és az RTX 3060 Ti videokártya zökkenőmentes játékélményt biztosít 1440p felbontáson. A 16GB DDR4 memória és az 1TB NVMe SSD gyors betöltési időt és sokoldalú használatot tesz lehetővé.',
                'price' => 499900,
                'original_price' => 549900,
                'stock_quantity' => 8,
                'brand' => 'TitanForce',
                'type' => 'Gaming PC',
                'specifications' => json_encode([
                    'Processzor' => 'Intel Core i5-13600K',
                    'Videokártya' => 'NVIDIA GeForce RTX 3060 Ti 8GB',
                    'Memória' => '16GB DDR4 3200MHz',
                    'Tárhely' => '1TB NVMe SSD',
                    'Tápegység' => '650W 80+ Bronze',
                    'Hűtés' => 'RGB Léghűtés'
                ]),
                'status' => 'Aktív',
                'is_featured' => false,
                'is_new_arrival' => false,
                'warranty_months' => 24
            ],
            [
                'name' => 'AlphaGamer Stealth RTX',
                'short_description' => 'Kompakt méretű, erőteljes mini-ITX gaming PC egyedi hűtőrendszerrel.',
                'full_description' => 'Az AlphaGamer Stealth RTX egy kompakt, mégis nagy teljesítményű gamer PC, ami tökéletesen illeszkedik bármilyen játékállomáshoz. A mini-ITX formátum ellenére csúcskategóriás komponensekkel szereltük fel: Ryzen 7 processzor, RTX 4070 videokártya és 32GB memória biztosítja, hogy a legújabb játékokat is maximális grafikai beállításokkal élvezhesd.',
                'price' => 799900,
                'original_price' => 849900,
                'stock_quantity' => 5,
                'brand' => 'AlphaGamer',
                'type' => 'Gaming PC',
                'specifications' => json_encode([
                    'Processzor' => 'AMD Ryzen 7 7700X',
                    'Videokártya' => 'NVIDIA GeForce RTX 4070 12GB',
                    'Memória' => '32GB DDR5 5200MHz',
                    'Tárhely' => '1TB NVMe SSD + 2TB HDD',
                    'Tápegység' => '750W 80+ Platinum SFX',
                    'Hűtés' => 'Egyedi Folyadékhűtés'
                ]),
                'status' => 'Aktív',
                'is_featured' => true,
                'is_new_arrival' => true,
                'warranty_months' => 36
            ]
        ];

        foreach ($products as $product) {
            $product['category_id'] = $categoryId;
            $product['slug'] = Str::slug($product['name']);
            $product['discount_percentage'] = $this->calculateDiscount($product['price'], $product['original_price']);
            $product['meta_title'] = $product['name'];
            $product['meta_description'] = $product['short_description'];
            $product['meta_keywords'] = $product['brand'] . ', ' . $product['type'] . ', Gaming PC';
            
            $createdProduct = Product::create($product);
            
            // Alapértelmezett képeket adunk hozzá
            $this->addDefaultProductImages($createdProduct->id);
        }
    }

    /**
     * Konzolok létrehozása
     */
    private function createConsoles($categoryId)
    {
        $products = [
            [
                'name' => 'PlayStation 5 Digital Edition',
                'short_description' => 'Új generációs játékkonzol, optikai meghajtó nélkül, 825GB SSD-vel.',
                'full_description' => 'Merülj el a játék új generációjában a PlayStation 5 Digital Edition konzollal. Az erőteljes egyedi AMD processzorok, a nagy sebességű SSD és a DualSense kontroller új perspektívát nyit a konzolos játékokban. A digitális kiadás optikai meghajtó nélkül érkezik, így minden játékot a PlayStation Store-ból kell letöltened.',
                'price' => 179990,
                'original_price' => 189990,
                'stock_quantity' => 10,
                'brand' => 'Sony',
                'type' => 'Konzol',
                'specifications' => json_encode([
                    'CPU' => 'AMD Zen 2, 8 mag, 3.5GHz',
                    'GPU' => 'AMD RDNA 2, 10.28 TFLOPS',
                    'Memória' => '16GB GDDR6',
                    'Tárhely' => '825GB SSD',
                    'Optikai meghajtó' => 'Nincs',
                    'Hálózat' => 'Wi-Fi 6, Bluetooth 5.1'
                ]),
                'status' => 'Aktív',
                'is_featured' => true,
                'is_new_arrival' => false,
                'warranty_months' => 24
            ],
            [
                'name' => 'Xbox Series X',
                'short_description' => 'Microsoft legerősebb konzolja 1TB SSD-vel és 4K játékélménnyel.',
                'full_description' => 'Az Xbox Series X a Microsoft eddigi legerősebb konzolja, amely 4K felbontáson és 120 képkocka/másodperc sebességgel biztosít élménydús játékot. A gyors betöltési idők és a visszafelé kompatibilitás révén kedvenc játékaid új életre kelnek. Az Xbox Game Pass szolgáltatással több száz játékhoz férhetsz hozzá havi előfizetés keretében.',
                'price' => 189990,
                'original_price' => 199990,
                'stock_quantity' => 7,
                'brand' => 'Microsoft',
                'type' => 'Konzol',
                'specifications' => json_encode([
                    'CPU' => 'AMD Zen 2, 8 mag, 3.8GHz',
                    'GPU' => 'AMD RDNA 2, 12 TFLOPS',
                    'Memória' => '16GB GDDR6',
                    'Tárhely' => '1TB NVMe SSD',
                    'Optikai meghajtó' => '4K UHD Blu-ray',
                    'Hálózat' => 'Wi-Fi 6, Bluetooth 5.1'
                ]),
                'status' => 'Aktív',
                'is_featured' => true,
                'is_new_arrival' => false,
                'warranty_months' => 24
            ],
            [
                'name' => 'Nintendo Switch OLED',
                'short_description' => 'Továbbfejlesztett Switch konzol OLED kijelzővel és kibővített tárhellyel.',
                'full_description' => 'A Nintendo Switch OLED modell az eredeti Switch továbbfejlesztett változata, amely 7 colos OLED kijelzővel rendelkezik a még jobb vizuális élményért. A konzol megőrzi a hibrid jellegét, így TV-hez csatlakoztatva és hordozható módban is használhatod. Az állítható állvány, kibővített tárhely és továbbfejlesztett hangszórók teszik teljessé az élményt.',
                'price' => 129990,
                'original_price' => 139990,
                'stock_quantity' => 12,
                'brand' => 'Nintendo',
                'type' => 'Konzol',
                'specifications' => json_encode([
                    'Kijelző' => '7" OLED, 1280x720',
                    'Processzor' => 'NVIDIA Tegra X1',
                    'Memória' => '4GB LPDDR4',
                    'Tárhely' => '64GB (bővíthető microSD)',
                    'Akkumulátor' => '4310 mAh (4.5-9 óra)',
                    'Csatlakozók' => 'USB-C, HDMI (dokkolón)'
                ]),
                'status' => 'Aktív',
                'is_featured' => false,
                'is_new_arrival' => true,
                'warranty_months' => 24
            ]
        ];

        foreach ($products as $product) {
            $product['category_id'] = $categoryId;
            $product['slug'] = Str::slug($product['name']);
            $product['discount_percentage'] = $this->calculateDiscount($product['price'], $product['original_price']);
            $product['meta_title'] = $product['name'];
            $product['meta_description'] = $product['short_description'];
            $product['meta_keywords'] = $product['brand'] . ', ' . $product['type'] . ', Konzol';
            
            $createdProduct = Product::create($product);
            
            // Alapértelmezett képeket adunk hozzá
            $this->addDefaultProductImages($createdProduct->id);
        }
    }

    /**
     * Monitorok létrehozása
     */
    private function createMonitors($categoryId)
    {
        $products = [
            [
                'name' => 'ASUS ROG Swift PG279QM',
                'short_description' => '27" gaming monitor 240Hz frissítési rátával és G-Sync támogatással.',
                'full_description' => 'Az ASUS ROG Swift PG279QM a legigényesebb játékosok számára készült monitor. A 27 colos IPS panel 240Hz frissítéssel és 1ms válaszidővel rendelkezik, így tökéletes az e-sport játékokhoz. A NVIDIA G-Sync technológia kiküszöböli a képtörést, a HDR400 támogatás pedig élénk színeket biztosít. Az ergonomikus állvány lehetővé teszi a magasság, dőlésszög és forgatás beállítását a kényelmes használathoz.',
                'price' => 299990,
                'original_price' => 319990,
                'stock_quantity' => 6,
                'brand' => 'ASUS',
                'type' => 'Monitor',
                'specifications' => json_encode([
                    'Kijelző méret' => '27"',
                    'Panel típus' => 'IPS',
                    'Felbontás' => '2560x1440 (WQHD)',
                    'Frissítési ráta' => '240Hz',
                    'Válaszidő' => '1ms (GtG)',
                    'HDR' => 'VESA DisplayHDR 400',
                    'Adaptív szinkron' => 'NVIDIA G-Sync'
                ]),
                'status' => 'Aktív',
                'is_featured' => true,
                'is_new_arrival' => false,
                'warranty_months' => 36
            ],
            [
                'name' => 'LG UltraGear 27GN950-B',
                'short_description' => '27" 4K UHD Nano IPS monitor 144Hz frissítéssel és HDR600 támogatással.',
                'full_description' => 'Az LG UltraGear 27GN950-B egy prémium 4K gaming monitor, amely Nano IPS technológiával készült a lenyűgöző vizuális élményért. A 144Hz frissítési frekvencia és az 1ms válaszidő zökkenőmentes játékmenetet biztosít, míg a HDR600 tanúsítvány élénk színeket és részleteket garantál. A monitor AMD FreeSync Premium Pro és NVIDIA G-Sync kompatibilis, így bármilyen videokártyával tökéletesen működik.',
                'price' => 279990,
                'original_price' => 299990,
                'stock_quantity' => 4,
                'brand' => 'LG',
                'type' => 'Monitor',
                'specifications' => json_encode([
                    'Kijelző méret' => '27"',
                    'Panel típus' => 'Nano IPS',
                    'Felbontás' => '3840x2160 (4K UHD)',
                    'Frissítési ráta' => '144Hz',
                    'Válaszidő' => '1ms (GtG)',
                    'HDR' => 'VESA DisplayHDR 600',
                    'Adaptív szinkron' => 'FreeSync Premium Pro, G-Sync Compatible'
                ]),
                'status' => 'Aktív',
                'is_featured' => false,
                'is_new_arrival' => true,
                'warranty_months' => 36
            ],
            [
                'name' => 'Samsung Odyssey G5',
                'short_description' => '32" ívelt QHD gaming monitor 165Hz frissítéssel és 1ms válaszidővel.',
                'full_description' => 'A Samsung Odyssey G5 ívelt kialakítású monitor tökéletes a belemerülő játékélményhez. A 32 colos VA panel 1000R görbülettel és 2560x1440 felbontással rendelkezik, amely éles képet és széles látószöget biztosít. A 165Hz frissítési ráta és az 1ms válaszidő folyamatos, akadozásmentes játékot garantál, míg az AMD FreeSync Premium technológia kiküszöböli a képtörést.',
                'price' => 119990,
                'original_price' => 139990,
                'stock_quantity' => 10,
                'brand' => 'Samsung',
                'type' => 'Monitor',
                'specifications' => json_encode([
                    'Kijelző méret' => '32"',
                    'Panel típus' => 'VA',
                    'Ívelt kijelző' => '1000R',
                    'Felbontás' => '2560x1440 (QHD)',
                    'Frissítési ráta' => '165Hz',
                    'Válaszidő' => '1ms (MPRT)',
                    'Adaptív szinkron' => 'AMD FreeSync Premium'
                ]),
                'status' => 'Aktív',
                'is_featured' => true,
                'is_new_arrival' => false,
                'warranty_months' => 24
            ]
        ];

        foreach ($products as $product) {
            $product['category_id'] = $categoryId;
            $product['slug'] = Str::slug($product['name']);
            $product['discount_percentage'] = $this->calculateDiscount($product['price'], $product['original_price']);
            $product['meta_title'] = $product['name'];
            $product['meta_description'] = $product['short_description'];
            $product['meta_keywords'] = $product['brand'] . ', ' . $product['type'] . ', Monitor';
            
            $createdProduct = Product::create($product);
            
            // Alapértelmezett képeket adunk hozzá
            $this->addDefaultProductImages($createdProduct->id);
        }
    }

    /**
     * Billentyűzetek létrehozása
     */
    private function createKeyboards($categoryId)
    {
        $products = [
            [
                'name' => 'Razer Huntsman V2',
                'short_description' => 'Optikai kapcsolós gamer billentyűzet hang-csillapítással és RGB világítással.',
                'full_description' => 'A Razer Huntsman V2 a gyorsaság és a precizitás tökéletes kombinációja. Az optikai kapcsolók 0.2ms működési idővel rendelkeznek, ami villámgyors reakcióidőt biztosít a játékokban. A beépített hangcsillapító hab megszünteti a zavaró billentyűzajokat, a Chroma RGB világítás pedig tökéletesen illeszkedik a játékállomásodhoz. A kényelmes csuklótámasz és a dedikált médiavezérlők teszik teljessé az élményt.',
                'price' => 64990,
                'original_price' => 69990,
                'stock_quantity' => 8,
                'brand' => 'Razer',
                'type' => 'Billentyűzet',
                'specifications' => json_encode([
                    'Típus' => 'Optikai mechanikus',
                    'Kapcsolók' => 'Razer Optikai (Piros/Lila)',
                    'Elrendezés' => 'Teljes méretű',
                    'RGB világítás' => 'Razer Chroma RGB',
                    'Csuklótámasz' => 'Mágneses, plüss borítású',
                    'Hangcsillapítás' => 'Igen, beépített hab'
                ]),
                'status' => 'Aktív',
                'is_featured' => false,
                'is_new_arrival' => true,
                'warranty_months' => 24
            ],
            [
                'name' => 'HyperX Alloy Origins Core',
                'short_description' => 'Alumínium vázas TKL mechanikus billentyűzet HyperX Red kapcsolókkal.',
                'full_description' => 'A HyperX Alloy Origins Core egy kompakt és tartós TKL (Tenkeyless) billentyűzet, amely repülőgép-minőségű alumínium vázzal rendelkezik. A HyperX Red lineáris kapcsolók ideálisak a gyors és csendes játékélményhez. A három fokozatú állíthatóságnak köszönhetően mindig megtalálhatod a legkényelmesebb pozíciót, míg a fényes RGB háttérvilágítás testreszabható a HyperX NGENUITY szoftverrel.',
                'price' => 39990,
                'original_price' => 44990,
                'stock_quantity' => 20,
                'brand' => 'HyperX',
                'type' => 'Billentyűzet',
                'specifications' => json_encode([
                    'Típus' => 'Mechanikus',
                    'Kapcsolók' => 'HyperX Red (Lineáris)',
                    'Elrendezés' => 'Tenkeyless (TKL)',
                    'Váz' => 'Repülőgép-minőségű alumínium',
                    'RGB világítás' => 'Egyedileg programozható',
                    'Kábel' => 'Leválasztható USB-C'
                ]),
                'status' => 'Aktív',
                'is_featured' => true,
                'is_new_arrival' => false,
                'warranty_months' => 24
            ]
        ];

        foreach ($products as $product) {
            $product['category_id'] = $categoryId;
            $product['slug'] = Str::slug($product['name']);
            $product['discount_percentage'] = $this->calculateDiscount($product['price'], $product['original_price']);
            $product['meta_title'] = $product['name'];
            $product['meta_description'] = $product['short_description'];
            $product['meta_keywords'] = $product['brand'] . ', ' . $product['type'] . ', Billentyűzet';
            
            $createdProduct = Product::create($product);
            
            // Alapértelmezett képeket adunk hozzá
            $this->addDefaultProductImages($createdProduct->id);
        }
    }

    /**
     * Egerek létrehozása
   
     * Egerek létrehozása (folytatás)
     */
    private function createMice($categoryId)
    {
        $products = [
            [
                'name' => 'Logitech G Pro X Superlight',
                'short_description' => 'Ultrakönnyű vezeték nélküli e-sport egér, mindössze 63 gramm súllyal.',
                'full_description' => 'A Logitech G Pro X Superlight az eddigi legkönnyebb vezeték nélküli profi egér a Logitechtől. A mindössze 63 grammos súly és az aerodinamikus kialakítás tökéletes irányítást és gyorsaságot biztosít versenyhelyzetekben. A HERO 25K szenzor 25.600 DPI felbontása és a LIGHTSPEED vezeték nélküli technológia professzionális teljesítményt nyújt, 70 órás üzemidővel.',
                'price' => 57990,
                'original_price' => 64990,
                'stock_quantity' => 12,
                'brand' => 'Logitech',
                'type' => 'Egér',
                'specifications' => json_encode([
                    'Szenzor' => 'HERO 25K',
                    'Felbontás' => '25.600 DPI',
                    'Súly' => '63g',
                    'Vezeték nélküli' => 'LIGHTSPEED',
                    'Akkumulátor' => '70 óra',
                    'Gombok száma' => '5'
                ]),
                'status' => 'Aktív',
                'is_featured' => true,
                'is_new_arrival' => true,
                'warranty_months' => 24
            ],
            [
                'name' => 'Razer DeathAdder V3 Pro',
                'short_description' => 'Vezeték nélküli ergonomikus egér 90 millió kattintást bíró kapcsolókkal.',
                'full_description' => 'A Razer DeathAdder V3 Pro a legendás DeathAdder ergonomikus formáját ötvözi a legújabb technológiákkal. Az új optikai kapcsolók 90 millió kattintást bírnak, a Focus Pro 30K optikai szenzor pedig páratlan precizitást biztosít. Az egér HyperSpeed vezeték nélküli kapcsolattal rendelkezik, amely ugyanolyan gyors, mint a vezetékes megoldások. A 63 grammos súly és az ergonomikus kialakítás hosszú játékmenetekhez is ideális.',
                'price' => 54990,
                'original_price' => 59990,
                'stock_quantity' => 8,
                'brand' => 'Razer',
                'type' => 'Egér',
                'specifications' => json_encode([
                    'Szenzor' => 'Focus Pro 30K',
                    'Felbontás' => '30.000 DPI',
                    'Súly' => '63g',
                    'Vezeték nélküli' => 'HyperSpeed',
                    'Akkumulátor' => '90 óra',
                    'Gombok száma' => '5'
                ]),
                'status' => 'Aktív',
                'is_featured' => false,
                'is_new_arrival' => true,
                'warranty_months' => 24
            ],
            [
                'name' => 'SteelSeries Rival 3',
                'short_description' => 'Megfizethető gaming egér TrueMove Core szenzorral és RGB világítással.',
                'full_description' => 'A SteelSeries Rival 3 tökéletes belépő szintű gaming egér, amely megfizethető áron kínál kiváló teljesítményt. A TrueMove Core optikai szenzor 8.500 DPI-vel működik, a mechanikus kapcsolók pedig 60 millió kattintásra vannak tervezve. Az egér könnyű, mindössze 77 grammos, és ergonomikus kialakítása hosszú játékidőt tesz lehetővé. A PrismSync RGB világítás testreszabható a SteelSeries Engine szoftverrel.',
                'price' => 14990,
                'original_price' => 17990,
                'stock_quantity' => 25,
                'brand' => 'SteelSeries',
                'type' => 'Egér',
                'specifications' => json_encode([
                    'Szenzor' => 'TrueMove Core',
                    'Felbontás' => '8.500 DPI',
                    'Súly' => '77g',
                    'Kábel' => '1.8m gumírozott',
                    'Kapcsolók' => '60 millió kattintás',
                    'Gombok száma' => '6'
                ]),
                'status' => 'Aktív',
                'is_featured' => true,
                'is_new_arrival' => false,
                'warranty_months' => 24
            ]
        ];

        foreach ($products as $product) {
            $product['category_id'] = $categoryId;
            $product['slug'] = Str::slug($product['name']);
            $product['discount_percentage'] = $this->calculateDiscount($product['price'], $product['original_price']);
            $product['meta_title'] = $product['name'];
            $product['meta_description'] = $product['short_description'];
            $product['meta_keywords'] = $product['brand'] . ', ' . $product['type'] . ', Egér';
            
            $createdProduct = Product::create($product);
            
            // Alapértelmezett képeket adunk hozzá
            $this->addDefaultProductImages($createdProduct->id);
        }
    }/**
     * Fejhallgatók létrehozása (folytatás)
     */
    private function createHeadsets($categoryId)
    {
        $products = [
            [
                'name' => 'HyperX Cloud Alpha',
                'short_description' => 'Prémium gaming fejhallgató dupla kamrás hangzással és lecsatolható mikrofonnal.',
                'full_description' => 'A HyperX Cloud Alpha dupla kamrás hangzástechnológiája a mély basszusokat és a tiszta magasakat elkülönítve kezeli, így kivételes hangminőséget biztosít. A memóriahabos fülpárnák hosszú játékmenetek során is kényelmet nyújtanak, a lecsatolható mikrofon pedig Discord és TeamSpeak tanúsítvánnyal rendelkezik a kiváló kommunikációért. Az alumínium váz tartós, mégis könnyű kialakítást biztosít.',
                'price' => 34990,
                'original_price' => 39990,
                'stock_quantity' => 20,
                'brand' => 'HyperX',
                'type' => 'Fejhallgató',
                'specifications' => json_encode([
                    'Hangszórók' => '50mm dinamikus, dupla kamrás',
                    'Frekvenciaválasz' => '13Hz-27.000Hz',
                    'Csatlakozás' => '3.5mm jack',
                    'Mikrofon' => 'Lecsatolható, zajszűrős',
                    'Kábel' => '1.3m + 2m hosszabbító',
                    'Súly' => '336g'
                ]),
                'status' => 'Aktív',
                'is_featured' => true,
                'is_new_arrival' => false,
                'warranty_months' => 24
            ],
            [
                'name' => 'Logitech G Pro X',
                'short_description' => 'Profi vezetékes fejhallgató Blue VO!CE mikrofontehnológiával.',
                'full_description' => 'A Logitech G Pro X a profi e-sportolók igényeire szabott gaming fejhallgató. A Blue VO!CE mikrofontehnológia valósidejű hangszűrést és -feldolgozást biztosít a kristálytiszta kommunikációért. A 7.1-es virtuális térhatású hangzás pontos helymeghatározást tesz lehetővé a játékokban, míg a DTS Headphone:X 2.0 technológia élethű hangélményt nyújt.',
                'price' => 44990,
                'original_price' => 49990,
                'stock_quantity' => 10,
                'brand' => 'Logitech',
                'type' => 'Fejhallgató',
                'specifications' => json_encode([
                    'Hangszórók' => '50mm PRO-G',
                    'Frekvenciaválasz' => '20Hz-20.000Hz',
                    'Csatlakozás' => '3.5mm jack / USB',
                    'Mikrofon' => 'Lecsatolható, Blue VO!CE',
                    'Surround' => 'DTS Headphone:X 2.0',
                    'Súly' => '320g'
                ]),
                'status' => 'Aktív',
                'is_featured' => true,
                'is_new_arrival' => true,
                'warranty_months' => 24
            ],
            [
                'name' => 'SteelSeries Arctis Nova Pro Wireless',
                'short_description' => 'Csúcskategóriás vezeték nélküli fejhallgató aktív zajszűréssel és cserélhető akkumulátorral.',
                'full_description' => 'A SteelSeries Arctis Nova Pro Wireless a gaming fejhallgatók új generációját képviseli. Az aktív zajszűrés (ANC) kizárja a külvilág zavaró hangjait, míg a különleges hangszórók kivételes minőségű hangzást biztosítanak. A rendszer két cserélhető akkumulátorral érkezik, amelyek egyike mindig tölthető a dokkolóban, így soha nem fogsz kényelmetlenül lemerülni játék közben. A vezeték nélküli bázisállomás 2.4GHz-es és Bluetooth kapcsolatot is biztosít.',
                'price' => 129990,
                'original_price' => 139990,
                'stock_quantity' => 5,
                'brand' => 'SteelSeries',
                'type' => 'Fejhallgató',
                'specifications' => json_encode([
                    'Hangszórók' => 'High Fidelity Drivers',
                    'Zajszűrés' => 'Aktív zajszűrés (ANC)',
                    'Csatlakozás' => '2.4GHz / Bluetooth 5.0',
                    'Mikrofon' => 'Behúzható ClearCast Gen 2',
                    'Akkumulátor' => '2 cserélhető, 20 óra',
                    'Súly' => '338g'
                ]),
                'status' => 'Aktív',
                'is_featured' => false,
                'is_new_arrival' => true,
                'warranty_months' => 24
            ]
        ];

        foreach ($products as $product) {
            $product['category_id'] = $categoryId;
            $product['slug'] = Str::slug($product['name']);
            $product['discount_percentage'] = $this->calculateDiscount($product['price'], $product['original_price']);
            $product['meta_title'] = $product['name'];
            $product['meta_description'] = $product['short_description'];
            $product['meta_keywords'] = $product['brand'] . ', ' . $product['type'] . ', Fejhallgató';
            
            $createdProduct = Product::create($product);
            
            // Alapértelmezett képeket adunk hozzá
            $this->addDefaultProductImages($createdProduct->id);
        }
    }

    /**
     * Videójátékok létrehozása
     */
    private function createGames($categoryId)
    {
        $products = [
            [
                'name' => 'Elden Ring - PS5',
                'short_description' => 'Nyílt világú akció-RPG a FromSoftware-től és George R. R. Martin együttműködésében.',
                'full_description' => 'Az Elden Ring Hidetaka Miyazaki és George R. R. Martin közös alkotása, amely egy hatalmas, mitikus világgal és gazdag történettel várja a játékosokat. A játékban saját karakterünket alakítva járhatjuk be a Köztes Földeket, ahol veszélyes ellenfelek, lenyűgöző főellenségek és számos egyedi karakter vár ránk. A játék szabadságot ad a játékosoknak a kaland megélésére, lehetővé téve a saját játékstílus kialakítását.',
                'price' => 24990,
                'original_price' => 27990,
                'stock_quantity' => 30,
                'brand' => 'FromSoftware',
                'type' => 'Videójáték',
                'specifications' => json_encode([
                    'Platform' => 'PlayStation 5',
                    'Műfaj' => 'Akció RPG',
                    'Megjelenés' => '2022',
                    'Játékosok száma' => '1 (+ online multi)',
                    'Korhatár' => 'PEGI 16',
                    'Nyelv' => 'Magyar feliratos'
                ]),
                'status' => 'Aktív',
                'is_featured' => true,
                'is_new_arrival' => false,
                'warranty_months' => 6
            ],
            [
                'name' => 'The Legend of Zelda: Tears of the Kingdom - Nintendo Switch',
                'short_description' => 'A legendás Zelda sorozat legújabb fejezete a Nintendo Switch konzolra.',
                'full_description' => 'A The Legend of Zelda: Tears of the Kingdom a Breath of the Wild folytatása, amely új kalandokra viszi a játékosokat Hyrule birodalmában. Link ezúttal a levegőben úszó szigeteket is felfedezheti, új képességeket tanulhat és még több rejtvényt oldhat meg. A játék továbbfejlesztett fizikai rendszere és a tárgyak kombinálásának lehetősége számtalan kreatív megoldást kínál a játékosok számára.',
                'price' => 19990,
                'original_price' => 21990,
                'stock_quantity' => 25,
                'brand' => 'Nintendo',
                'type' => 'Videójáték',
                'specifications' => json_encode([
                    'Platform' => 'Nintendo Switch',
                    'Műfaj' => 'Akció-kaland',
                    'Megjelenés' => '2023',
                    'Játékosok száma' => '1',
                    'Korhatár' => 'PEGI 12',
                    'Nyelv' => 'Angol (feliratos)'
                ]),
                'status' => 'Aktív',
                'is_featured' => true,
                'is_new_arrival' => true,
                'warranty_months' => 6
            ],
            [
                'name' => 'Cyberpunk 2077 - Xbox Series X',
                'short_description' => 'Futurisztikus, nyílt világú RPG a CD Projekt Red-től, next-gen frissítéssel.',
                'full_description' => 'Merülj el Night City veszélyes világában, ahol a hatalom, a luxus és a testmódosítások megszállottjai találkoznak. A Cyberpunk 2077-ben V bőrébe bújva egy halhatatlanság-kulcsot kereső zsoldos kalandjait élhetjük át. A játék hatalmas, szabadon bejárható metropoliszt kínál, ahol döntéseink alakítják a történetet és karakterünk fejlődését. Az Xbox Series X verzió next-gen frissítéssel érkezik, amely kihasználja a konzol teljes erejét.',
                'price' => 19990,
                'original_price' => 24990,
                'stock_quantity' => 15,
                'brand' => 'CD Projekt Red',
                'type' => 'Videójáték',
                'specifications' => json_encode([
                    'Platform' => 'Xbox Series X/S',
                    'Műfaj' => 'RPG',
                    'Megjelenés' => '2020 (Next-gen update: 2022)',
                    'Játékosok száma' => '1',
                    'Korhatár' => 'PEGI 18',
                    'Nyelv' => 'Magyar felirat és szinkron'
                ]),
                'status' => 'Aktív',
                'is_featured' => false,
                'is_new_arrival' => false,
                'warranty_months' => 6
            ]
        ];

        foreach ($products as $product) {
            $product['category_id'] = $categoryId;
            $product['slug'] = Str::slug($product['name']);
            $product['discount_percentage'] = $this->calculateDiscount($product['price'], $product['original_price']);
            $product['meta_title'] = $product['name'];
            $product['meta_description'] = $product['short_description'];
            $product['meta_keywords'] = $product['brand'] . ', ' . $product['type'] . ', Videójáték';
            
            $createdProduct = Product::create($product);
            
            // Alapértelmezett képeket adunk hozzá
            $this->addDefaultProductImages($createdProduct->id);
        }
    }

    /**
     * Gamer székek létrehozása
     */
    private function createChairs($categoryId)
    {
        $products = [
            [
                'name' => 'Secretlab TITAN Evo 2022',
                'short_description' => 'Prémium gamer szék 4D kartámaszokkal és mágneses fejtámasszal.',
                'full_description' => 'A Secretlab TITAN Evo 2022 a legújabb generációs gamer szék, amely ötvözi a kényelmet és a tartósságot. A szabadalmaztatott puhébb hideg formázott hab tökéletes támogatást nyújt a hosszú játékmenetek során. A 4D kartámaszok és a mágneses memóriahabos fejtámasz testre szabható kényelmet biztosít, míg a továbbfejlesztett derékpárna dinamikusan alkalmazkodik a mozgásodhoz.',
                'price' => 189990,
                'original_price' => 199990,
                'stock_quantity' => 5,
                'brand' => 'Secretlab',
                'type' => 'Gamer Szék',
                'specifications' => json_encode([
                    'Anyag' => 'NEO™ Hybrid Leatherette / SoftWeave™ Plus',
                    'Terhelhetőség' => '180 kg',
                    'Kartámaszok' => '4D mágneses',
                    'Dőlésszög' => '165°',
                    'Magasságállítás' => 'Class 4 hidraulikus',
                    'Súly' => '37.5 kg'
                ]),
                'status' => 'Aktív',
                'is_featured' => true,
                'is_new_arrival' => true,
                'warranty_months' => 36
            ],
            [
                'name' => 'noblechairs HERO',
                'short_description' => 'Prémium minőségű gamer szék beépített állítható deréktámasszal.',
                'full_description' => 'A noblechairs HERO a legigényesebb gamerek számára készült szék, amely tökéletes kombinációja a stílusnak és a funkcionalitásnak. A beépített, teljesen állítható deréktámasz és a bőséges ülőfelület hosszú játékmenetek során is biztosítja a kényelmet. A csúcsminőségű PU bőr borítás elegáns megjelenést és tartósságot biztosít, míg a hideg habos technológia optimális alátámasztást nyújt.',
                'price' => 159990,
                'original_price' => 169990,
                'stock_quantity' => 8,
                'brand' => 'noblechairs',
                'type' => 'Gamer Szék',
                'specifications' => json_encode([
                    'Anyag' => 'PU bőr / Valódi bőr opció',
                    'Terhelhetőség' => '150 kg',
                    'Kartámaszok' => '4D',
                    'Dőlésszög' => '135°',
                    'Deréktámasz' => 'Beépített, állítható',
                    'Súly' => '33 kg'
                ]),
                'status' => 'Aktív',
                'is_featured' => false,
                'is_new_arrival' => false,
                'warranty_months' => 24
            ],
            [
                'name' => 'AKRacing Core EX',
                'short_description' => 'Megfizethető, mégis prémium minőségű gamer szék.',
                'full_description' => 'Az AKRacing Core EX egy elérhető árú, de minőségi gamer szék, amely tökéletes választás a mindennapi használatra. A hideg habbal töltött ülés és háttámla hosszú órákon át biztosítja a kényelmet, míg az acél váz és az ötágú alumínium talp garantálja a tartósságot. A szék 180 fokig dönthető háttámlával, magasságállítással és 3D kartámaszokkal rendelkezik.',
                'price' => 99990,
                'original_price' => 119990,
                'stock_quantity' => 15,
                'brand' => 'AKRacing',
                'type' => 'Gamer Szék',
                'specifications' => json_encode([
                    'Anyag' => 'PU bőr / Szövet',
                    'Terhelhetőség' => '150 kg',
                    'Kartámaszok' => '3D',
                    'Dőlésszög' => '180°',
                    'Magasságállítás' => 'Class 4 hidraulikus',
                    'Súly' => '25 kg'
                ]),
                'status' => 'Aktív',
                'is_featured' => true,
                'is_new_arrival' => false,
                'warranty_months' => 24
            ]
        ];

        foreach ($products as $product) {
            $product['category_id'] = $categoryId;
            $product['slug'] = Str::slug($product['name']);
            $product['discount_percentage'] = $this->calculateDiscount($product['price'], $product['original_price']);
            $product['meta_title'] = $product['name'];
            $product['meta_description'] = $product['short_description'];
            $product['meta_keywords'] = $product['brand'] . ', ' . $product['type'] . ', Gamer Szék';
            
            $createdProduct = Product::create($product);
            
            // Alapértelmezett képeket adunk hozzá
            $this->addDefaultProductImages($createdProduct->id);
        }
    }

    /**
     * Számítógép alkatrészek létrehozása
     */
    private function createComponents($categoryId)
    {
        $products = [
            [
                'name' => 'NVIDIA GeForce RTX 4080 SUPER',
                'short_description' => 'Csúcskategóriás grafikus kártya 16GB GDDR6X memóriával.',
                'full_description' => 'Az NVIDIA GeForce RTX 4080 SUPER a legújabb Ada Lovelace architektúrán alapuló videokártya, amely kivételes teljesítményt nyújt mind a 4K játékhoz, mind a kreatív munkákhoz. A 16GB GDDR6X memória és az NVIDIA DLSS 3.5 technológia zökkenőmentes játékélményt biztosít a legigényesebb játékokban is. A sugárkövetés és az AI-alapú képjavítás új szintre emeli a vizuális élményt.',
                'price' => 549990,
                'original_price' => 599990,
                'stock_quantity' => 4,
                'brand' => 'NVIDIA',
                'type' => 'Videokártya',
                'specifications' => json_encode([
                    'GPU' => 'NVIDIA Ada Lovelace',
                    'CUDA Magok' => '10240',
                    'Memória' => '16GB GDDR6X',
                    'Memória Sávszélesség' => '736 GB/s',
                    'Csatolófelület' => 'PCIe 4.0 x16',
                    'Tápigény' => '320W'
                ]),
                'status' => 'Aktív',
                'is_featured' => true,
                'is_new_arrival' => true,
                'warranty_months' => 36
            ],
            [
                'name' => 'AMD Ryzen 9 7950X',
                'short_description' => 'Csúcsteljesítményű 16 magos processzor 5.7GHz-es órajellel.',
                'full_description' => 'Az AMD Ryzen 9 7950X a Zen 4 architektúrán alapuló processzor, amely 16 maggal és 32 szállal rendelkezik. Az 5.7GHz-es maximális órajel és a 80MB cache kivételes teljesítményt biztosít mind a játékokban, mind a professzionális alkalmazásokban. A processzor támogatja a PCIe 5.0 és DDR5 technológiákat, így jövőbiztos megoldást nyújt a legigényesebb felhasználók számára is.',
                'price' => 249990,
                'original_price' => 279990,
                'stock_quantity' => 6,
                'brand' => 'AMD',
                'type' => 'Processzor',
                'specifications' => json_encode([
                    'Architektúra' => 'Zen 4',
                    'Magok/Szálak' => '16/32',
                    'Alap órajel' => '4.5GHz',
                    'Turbó órajel' => '5.7GHz',
                    'Cache' => '80MB',
                    'TDP' => '170W'
                ]),
                'status' => 'Aktív',
                'is_featured' => true,
                'is_new_arrival' => false,
                'warranty_months' => 36
            ],
            [
                'name' => 'Samsung 990 PRO 2TB NVMe SSD',
                'short_description' => 'Ultragyors NVMe SSD 7450 MB/s olvasási sebességgel.',
                'full_description' => 'A Samsung 990 PRO a legújabb PCIe 4.0 NVMe SSD, amely lenyűgöző 7450 MB/s olvasási és 6900 MB/s írási sebességet kínál. A 2TB kapacitás bőséges tárhelyet biztosít játékok, alkalmazások és egyéb fájlok számára. A Samsung V-NAND technológia és az optimalizált vezérlő hosszú élettartamot és megbízhatóságot garantál, míg a Dynamic Thermal Guard védelmet nyújt a túlmelegedés ellen.',
                'price' => 89990,
                'original_price' => 99990,
                'stock_quantity' => 10,
                'brand' => 'Samsung',
                'type' => 'SSD',
                'specifications' => json_encode([
                    'Kapacitás' => '2TB',
                    'Csatlakozó' => 'M.2 NVMe PCIe 4.0',
                    'Olvasási sebesség' => '7450 MB/s',
                    'Írási sebesség' => '6900 MB/s',
                    'NAND típus' => 'V-NAND 3-bit MLC',
                    'MTBF' => '1.5 millió óra'
                ]),
                'status' => 'Aktív',
                'is_featured' => false,
                'is_new_arrival' => true,
                'warranty_months' => 60
            ]
        ];

        foreach ($products as $product) {
            $product['category_id'] = $categoryId;
            $product['slug'] = Str::slug($product['name']);
            $product['discount_percentage'] = $this->calculateDiscount($product['price'], $product['original_price']);
            $product['meta_title'] = $product['name'];
            $product['meta_description'] = $product['short_description'];
            $product['meta_keywords'] = $product['brand'] . ', ' . $product['type'] . ', ' . $product['name'];
            
            $createdProduct = Product::create($product);
            
            // Alapértelmezett képeket adunk hozzá
            $this->addDefaultProductImages($createdProduct->id);
        }
    }

    /**
     * Gamer kiegészítők létrehozása
     */
    private function createAccessories($categoryId)
    {
        $products = [
            [
                'name' => 'Razer Gigantus V2 XXL',
                'short_description' => 'Extra nagy méretű gamer egérpad optimalizált szövetfelülettel.',
                'full_description' => 'A Razer Gigantus V2 XXL egy prémium minőségű, asztalt borító egérpad, amely optimális felületet biztosít az egerek számára. A mikroszövött felület tökéletes egyensúlyt teremt a sebesség és a kontroll között, míg a csúszásgátló gumialap megakadályozza az elmozdulást. Az egérpad 3 mm vastag habos belső rétege kényelmes támaszt nyújt a csuklónak a hosszú játékmenetek során.',
                'price' => 14990,
                'original_price' => 16990,
                'stock_quantity' => 20,
                'brand' => 'Razer',
                'type' => 'Egérpad',
                'specifications' => json_encode([
                    'Méret' => '940 x 410 mm (XXL)',
                    'Vastagság' => '3 mm',
                    'Anyag' => 'Mikroszövött textil',
                    'Alap' => 'Csúszásgátló gumi',
                    'Szegély' => 'Varrott',
                    'Felület típusa' => 'Hibrid (sebesség és kontroll)'
                ]),
                'status' => 'Aktív',
                'is_featured' => false,
                'is_new_arrival' => false,
                'warranty_months' => 12
            ],
            [
                'name' => 'Glorious Model O Wireless',
                'short_description' => 'Ultrakönnyű (69g) vezeték nélküli egér méhsejt dizájnnal.',
                'full_description' => 'A Glorious Model O Wireless a legnépszerűbb könnyű gaming egér vezeték nélküli változata. A mindössze 69 grammos súly és a méhsejt kialakítás tökéletes irányíthatóságot biztosít, míg a BAMF szenzor precíz követést és alacsony látenciát garantál. Az egér 71 órás üzemidővel rendelkezik, és a Glorious szoftverrel testreszabható RGB világítást és gombfunkciókat kínál.',
                'price' => 34990,
                'original_price' => 39990,
                'stock_quantity' => 15,
                'brand' => 'Glorious',
                'type' => 'Egér',
                'specifications' => json_encode([
                    'Szenzor' => 'BAMF 19K DPI',
                    'Súly' => '69g',
                    'Csatlakozás' => '2.4GHz vezeték nélküli',
                    'Akkumulátor' => '71 óra',
                    'Kapcsolók' => 'Glorious mechanikus (80M)',
                    'Méret' => '128 x 66 x 37.5 mm'
                ]),
                'status' => 'Aktív',
                'is_featured' => true,
                'is_new_arrival' => true,
                'warranty_months' => 24
            ],
            [
                'name' => 'Blue Yeti X',
                'short_description' => 'Professzionális minőségű USB mikrofon streameléshez és podcastokhoz.',
                'full_description' => 'A Blue Yeti X egy csúcsminőségű négy kapszulás kondenzátor mikrofon, amely professzionális hangminőséget biztosít a játékközvetítésekhez, podcastokhoz és YouTube-videókhoz. A valós idejű LED mérővel könnyen beállíthatod a megfelelő hangerőt, a Blue VO!CE technológia pedig hangeffektusok és szűrők széles választékát kínálja. A mikrofon négy iránykarakterisztikával rendelkezik, így bármilyen felvételi helyzethez alkalmazkodik.',
                'price' => 49990,
                'original_price' => 54990,
                'stock_quantity' => 8,
                'brand' => 'Blue Microphones',
                'type' => 'Mikrofon',
                'specifications' => json_encode([
                    'Típus' => 'Kondenzátor',
                    'Kapszulák' => '4 kapszulás',
                    'Iránykarakterisztikák' => 'Kardioid, Kétirányú, Gömbkarakterisztika, Sztereó',
                    'Mintavételezés' => '24-bit/48kHz',
                    'Csatlakozás' => 'USB',
                    'Monitorozás' => 'Nullakésleltetésű fejhallgató kimenet'
                ]),
                'status' => 'Aktív',
                'is_featured' => true,
                'is_new_arrival' => false,
                'warranty_months' => 24
            ]
        ];

        foreach ($products as $product) {
            $product['category_id'] = $categoryId;
            $product['slug'] = Str::slug($product['name']);
            $product['discount_percentage'] = $this->calculateDiscount($product['price'], $product['original_price']);
            $product['meta_title'] = $product['name'];
            $product['meta_description'] = $product['short_description'];
            $product['meta_keywords'] = $product['brand'] . ', ' . $product['type'] . ', Kiegészítő';
            
            $createdProduct = Product::create($product);
            
            // Alapértelmezett képeket adunk hozzá
            $this->addDefaultProductImages($createdProduct->id);
        }
    }

    /**
     * Alapértelmezett termékképek hozzáadása
     */
    private function addDefaultProductImages($productId)
    {
        // Fő kép
        ProductImage::create([
            'product_id' => $productId,
            'image_path' => 'images/products/default-product.jpg',
            'is_primary' => true,

            'alt' => 'Alapértelmezett termék fotó'
        ]);

        // További képek
        ProductImage::create([
            'product_id' => $productId,
            'image_path' => 'images/products/default-product-2.jpg',
            'is_primary' => false,
            'alt' => 'Alapértelmezett termék fotó 2'
        ]);

        ProductImage::create([
            'product_id' => $productId,
            'image_path' => 'images/products/default-product-3.jpg',
            'is_primary' => false,
            'alt' => 'Alapértelmezett termék fotó 3'
        ]);
    }

    /**
     * Kedvezmény százalék kiszámítása
     */
    private function calculateDiscount($price, $originalPrice)
    {
        if ($originalPrice > $price && $originalPrice > 0) {
            return round((1 - ($price / $originalPrice)) * 100);
        }
        return 0;
    }
}