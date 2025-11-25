<?php
session_start();

if ($_SESSION['role'] != 'M') {
    include('newheader.php');
    $message = '只有管理員可以修改活動';
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
        $action = $_GET["action"] ?? "";
        
        if ($action == "confirmed") {
            // update data
            $postid = $_GET["postid"];
            $name = $_POST["name"];
            $description = $_POST["description"];
            
            $sql = "UPDATE newactivity SET name=?, description=? WHERE id=?";
            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt, $sql);
            mysqli_stmt_bind_param($stmt, "ssi", $name, $description, $postid);
            $result = mysqli_stmt_execute($stmt);
            
            mysqli_close($conn);
            header('location:newindex.php');
            exit;
        } else {
            // show data
            $postid = $_GET["postid"];
            $sql = "SELECT id, name, description FROM newactivity WHERE id=?";    
            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt, $sql);
            mysqli_stmt_bind_param($stmt, "i", $postid);
            $res = mysqli_stmt_execute($stmt);
            
            if ($res) {
                mysqli_stmt_bind_result($stmt, $id, $name, $description);
                mysqli_stmt_fetch($stmt);
            }
            
            mysqli_close($conn);
        } // confirmed else
    } // $_GET
} catch(Exception $e) {
    echo 'Message: ' .$e->getMessage();
}

require_once "newheader.php";
?>

<div class="container">
  <form action="activity_update.php?postid=<?= $postid ?>&action=confirmed" method="post">
    <div class="mb-3 row">
      <label for="_name" class="col-sm-2 col-form-label">活動名稱</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="name" id="_name" 
               placeholder="活動名稱" value="<?= htmlspecialchars($name) ?>" required>
      </div>
    </div>
    <div class="mb-3">
      <label for="_description" class="form-label">活動內容</label>
      <textarea class="form-control" id="_description" name="description" 
                rows="10" required><?= htmlspecialchars($description) ?></textarea>
    </div>
    <input class="btn btn-primary" type="submit" value="送出">
  </form>
</div>

<?php
require_once "newfooter.php";
?>
