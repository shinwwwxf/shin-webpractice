<?php include('header.php'); ?>
<header class="masthead bg-primary text-black text-center p-5 mt-5">
  <h1>表單</h1>
</header>

<main class="container mt-4">  
    <form action="" method="post">
      <fieldset>
        <legend>個人資料</legend>
        <label for="name">姓名：</label>
        <input type="text" id="name" name="name" size="10" placeholder="請輸入姓名" 
        maxlength="10" required /><br/>
        <label for="class">班級：</label>
        <select id="class" name="class" required>
          <option value="資管一甲">資管一甲</option>
          <option value="資管一乙">資管一乙</option>
        </select><br/>
      </fieldset>
      <fieldset>
        <label for="start">日期:</label>
        <input
          type="date"
          id="start"
          name="trip-start"
          value="2025-03-20"
          min="2000-01-01"
          max="2100-01-01" />
 <br/>
        <label>活動：</label>
        <input type="checkbox" id="program_0" name="program[]" value=0 />
        <label for="program_0">一日資管營</label>
        <input type="checkbox" id="program_1" name="program[]" value=1 />
        <label for="program_1">迎新茶會</label>
        <input type="checkbox" id="program_2" name="program[]" value=2 />
        <label for="program_2">迎新宿營</label>
        <br/>
        <label>電子信箱：</label>
        <form action="/test.aspx" method="post" target="_blank" novalidate>
          <input name="email" type="email">
        </form>
        <div>
          <label for="pass">密碼:</label>
          <input type="password" id="pass" name="password" minlength="8" required />
        </div>       
      </fieldset>
      <input type="submit" value="送出" />
      <input type="reset" value="清除" />
    </form>
</main>

<?php include('newfooter.php'); ?>
