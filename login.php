<?php
session_start();

if (isset($_SESSION['user'])) {
    header("Location: index.php"); 
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

   
    $validUsers = [
        'zaynab' => '12345',
        'maria' => '12344',
        'hadia' => '12333'
        
    ];

   
    if (array_key_exists($username, $validUsers) && $validUsers[$username] === $password) {
        $_SESSION['user'] = $username;
        header("Location: index.php");
        exit();
    } else {
        $error = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<style>
    body {
    background-color: plum;
    font-family: 'Helvetica', sans-serif;
    margin: 0;
    padding: 0;
    background: url('myhoss.png') no-repeat center center fixed;
    background-size: contain;
}

.container {
    width: 30%;
    margin: 45px auto;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    background-color: rgba(255, 255, 255, 0.8);
}

h1 {
    color: brown;
    text-align: center;
}

form {
    margin-top: 20px;
    text-align: center;
}

label {
    display: block;
    margin: 10px 0;
    color: brown;
}

input {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    box-sizing: border-box;
}

button {
    background-color: purple;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-family: 'Helvetica', sans-serif;
    font-size: 16px;
    transition: background-color 0.3s;
}

button:hover {
    background-color: plum;
    color: papayawhip;
}

.error {
    color: red;
    text-align: center;
    margin-top: 10px;
}

    </style>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
   
</head>

<body>

    <div class="container">
        <h1>Login 😉</h1>

        <form method="POST" action="">
            <label for="username">Username:</label>
            <input type="text" name="username" required>

            <label for="password">Password:</label>
            <input type="password" name="password" required>

            <button type="submit">Login ✔</button>
        </form>

        <?php if (isset($error)) : ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>

    </div>

</body>

</html>
