<?php
session_start();
if (empty($_SESSION['user'])) {
    $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI'];
    header("Location: login.php");
    exit;
}
include('newheader.php');
?>


<h1>表單</h1>
</header>

<main class="container mt-4">  
    <form action="totalcha.php" method="post">
      <input type="hidden" name="name" value="<?= htmlspecialchars($_SESSION['user']) ?>">
      <input type="hidden" name="role" value="<?= htmlspecialchars($_SESSION['role']) ?>">
        <input type="checkbox" id="program_0" name="program[]" value=0 />
        <label for="program_0">需要晚餐</label>
        <br/>
      <button type="submit" class="btn btn-primary">submit</button>
</main>

<?php include('newfooter.php'); ?>
