<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <section class="form-center">
        <form class="grid-form" action="index.php" method="POST">
            <h1 class="form-title">Log in</h1>
            <input class="text-input" type="text" name="email" placeholder="Login...">
            <input class="text-input" type="text" name="password" placeholder="Password...">
            <button class="button" type="submit" name="submit">Login</button>
        </form>
    </section>

    <?php
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $db = "login";

        $conn = mysqli_connect($servername, $username, $password, $db);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        else if (isset($_POST['submit'])){
            $email = $_POST['email'];
            $password = $_POST['password'];
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "<div class='pop-up'>Incorrect email format!</div>";
            } else if (!empty($email) || !empty($password)){

                $query = "SELECT * FROM users WHERE email='$email' AND password='$password';";
                $email_query = mysqli_query($conn, $query);

                if (mysqli_num_rows($email_query) > 0) {
                    echo "<div class='pop-up blue'>Dear $email, your access is allowed!</div>";
                } else if(mysqli_num_rows($email_query) === 0) {
                    echo "<div class='pop-up'>Access denied, user $email is not registered or your password $password is wrong!</div>";
                } else {
                    echo "<div class='pop-up'>Error: $query <br> $conn->error </div>";
                }
            } else {
                echo "<div class='pop-up'>Form fields should not be empty. Please try again!</div>";
            }
        }

    ?>
    
</body>
</html>