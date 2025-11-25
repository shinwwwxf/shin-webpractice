<?php
session_start();
include('newheader.php');
try {
    require_once 'db.php'; 
    $sql = "SELECT * FROM newactivity";
    $result = mysqli_query($conn, $sql);
?>

<main class="container mt-4">  
  <a href="activity_insert.php" class="btn btn-danger">新增活動＋</a>
  <form action="" method="post">
    <fieldset>
      <div class="container mt-4">
        <div class="row">
          <?php while($row = mysqli_fetch_assoc($result)) { ?>
            <div class="col-md-6">
              <h1><?= htmlspecialchars($row["name"]) ?></h1>
              <div class="card mb-2 border-danger">
                <div class="card-body">
                  <h5 class="card-subtitle mb-2 text-muted">
                    <?= htmlspecialchars($row["description"]) ?>
                  </h5>
                  <a href="activity_update.php?postid=<?= $row['id'] ?>" class="btn btn-primary btn-sm">修改</a>
                  <a href="activity_delete.php?postid=<?= $row['id'] ?>" class="btn btn-danger btn-sm">刪除</a>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
    </fieldset>
  </form>
</main>



<?php
    mysqli_close($conn);
} catch(Exception $e) {
    echo 'Message: ' . $e->getMessage();
}

require_once "newfooter.php"; 
?>
