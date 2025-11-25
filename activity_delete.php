<?php
session_start();

if ($_SESSION['role'] != 'M') {
    include('newheader.php');
    $message = '只有管理員可以刪除活動';
    ?>
    <div class="alert alert-primary" role="alert">
        <?= htmlspecialchars($message) ?>
    </div>
    <?php
    include('newfooter.php');
    exit;
}
try {
  $postid = "";
  $name = "";
  $description = "";
  if ($_GET) {
    require_once 'db.php';
    $action = $_GET["action"]??"";
    if ($action=="confirmed"){
      //delete data
      $id = $_GET["id"];
      $sql="delete from newactivity where id=?";
      $stmt = mysqli_stmt_init($conn);
      mysqli_stmt_prepare($stmt, $sql);
      mysqli_stmt_bind_param($stmt, "i", $id);
      $result = mysqli_stmt_execute($stmt);
      mysqli_close($conn);
      header('Location:newindex.php');
    }
    else{
      //show data
      $id = $_GET["postid"];
      $sql="select id,name,description from newactivity where id=?";    
      // $result = mysqli_query($conn, $sql);
      $stmt = mysqli_stmt_init($conn);
      mysqli_stmt_prepare($stmt, $sql);
      mysqli_stmt_bind_param($stmt, "i", $id);
      $res = mysqli_stmt_execute($stmt);
      if ($res){
        mysqli_stmt_bind_result($stmt, $id, $name, $description);
        mysqli_stmt_fetch($stmt);
      }
      mysqli_close($conn);
    }//confirmed else
  }//$_GET
} catch(Exception $e) {
  echo 'Message: ' .$e->getMessage();
}
require_once "newheader.php";
?>
<div class="container">
  <table class="table table-bordered table-striped">
    <tr>
      <td>活動名稱</td>
      <td>活動內容</td>
    </tr>
    <tr>
      <td><?=$name?></td>
      <td><?=$description?></td>
    </tr>
  </table>
  <a href="activity_delete.php?id=<?=$id?>&action=confirmed" class="btn btn-danger">刪除</a>
</div>
<?php
require_once "newfooter.php";
?>