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
require_once "newheader.php"; // HTML header & Bootstrap 引入

try {
    require_once 'db.php'; // 引用資料庫連線設定

    $sql = "SELECT * FROM newactivity";
    $result = mysqli_query($conn, $sql);
?>
<div class="container mt-4">
    <table class="table table-bordered table-striped">
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


<?php
    mysqli_close($conn); // 關閉資料庫連線
} catch(Exception $e) {
    echo 'Message: ' . $e->getMessage();
}

require_once "newfooter.php"; // HTML footer
?>
