<?php
require_once "newheader.php";

try {
    require_once 'db.php';

    $sql = "select * from user where account = '$account'";
    $sql = "select * from user where password = '$password'";
    $result = mysqli_query($conn, $sql);
?>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>


<?php
    mysqli_close($conn); 
} catch(Exception $e) {
    echo 'Message: ' . $e->getMessage();
}

require_once "newfooter.php"; 
?>
