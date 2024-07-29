<?php
require "includes/header.php";
require "config.php";

if (!isset($_SESSION['csrf_token']['token']) || $_SESSION['csrf_token']['used'] || $_SESSION['csrf_token']['expires'] < time()) {
    $_SESSION['csrf_token'] = [
        'token' => bin2hex(random_bytes(32)),
        'used'  => false,
        'expires' => time() + 600
    ];
}

$csrf_token = $_SESSION['csrf_token']['token'];

if (isset($_SESSION['username'])) {
    header("location: index.php");
    exit();
}

$error = '';

if (isset($_POST['submit']))
{
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if(empty($email) || empty($username) || empty($password)){ $error = "Some inputs are empty"; }

    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){ $error = "Invalid email address"; }

    else{
        if (!isset($_POST['csrf_token']) ||
            $_POST['csrf_token'] !== $_SESSION['csrf_token']['token'] ||
            $_SESSION['csrf_token']['used'] ||
            $_SESSION['csrf_token']['expires'] < time()) {
            $error = "Invalid or expired CSRF token.";
        }else{
            $_SESSION['csrf_token']['used'] = true;

            try {
                $insert = $conn->prepare("INSERT INTO users (email, username, password) VALUES (:email, :username, :password)");
                $insert->execute([
                    ':email' => $email,
                    ':username' => $username,
                    ':password' => password_hash($password, PASSWORD_DEFAULT),
                ]);

                header("Location: login.php");
                exit(0);

            }catch (Exception $e) {
                error_log($e->getMessage(), 3, '/var/log/my_app_errors.log');
                header("Location: error.php");
                exit(1);
            }
        }
    }
}
?>

<main>
    <form method="POST" action="register.php" class="my-[5rem] flex flex-col justify-center items-center">
        <h1 class="text-center mb-8">Please Register</h1>

        <?php if ($error): ?>
            <p style="color:red;"><?php echo htmlentities($error); ?></p>
        <?php endif; ?>

        <div class="flex flex-col">
            <label for="email" class="text-2xl">Email address</label>
            <input class="text-2xl text-black p-2 rounded" name="email" type="email" id="email" placeholder="LtkMxz@france.fr" value="<?php echo isset($email) ? htmlentities($email) : ''; ?>">
        </div>

        <div class="flex flex-col">
            <label for="username" class="text-2xl">Username</label>
            <input class="text-2xl text-black p-2 rounded" name="username" type="text" id="username" placeholder="username" value="<?php echo isset($username) ? htmlentities($username) : ''; ?>">
        </div>

        <div class="flex flex-col">
            <label for="password" class="text-2xl">Password</label>
            <input class="text-2xl text-black p-2 rounded" name="password" type="password" id="password" placeholder="Password">
        </div>

        <input type="hidden" name="csrf_token" value="<?php echo htmlentities($csrf_token); ?>">

        <button name="submit" type="submit" class="my-8 p-4 border-solid border-4 border-indigo-600 hover:bg-indigo-400 rounded-xl">Register</button>

        <h6>Already have an account? <a href="login.php">Login</a></h6>
    </form>
</main>

<?php require "includes/footer.php"; ?>