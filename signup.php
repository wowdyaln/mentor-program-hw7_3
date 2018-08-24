<?
  //conncet to mySQL
require('conn.php');



// get data from index.php/form
  $username = $_POST['username'];
  $password = $_POST['password'];
 
  $sql = "INSERT INTO `users` (`id`, `username`, `password`) VALUES (NULL, '{$username}', '{$password}') ";

  if ( $conn->query($sql) ) {
    echo "New record created successfully 
    {$username}  你好！
    ";
} else {
    echo " Error: {$conn->error} :

sql: {$sql}  ";
}

echo "<br> <a href=./index.php> index page </a>";
?>