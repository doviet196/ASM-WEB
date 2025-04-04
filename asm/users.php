<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user']) || strtolower($_SESSION['user']['role']) !== 'admin') {
    header("Location: ../login.php");
    exit;
}

$users = $pdo->query("SELECT * FROM users ORDER BY id DESC")->fetchAll();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Quản lý người dùng</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

  <h2>👥 Danh sách người dùng</h2>
  <a href="dashboard.php" class="btn btn-outline-secondary mb-3">← Quay lại trang chính</a>
  <a href="add_user.php" class="btn btn-success mb-3">➕ Thêm người dùng</a>

  <!-- Hiển thị thông báo -->
  <?php if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <?= $_SESSION['success'] ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php unset($_SESSION['success']); ?>
  <?php endif; ?>

  <?php if (count($users) > 0): ?>
    <table class="table table-bordered align-middle">
      <thead class="table-dark">
        <tr>
          <th>Ảnh</th>
          <th>Tên đăng nhập</th>
          <th>Email</th>
          <th>Vai trò</th>
          <th>Hành động</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($users as $u): ?>
          <?php $avatar = $u['avatar'] ?? 'default.jpg'; ?>
          <tr>
            <td><img src="../uploads/<?= htmlspecialchars($avatar) ?>" width="40" height="40" style="border-radius:50%"></td>
            <td><?= htmlspecialchars($u['username']) ?></td>
            <td><?= htmlspecialchars($u['email']) ?></td>
            <td><?= htmlspecialchars($u['role']) ?></td>
            <td>
              <a href="edit_user.php?id=<?= $u['id'] ?>" class="btn btn-sm btn-primary">Sửa</a>
              <a href="delete_user.php?id=<?= $u['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Bạn chắc chắn muốn xoá?')">Xoá</a>
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  <?php else: ?>
    <div class="alert alert-info">Chưa có người dùng nào.</div>
  <?php endif; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
