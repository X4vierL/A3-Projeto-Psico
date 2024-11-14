<?php
    //config.php
    $con = mysqli_connect('localhost','root','');
    $db = mysqli_select_db($con,'A3_Psico');

    if(!$con || !$db) echo mysqli_error($con);

?>