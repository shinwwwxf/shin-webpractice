<?php
session_start();
if (empty($_SESSION['user'])) {
    $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI'];
    header("Location: login.php");
    exit;
}
include('newheader.php');
?>
<?php
require_once "newheader.php";

try {
    require_once 'db.php';

    $sql = "SELECT * FROM job";
    $result = mysqli_query($conn, $sql);
?>

     <!-- 搜尋/排序表單 -->
  <?php
$sort_fields = [
    'company' => '求才廠商',
    'content' => '求才內容',
    'pdate' => '日期'
];

$sort = $_GET['sort'] ?? 'pdate';
if (!array_key_exists($sort, $sort_fields)) {
    $sort = 'pdate';
}

$order = $_GET['order'] ?? 'desc';
if (!in_array(strtolower($order), ['asc', 'desc'])) {
    $order = 'desc';
}
$search_date = $_GET['search_date'] ?? '';
$where = '';
if (!empty($search_date)) {
    $where = "WHERE pdate = '$search_date'";
}
$sql = "SELECT * FROM job $where ORDER BY $sort $order";
$result = mysqli_query($conn, $sql);
?>

<div class="container mt-4">
<div class="container">
  <form method="get" class="row g-3 mb-3">
    <div class="col-auto">
      <label for="sort" class="col-form-label">排序欄位：</label>
    </div>
    <div class="col-auto">
      <select name="sort" id="sort" class="form-select">
        <?php foreach ($sort_fields as $key => $label): ?>
          <option value="<?=$key?>" <?=($sort==$key)?'selected':''?>><?=$label?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="col-auto">
      <select name="order" class="form-select">
        <option value="asc" <?=($order=='asc')?'selected':''?>>升冪</option>
        <option value="desc" <?=($order=='desc')?'selected':''?>>降冪</option>
      </select>
    </div>

    <div class="col-auto">
      <label for="search_date" class="col-form-label">日期：</label>
      <input type="date" name="search_date" id="search_date" class="form-control" value="<?=htmlspecialchars($_GET['search_date'] ?? '')?>">
    </div>

    <div class="col-auto">
      <button type="submit" class="btn btn-primary">搜尋/排序</button>
    </div>
  </form>

  <!-- 搜尋/排序表單 -->

    <table id="jobTable" class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>求才廠商</th>
                <th>求才內容</th>
                <th>日期</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= htmlspecialchars($row["company"]) ?></td>
                <td><?= htmlspecialchars($row["content"]) ?></td>
                <td><?= htmlspecialchars($row["pdate"]) ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function() {
    $('#jobTable').DataTable({
        "paging": true,     // 分頁
        "searching": true,  // 搜尋
        "ordering": true    // 排序
    });
});
</script>

<?php
    mysqli_close($conn); 
} catch(Exception $e) {
    echo 'Message: ' . $e->getMessage();
}

require_once "newfooter.php"; 
?>
