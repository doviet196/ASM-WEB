<?php
session_start();
require 'db.php';
$user = $_SESSION['user'] ?? null;

// Lấy 4 sản phẩm mới nhất
$stmt = $pdo->query("SELECT * FROM products ORDER BY id DESC LIMIT 4");
$featured = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Trang chủ - BTEC Furniture</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #f2f4f8;
      color: #333;
      margin: 0;
    }
    header {
      background-color: #003366;
      padding: 15px 40px;
      color: white;
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
    }
    .logo img {
      height: 50px;
    }
    .navigation ul {
      list-style: none;
      display: flex;
      gap: 20px;
    }
    .navigation ul li a {
      color: white;
      font-weight: bold;
      text-decoration: none;
      padding: 8px 14px;
      border-radius: 6px;
    }
    .navigation ul li a.active,
    .navigation ul li a:hover {
      background-color: rgba(255,255,255,0.2);
      color: #ffcc00;
    }
    .hero-banner {
      background: linear-gradient(to right, #003366, #005b8d);
      color: white;
      padding: 60px 20px;
      text-align: center;
      border-radius: 10px;
      margin: 30px auto;
      max-width: 1100px;
    }
    .hero-banner h1 {
      font-size: 36px;
      margin-bottom: 10px;
    }
    .hero-banner span {
      color: #ffc107;
    }
    .hero-banner p {
      font-size: 18px;
      color: #ddd;
    }

    main {
      max-width: 1200px;
      margin: auto;
      padding: 20px;
      background: white;
      border-radius: 10px;
      box-shadow: 0 4px 16px rgba(0,0,0,0.05);
    }

    .section-header {
      text-align: center;
      font-size: 28px;
      color: #003366;
      margin: 40px 0 20px;
    }

    .products {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
      gap: 25px;
    }

    .product-card {
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.08);
      overflow: hidden;
      text-align: center;
      transition: transform 0.3s ease;
    }

    .product-card:hover {
      transform: translateY(-5px);
    }

    .product-card img {
      width: 100%;
      height: 200px;
      object-fit: cover;
    }

    .product-info {
      padding: 15px;
    }

    .product-info h4 {
      font-size: 16px;
      margin-bottom: 8px;
    }

    .product-info .price {
      color: #e67e22;
      font-weight: bold;
    }

    .view-more {
      text-align: center;
      margin: 30px 0;
    }

    .view-more a {
      background-color: #003366;
      color: white;
      padding: 10px 20px;
      border-radius: 6px;
      text-decoration: none;
      font-weight: bold;
      transition: background 0.3s;
    }

    .view-more a:hover {
      background-color: #0056b3;
    }

    footer {
      background: #003366;
      color: white;
      text-align: center;
      padding: 20px;
      margin-top: 40px;
    }

    @media (max-width: 768px) {
      .product-card img {
        height: 160px;
      }
    }
  </style>
</head>
<body>

<header>
  <div class="logo"><a href="noithat.php"><img src="logo.jpg" alt="Logo" /></a></div>
  <nav class="navigation">
    <ul>
      <li><a href="noithat.php" class="active">Trang chủ</a></li>
      <li><a href="sanpham.php">Sản phẩm</a></li>
      <?php if ($user): ?>
        <li><a href="profile.php">Hồ sơ</a></li>
        <li><a href="logout.php">Đăng xuất</a></li>
        <li style="color:#ffc107;">👤 <?= htmlspecialchars($user['username']) ?></li>
      <?php else: ?>
        <li><a href="login.php">Đăng nhập</a></li>
        <li><a href="register.php">Đăng ký</a></li>
      <?php endif; ?>
    </ul>
  </nav>
</header>

<main>
  <section class="hero-banner">
    <h1>👋 Chào mừng đến với <span>BTEC Furniture Store</span></h1>
    <p>Khám phá nội thất cao cấp, hiện đại và tiện nghi cho mọi không gian sống</p>
  </section>

  <h2 class="section-header">🌟 Sản phẩm nổi bật</h2>
  <div class="products">
    <?php foreach ($featured as $p): ?>
      <div class="product-card">
        <img src="uploads/<?= htmlspecialchars($p['image']) ?>" alt="<?= htmlspecialchars($p['name']) ?>">
        <div class="product-info">
          <h4><?= htmlspecialchars($p['name']) ?></h4>
          <p class="price"><?= number_format($p['price']) ?> VND</p>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <div class="view-more">
    <a href="sanpham.php">Xem thêm sản phẩm</a>
  </div>
</main>

<footer>
  © 2024 BTEC Furniture Store
</footer>

</body>
</html>
