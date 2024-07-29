<?php
require "includes/header.php";

if(isset($_SESSION['username']))
    echo '<h1 class="text-center text-2xl m-8">Hello, ' .htmlentities($_SESSION['username'])."</h1>";
else
    echo '<h1 class="text-center text-2xl mt-8">Hello, Unknown User </h1>';

require "includes/footer.php";
?>