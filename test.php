<?php


$_SESSION['test'] = session_create_id(); //設置Session變數

echo "\$_SESSION['test']變數值：" . $_SESSION['test'];

echo "<hr />";

//使用isset()函數檢查變數是否有被設置
// echo ("清空Session變數前：");
// if (isset($_SESSION['test'])) {
//     echo ("有設置變數");
// } else {
//     echo ("未設置變數");
// }

// echo "<hr />";

// session_unset("test");
// //unset($_SESSION['test']);

// echo ("清空Session變數後：");
// if (isset($_SESSION['test'])) {
//     echo ("有設置變數");
// } else {
//     echo ("未設置變數");
// }
