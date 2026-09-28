<?php
$products = [
    ["nama"=> "Monitor 24 Inch", "kategori" => "Monitor", "harga"=> 1800000,"stok"=> 4],
    ["nama"=> "Laptop LOQ", "kategori"=> "Laptop", "harga"=> 8500000,"stok"=> 3],
    ["nama"=> "Mouse Fantech", "kategori" => "Aksesoris", "harga"=> 250000, "stok"=> 0],
    ["nama"=> "Keyboard Logitech", "kategori" => "Aksesoris", "harga"=> 750000,"stok"=> 10],
    ["nama"=> "SSD Samsung 1TB", "kategori" => "Storage", "harga"=> 1250000, "stok"=> 6],
    ["nama"=> "Earbuds Xiaomi", "kategori" => "Audio", "harga"=> 450000, "stok"=> 8],
];

const BATAS_DISKON = 1000000;
const PERSEN_DISKON = 10;
$totalProduk = count($products);
function formatRupiah($angka)
{
    return "Rp" . number_format($angka, 0, ",", ".");
}
function hitungHargaSetelahDiskon($harga, $persen)
{
    return $harga - ($harga * $persen / 100);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cia Store - Katalog Produk</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="navbar">
        <div class="container">
            <div class="logo">Cia Store</div>
            <nav>
                <ul class="nav-menu">
                    <li><a href="#home">Home</a></li>
                    <li><a href="#products">Products</a></li>
                    <li><a href="#footer">About</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <section class="hero" id="home">
            <div class="container">
                <div class="hero-box">
                    <p class="hero-label">CIA STORE</p>
                    <h1>Simple Tech Store.</h1>
                    <p>Temukan berbagai perangkat dan aksesoris teknologi untuk kebutuhanmu.</p>
                    <a href="#products" class="hero-btn">Lihat Produk</a>
                </div>
            </div>
        </section>
        <section id="products">
            <div class="container">

                <div class="catalog-header">
                    <div>
                        <p class="section-label">OUR PRODUCTS</p>
                        <h2>Katalog Produk</h2>
                    </div>
                    <span class="total-info">Total Produk: <?= $totalProduk; ?></span>
                </div>

                <div class="product-grid">
                    <?php foreach ($products as $produk) : ?>
                        <?php
                        $dapatDiskon = $produk["harga"] >= BATAS_DISKON;
                        if ($dapatDiskon) {
                            $hargaAkhir = hitungHargaSetelahDiskon($produk["harga"], PERSEN_DISKON);
                        } else {
                            $hargaAkhir = $produk["harga"];
                        }
                        if ($produk["stok"] > 0) {
                            $status      = "Tersedia";
                            $classStatus = "status-tersedia";
                        } else {
                            $status      = "Stok Habis";
                            $classStatus = "status-habis";
                        }
                        ?>
                        <article class="product-card">
                            <div class="card-top">
                                <span class="kategori"><?= $produk["kategori"]; ?></span>
                                <?php if ($dapatDiskon) : ?>
                                    <span class="badge-diskon">DISKON <?= PERSEN_DISKON; ?>%</span>
                                <?php endif; ?>
                            </div>

                            <h3 class="product-name"><?= $produk["nama"]; ?></h3>

                            <?php if ($dapatDiskon) : ?>
                                <span class="harga-normal"><?= formatRupiah($produk["harga"]); ?></span>
                                <span class="harga-final"><?= formatRupiah($hargaAkhir); ?></span>
                            <?php else : ?>
                                <span class="harga-final"><?= formatRupiah($produk["harga"]); ?></span>
                            <?php endif; ?>

                            <hr class="card-divider">

                            <div class="card-stock">
                                <span>Stok: <?= $produk["stok"]; ?></span>
                                <span class="<?= $classStatus; ?>"><?= $status; ?></span>
                            </div>

                            <?php if ($produk["stok"] > 0) : ?>
                                <button class="buy-button">Beli Sekarang</button>
                            <?php else : ?>
                                <button class="buy-button" disabled>Beli Sekarang</button>
                            <?php endif; ?>
                        </article>

                    <?php endforeach; ?>
                </div>

            </div>
        </section>
    </main>

    <footer class="footer" id="footer">
        <div class="container">
            <p>&copy; <?= date("Y"); ?> Cia Store. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
