<?php
function setActive($file) {
    return basename($_SERVER['PHP_SELF']) === $file ? "active" : "";
}
?>
<!DOCTYPE html>
<html lang="zh-Hant">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>吳欣芳的學習歷程</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
<style>
   
:root {
    --primary: linear-gradient(rgb(249,142,116), rgb(192,235,215)); /* Gradient background */
    --tertiary: #d9275e;
    --text-dark: #ffffff;
    --text-light: #000000;
}

.highlight {
  background-color: #ddb274;
}
.navbar {
  text-align: left;
}

.navbar a {
  display: inline-block;
  color: rgb(172, 26, 26);
  text-align: left;
  padding: 10px 10px;
  text-decoration: none;
  font-size: 18px;
}

.navbar a:hover {
  background-color: rgb(255, 229, 136);
  color: rgb(253, 255, 134);
  border-radius: 5px;
}

        
      strong {
  color: rgb(255, 218, 242);
  font-size: 1.1em;
}
      em {
  color: rgb(255, 225, 166);
  font-weight: 1;
}
      mark {
  background-color: #ffa45a;
  color: rgb(255, 255, 255);
}
      li {
  list-style-type: square;
}

    blockquote {
  background-color: rgb(209, 255, 240);
  border-left: 5px solid rgb(90, 255, 250);
  padding: 10px;
  margin: 10px;
}
    cite {
      display: block;
      text-align: right;
      color: #000000;
    }

</style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">吳欣芳的學習歷程</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
            aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
       <li class="nav-item">
            <a class="nav-link" href="index.php">自介</a>
          </li>
         <li class="nav-item">
            <a class="nav-link" href="form.php">表單</a>
          </li>
         <li class="nav-item">
            <a class="nav-link" href="video.php">影片</a>
          </li>
      </ul>
    </div>
  </div>
</nav>

<div style="margin-top:70px;"></div> <!-- 避免內容被遮住 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
