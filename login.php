<?php
session_start();

// Jika form dikirim (tombol login ditekan)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Data login statis
    $validUser = "admin";
    $validPass = "1234";

    if ($username == $validUser && $password == $validPass) {
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Username atau Password salah!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>LOGIN POLGAN MART</title>
    <style>
        body {
            font-family: Arial;
            background: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            width: 330px;
            background: white;
            padding: 30px 25px 20px 25px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.15);
            text-align: center;
        }
        h2 {
            color: #0066ff;
            margin-bottom: 20px;
            font-size: 22px;
            letter-spacing: 1px;
        }
        input {
            width: 100%;
            padding: 10px;
            margin-top: 8px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 14px;
        }
        .btn-login {
            background: #0066ff;
            color: white;
            padding: 10px;
            width: 100%;
            border: none;
            border-radius: 6px;
            margin-top: 15px;
            cursor: pointer;
            font-size: 15px;
            font-weight: bold;
        }
        .btn-login:hover {
            background: #0057d8;
        }
        .btn-cancel {
            background: #dddddd;
            color: black;
            padding: 10px;
            width: 100%;
            border: none;
            border-radius: 6px;
            margin-top: 8px;
            cursor: pointer;
            font-size: 15px;
        }
        .error {
            background: #ffd5d5;
            color: #b30000;
            padding: 8px;
            border-radius: 5px;
            margin-bottom: 10px;
            font-size: 14px;
        }
        .footer {
            font-size: 12px;
            margin-top: 15px;
            color: #888;
        }
    </style>
</head>

<body>
<div class="login-container">
    <h2>POLGAN MART</h2>

    <?php 
    // tampilkan pesan error jika login gagal
    if (isset($error)) {
        echo "<div class='error'>$error</div>";
    }
    ?>

    <form method="POST" action="">
        <label style="float:left; font-size:14px;">Username</label>
        <input type="text" name="username" required>

        <label style="float:left; margin-top:10px; font-size:14px;">Password</label>
        <input type="password" name="password" required>

        <button class="btn-login" type="submit">Login</button>
        <button class="btn-cancel" type="reset">Batal</button>
    </form>

    <div class="footer">© 2025 POLGAN MART</div>
</div>
</body>
</html>