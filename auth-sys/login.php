<?php
require "includes/header.php";
require "config.php";

if (empty($_SESSION['csrf_token']['token'])) {
    $_SESSION['csrf_token']['token'] = bin2hex(random_bytes(32));
}

$csrf_token = $_SESSION['csrf_token']['token'];

if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$error = '';

if (isset($_POST['submit'])){
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $csrf_token_received = $_POST['csrf_token'];

    if($csrf_token_received !== $_SESSION['csrf_token']['token']){
        $error = "Invalid CSRF token.";
    }elseif (empty($email) || empty($password)) {
        $error = "Some inputs are empty";
    }else {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data && password_verify($password, $data['password'])) {
            $_SESSION['username'] = $data['username'];
            $_SESSION['email'] = $data['email'];
            header("Location: index.php");
            exit();
        } else {
            $error = "Email or password is wrong";
        }
    }
}

?>

<main>
    <form method="POST" action="login.php" class="my-[5rem] flex flex-col justify-center items-center">
        <h1 class="text-center mb-8">Please log in</h1>

        <?php if ($error): ?>
            <p class="my-4" style="color: red;"><?php echo htmlentities($error); ?></p>
        <?php endif; ?>

        <div class="flex flex-col gap-2">
            <label for="email" class="text-2xl">Email address</label>
            <input name="email" type="email" class="text-2xl text-black p-2 rounded" id="email" placeholder="name@example.com" value="<?php echo htmlentities($email ?? ''); ?>">
        </div>
        
        <div class="flex flex-col gap-2">
            <label for="password" class="text-2xl">Password</label>
            <input name="password" type="password" class="text-2xl text-black p-2 rounded" id="password" placeholder="Password">
        </div>

        <input type="hidden" name="csrf_token" value="<?php echo htmlentities($_SESSION['csrf_token']['token']); ?>">

        <button name="submit" type="submit" class="my-8 p-4 border-solid border-2 border-indigo-600 hover:bg-indigo-400 rounded-xl">Sign in</button>

        <h6 class="mb-[5rem]">Don't have an account? <a href="register.php" class="underline">Create your account</a></h6>
    </form>
</main>

<?php require "includes/footer.php"; ?>