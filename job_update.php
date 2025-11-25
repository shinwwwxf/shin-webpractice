<?php
session_start();

if ($_SESSION['role'] != 'M') {
    include('newheader.php');
    $message = '只有管理員可以修改職缺';
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
  $company = "";
  $content = "";
  $pdate = "";
  if ($_GET) {
    require_once 'db.php';
    $action = $_GET["action"]??"";
    
    if ($action=="confirmed"){
      //update data
      $postid = $_GET["postid"];
      $company = $_POST["company"];
      $content = $_POST["content"];
      $sql="update job set company=?, content=? where postid=?";
      $stmt = mysqli_stmt_init($conn);
      mysqli_stmt_prepare($stmt, $sql);
      mysqli_stmt_bind_param($stmt, "ssi", $company, $content, $postid);
      $result = mysqli_stmt_execute($stmt);
      mysqli_close($conn);
      header('location:job.php');
    }
    else{
      //show data
      $postid = $_GET["postid"];
      $sql="select postid, company, content, pdate from job where postid=?";    
      // $result = mysqli_query($conn, $sql);
      $stmt = mysqli_stmt_init($conn);
      mysqli_stmt_prepare($stmt, $sql);
      mysqli_stmt_bind_param($stmt, "i", $postid);
      $res = mysqli_stmt_execute($stmt);
      if ($res){
        mysqli_stmt_bind_result($stmt, $postid, $company, $content, $pdate);
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
  <form action="job_update.php?postid=<?=$postid?>&action=confirmed" method="post">
  <div class="mb-3 row">
    <label for="_company" class="col-sm-2 col-form-label">求才廠商</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="company" id="_company" 
        placeholder="公司名稱" value="<?=$company?>" required>
    </div>
  </div>
  <div class="mb-3">
    <label for="_content" class="form-label">求才內容</label>
    <textarea class="form-control" id="_content" name="content" 
      rows="10" required><?=$content?></textarea>
  </div>
  <input class="btn btn-primary" type="submit" value="送出">
  </form>
</div>
<?php
require_once "newfooter.php";
?>