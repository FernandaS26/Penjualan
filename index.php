<?php 
    include 'db.php';
    $kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = 1");
    $a = mysqli_fetch_object($kontak);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Catering Barokah</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        /* Reset CSS */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f5dc; /* Light Beige Background */
            color: #3e2723; /* Dark Brown Text */
            line-height: 1.6;
        }

        /* Container */
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }

        /* Header */
        header {
            background: #7b4b24; /* Deep Brown */
            color: #fff;
            padding: 20px 0;
            text-align: center;
            border-bottom: 4px solid #d7ccc8; /* Light Brown Border */
        }

        header h1 {
            margin-bottom: 10px;
        }

        header ul {
            padding: 0;
            list-style: none;
            display: flex;
            justify-content: center;
        }

        header ul li {
            margin: 0 15px;
        }

        header ul li a {
            color: #fff;
            text-decoration: none;
            font-size: 18px;
            transition: color 0.3s;
        }

        header ul li a:hover {
            color: #d7ccc8; /* Light Brown on Hover */
        }

        /* Search Bar */
        .search {
            text-align: center;
            margin: 20px 0;
        }

        .search input[type="text"] {
            padding: 10px;
            width: 60%;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
            color: #3e2723; /* Dark Brown */
        }

        .search input[type="submit"] {
            padding: 10px;
            background: #d7ccc8; /* Light Brown Button */
            color: #3e2723; /* Dark Brown Text */
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .search input[type="submit"]:hover {
            background: #bcaaa4; /* Darker Light Brown on Hover */
        }

        /* Section */
        .section {
            margin: 30px 0;
            text-align: center;
        }

        .section h3 {
            margin-bottom: 20px;
            color: #7b4b24; /* Deep Brown Section Headings */
            font-size: 24px;
            text-transform: uppercase;
        }

        /* Category Box */
        .category-box {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .category-box a {
            padding: 10px 20px;
            background: #8d6e63; /* Brown */
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
            transition: background 0.3s;
        }

        .category-box a:hover {
            background: #a1887f; /* Lighter Brown on Hover */
        }

        /* New Products */
        .box {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .box .col-4 {
            background: #fce4ec; /* Very Light Pink Card Background */
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 15px;
            transition: transform 0.2s;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .box .col-4:hover {
            transform: translateY(-5px);
            background: #f8bbd0; /* Slightly Darker Light Pink on Hover */
        }

        .box img {
            max-width: 100%;
            border-radius: 5px;
            margin-bottom: 10px; /* Space between Image and Text */
        }

        .box .nama {
            font-weight: bold;
            margin: 5px 0;
        }

        .box .harga {
            color: #d32f2f; /* Price Color */
            font-weight: bold;
        }

        /* Footer */
        .footer {
            background: #7b4b24; /* Deep Brown Footer */
            color: #fff;
            padding: 20px 0;
            text-align: center;
            margin-top: 30px;
        }

        .footer h4 {
            margin-bottom: 10px;
        }

        .footer p {
            margin-bottom: 5px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            header ul {
                flex-direction: column;
                margin: 10px 0;
            }

            .search input[type="text"],
            .search input[type="submit"] {
                width: 90%;
                margin-bottom: 10px;
            }
        }

        @media (max-width: 480px) {
            .container {
                width: 95%;
            }

            .search input[type="text"], .search input[type="submit"] {
                width: 100%;
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <h1><a href="index.php">Catering Barokah</a></h1>
        <ul>
            <li><a href="produk.php">Produk</a></li>
        </ul>   
    </header>
    
    <!-- Search Bar -->
    <div class="search">
        <form action="produk.php">
            <input type="text" name="search" placeholder="Cari Produk" required>
            <input type="submit" name="cari" value="Cari Produk">
        </form>
    </div>

    <!-- Category Section -->
    <div class="section">
        <h3>Kategori</h3>
        <div class="category-box">
            <?php 
                $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                if(mysqli_num_rows($kategori) > 0){
                    while($k = mysqli_fetch_array($kategori)){
            ?>
            <a href="produk.php?kat=<?php echo $k['category_id'] ?>">
                <?php echo $k['category_name'] ?>
            </a>
            <?php }} else { ?>
                <p>Kategori tidak ada</p>
            <?php } ?>
        </div>
    </div>

    <!-- New Products Section -->
    <div class="section">
        <h3>Produk Terbaru</h3>
        <div class="box">
            <?php
                $produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_status = 1 ORDER BY product_id DESC LIMIT 8");
                if(mysqli_num_rows($produk) > 0 ){
                    while($p = mysqli_fetch_array($produk)){
            ?>
            <a href="detail-produk.php?id=<?php echo $p['product_id'] ?>">
                <div class="col-4">
                    <img src="produk/<?php echo $p['product_image'] ?>" alt="<?php echo $p['product_name']; ?>">
                    <p class="nama"><?php echo $p['product_name'] ?></p>
                    <p class="harga">Rp. <?php echo number_format($p['product_price']) ?></p>
                </div>
            </a>
            <?php }} else { ?>
                <p>Produk tidak ada</p>
            <?php }?>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <h4>Alamat</h4>
        <p><?php echo $a->admin_address ?></p>

        <h4>Email</h4>
        <p><?php echo $a->admin_email ?></p>

        <h4>No. HP</h4>
        <p><?php echo $a->admin_telp ?></p>
        <small>Copyright &copy; 2022 - Catering BAROKAH</small>
    </div>
</body>
</html>
