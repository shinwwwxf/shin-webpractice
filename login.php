<!<!DOCTYPE html>
<html lang="zh-Hant">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>登入</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
<?php
session_start();
require_once 'db.php'; // 連資料庫

$msg = '';

if ($_POST) {
    $account = $_POST["account"] ?? "";
    $password = $_POST["password"] ?? "";

    if (empty($account) || empty($password)) {
        $msg = "請輸入帳號與密碼";
    } else {
        // 從資料庫抓帳號
        $sql = "SELECT * FROM user WHERE account = '$account'";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);

            if ($password === $user['password']) {
                $_SESSION['user'] = $user['name'];
                $_SESSION['account'] = $user['account'];
                $_SESSION['role'] = $user['role'];

                $redirect = $_SESSION['redirect_after_login'] ?? 'newindex.php';
                unset($_SESSION['redirect_after_login']);

                header("Location: $redirect");
                exit;
            } else {
                $msg = "密碼錯誤";
            }
        } else {
            $msg = "查無此帳號";
        }
    }
} else {
    $msg = $_GET["msg"] ?? "";
}
?>
  <div class="row justify-content-center">
    <div class="col-md-4">
      <div class="card shadow">
        <div class="card-body">
          <h4 class="card-title mb-4">登入</h4>
          <form method="post" action="login.php">
            <div class="mb-3">
              <label for="account" class="form-label">帳號</label>
              <input type="text" class="form-control" id="account" name="account" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">密碼</label>
              <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">登入</button>
          </form>
          <?php if (!empty($msg)): ?>
            <div class="alert alert-danger mt-3" role="alert">
              <?=htmlspecialchars($msg)?>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
<?php mysqli_close($conn); ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
