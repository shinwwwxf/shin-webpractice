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
    <form action="total.php" method="post">
      <fieldset>
        <legend>個人資料</legend>
        <input type="hidden" name="name" value="<?= htmlspecialchars($_SESSION['user']) ?>">
        <input type="hidden" name="role" value="<?= htmlspecialchars($_SESSION['role']) ?>">
        <input type="checkbox" id="program_0" name="program[]" value=150 />
        <label for="program_0">上午場($150)</label>
        <input type="checkbox" id="program_1" name="program[]" value=100 />
        <label for="program_1">下午場($100)</label>
        <input type="checkbox" id="program_2" name="program[]" value=60 />
        <label for="program_1">午餐($60)</label>
        <br/>
      </fieldset>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</main>

<?php include('newfooter.php'); ?>
