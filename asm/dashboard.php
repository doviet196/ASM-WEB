<?php
session_start();
require 'db.php';

// Chỉ cho admin truy cập
if (!isset($_SESSION['user']) || strtolower($_SESSION['user']['role']) !== 'admin') {
    header('Location: login.php');
    exit;
}

$adminName = $_SESSION['user']['username'] ?? 'Admin';

// Đếm số lượng
$userCount = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
$productCount = $pdo->query("SELECT COUNT(*) FROM products")->fetchColumn();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Bảng điều khiển - Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { display: flex; min-height: 100vh; }
    .sidebar {
      width: 220px;
      background: #343a40;
      color: white;
      padding: 1rem;
    }
    .sidebar a {
      color: white;
      text-decoration: none;
      padding: 10px 0;
      display: block;
    }
    .sidebar a:hover {
      background-color: #495057;
      border-radius: 5px;
      padding-left: 10px;
    }
    .main {
      flex: 1;
      padding: 2rem;
      background-color: #f8f9fa;
    }
    .card {
      border: none;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      transition: 0.3s;
    }
    .card:hover {
      transform: scale(1.01);
    }
  </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
  <h5 class="text-center mb-4">🛠️ Admin Dashboard</h5>
  <a href="dashboard.php">🏠 Trang chủ</a>
  <a href="users.php">👥 Quản lý người dùng</a>
  <a href="products.php">📦 Quản lý sản phẩm</a>
  <a href="logout.php" class="text-danger">🚪 Đăng xuất</a>
</div>

<!-- Main content -->
<div class="main">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h3>🎉 Chào mừng <span class="text-primary"><?= htmlspecialchars($adminName) ?></span>!</h3>
    <a href="logout.php" class="btn btn-outline-secondary">Đăng xuất</a>
  </div>

  <div class="row g-4 mb-4">
    <div class="col-md-6">
      <div class="card text-white bg-primary">
        <div class="card-body">
          <h5 class="card-title">👥 Người dùng</h5>
          <p class="card-text">Tổng: <strong><?= $userCount ?></strong> tài khoản</p>
          <a href="users.php" class="btn btn-light btn-sm">Xem danh sách</a>
          <a href="add_user.php" class="btn btn-outline-light btn-sm">Thêm mới</a>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card text-white bg-success">
        <div class="card-body">
          <h5 class="card-title">📦 Sản phẩm</h5>
          <p class="card-text">Tổng: <strong><?= $productCount ?></strong> mặt hàng</p>
          <a href="products.php" class="btn btn-light btn-sm">Xem danh sách</a>
          <a href="add_product.php" class="btn btn-outline-light btn-sm">Thêm mới</a>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6">
  <div class="card border-0 shadow-sm">
    <div class="card-body">
      <h5 class="card-title">📦 Đơn hàng</h5>
      <p class="card-text">Xem và quản lý đơn hàng khách đặt.</p>
      <a href="orders.php" class="btn btn-info btn-sm">Xem đơn hàng</a>
    </div>
  </div>
</div>
  <div class="alert alert-info">
    📌 Đây là bảng điều khiển quản trị viên. Bạn có thể quản lý người dùng và sản phẩm tại đây.
  </div>
</div>

</body>
</html>
