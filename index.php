<?php
if ( isset($_COOKIE["week5"])){
  echo "<h1>你已經登入</h1>
        <br>
        <a href=./board.php> 舊留言板 </a>
        <br>
        <a href=./boots_layout.php> bootstrap 留言板 </a>
        ";
} else {
  echo " <h1>未登入</h1>
  <a href=./verify.php> 登入（註冊）頁面 </a>
  <br>
  <a href=./board.php> 留言板 </a>
  ";
}
?>