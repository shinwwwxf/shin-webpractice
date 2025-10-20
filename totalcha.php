<?php
$name = $_POST['name'] ?? '';
$role = $_POST['role'] ?? '';
$program = $_POST['program'] ?? []; 

if ($role === 'T'|| empty($program)) {
    $price = 0;
} else {
    $price = 100; 
}


?>
<?php include('newheader.php'); ?>
<div class="alert alert-primary" role="alert">
  <?= htmlspecialchars($name) ?>（<?= htmlspecialchars($role) ?>），您要繳交<?= htmlspecialchars($price) ?>元
</div>
<?php include('newfooter.php'); ?>

