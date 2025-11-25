<?php
session_start();

if ($_SESSION['role'] != 'M') {
    include('newheader.php');
    $message = '只有管理員可以新增活動';
    ?>
    <div class="alert alert-primary" role="alert">
        <?= htmlspecialchars($message) ?>
    </div>
    <?php
    include('newfooter.php');
    exit;
}
try {
  require_once 'db.php';
  $msg="";
  if ($_POST) {
    // insert data
    $name = $_POST["name"];
    $description = $_POST["description"];
    $sql="insert into newactivity (name, description) values (?, ?)";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $name, $description);
    $result = mysqli_stmt_execute($stmt);
    if ($result) {
      header('Location: newindex.php');
      exit;
    }
    else {
      $msg = "無法新增資料";
    }
  }
  require_once "newheader.php";
?>


<div class="container">
<form action="activity_insert.php" method="post">
  <div class="mb-3 row">
    <label for="_name" class="col-sm-2 col-form-label">活動名稱</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="name" id="_name" placeholder="輸入活動名稱" required>
    </div>
  </div>
  <div class="mb-3">
    <label for="_description" class="form-label">活動內容</label>
    <textarea class="form-control" name="description" id="_description" rows="10" required></textarea>
  </div>
  <input class="btn btn-primary" type="submit" value="送出">
  <?=$msg?>
</form>
</div>



<?php
  mysqli_close($conn);
}
//catch exception
catch(Exception $e) {
  echo 'Message: ' .$e->getMessage();
}
require_once "newfooter.php";

?>