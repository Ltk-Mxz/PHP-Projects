<?php session_start(); ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auth Sys.</title>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
<body class="w-screen h-screen bg-zinc-800 text-white">
  <header class="p-8 flex flex-row justify-center items-center gap-[10rem]">
    <h1 class="text-5xl">Auth sys.</h1>
    <nav>
      <ul class="flex flex-row justify-center items-center gap-8">
        <li><a href="index.php">Home</a></li>
        <?php if(!isset($_SESSION['username'])) : ?>
          <li><a href="login.php">Login</a></li>
          <li><a href="register.php">Register</a></li>
          <?php else : ?>
            <li>User: <?php echo htmlentities($_SESSION['username']); ?></li>
            <li><a href="logout.php">Logout</a></li>
        <?php endif; ?>
      </ul>
    </nav>
  </header>