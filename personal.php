<?php
require_once "newheader.php";
require_once "db.php";

// 檢查是否登入
$account = $_SESSION['account'] ?? null;
if (!$account) {
    header("Location: login.php");
    exit;
}

$message = "";

// 取得使用者資料
$stmt = mysqli_prepare($conn, "SELECT account, name, password FROM newuser WHERE account = ?");
mysqli_stmt_bind_param($stmt, "s", $account);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

if (!$user) {
    die("查無此使用者");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_name = trim($_POST['name']);
    $old_password = $_POST['old_password'] ?? '';
    $new_password = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    $errors = [];

    if ($new_name === '') {
        $errors[] = "姓名不能為空";
    }

    $update_password = false;
    if ($old_password || $new_password || $confirm_password) {
        if ($old_password !== $user['password']) {
            $errors[] = "舊密碼不正確";
        } elseif ($new_password !== $confirm_password) {
            $errors[] = "新密碼與確認密碼不相符";
        } elseif ($new_password === '') {
            $errors[] = "新密碼不能為空";
        } else {
            $update_password = true;
        }
    }

    // 無錯誤時更新資料
    if (empty($errors)) {
        if ($update_password) {
            $sql = "UPDATE newuser SET name = ?, password = ? WHERE account = ?";
            $stmt_update = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt_update, "sss", $new_name, $new_password, $account);
        } else {
            $sql = "UPDATE newuser SET name = ? WHERE account = ?";
            $stmt_update = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt_update, "ss", $new_name, $account);
        }

        if (mysqli_stmt_execute($stmt_update)) {
            $_SESSION['name'] = $new_name;
            $user['name'] = $new_name;
            $message = "資料更新成功";
        } else {
            $message = "更新失敗：" . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt_update);
    } else {
        $message = implode("<br>", $errors);
    }
}

mysqli_stmt_close($stmt);
?>

<div class="container mt-5">
    <h3>個人資料</h3>
    <?php if ($message): ?>
        <div class="alert alert-info"><?= $message ?></div>
    <?php endif; ?>
    <form method="post">
        <div class="mb-3">
            <label>帳號</label>
            <input type="text" class="form-control" value="<?= htmlspecialchars($user['account']) ?>" disabled>
        </div>
        <div class="mb-3">
            <label>姓名</label>
            <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($user['name']) ?>" required>
        </div>
        <hr>
        <h5>修改密碼</h5>
        <div class="mb-3">
            <label>舊密碼</label>
            <input type="password" name="old_password" class="form-control">
        </div>
        <div class="mb-3">
            <label>新密碼</label>
            <input type="password" name="new_password" class="form-control">
        </div>
        <div class="mb-3">
            <label>確認新密碼</label>
            <input type="password" name="confirm_password" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">更新資料</button>
    </form>
</div>

<?php
mysqli_close($conn);
require_once "newfooter.php";
?>