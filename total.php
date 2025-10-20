<?php
$name = $_POST['name'] ?? '';
$role = $_POST['role'] ?? '';
$program = $_POST['program'] ?? [];
if ($role === 'T'|| empty($program)) {
    $price = 0;
} else {
    $price = array_sum($program); 
}
?>
<?php include('newheader.php'); ?>
<div class="alert alert-primary" role="alert">
  <?= htmlspecialchars($name) ?>（<?= htmlspecialchars($role) ?>），您要繳交 <?= $price ?> 元
</div>
<?php include('newfooter.php'); ?>

