<?php
session_start();

if (isset($_SESSION['user_id'])) {
    if (isset($_GET['logout'])) {
        session_destroy();
        echo "<script>
            window.location.href = 'Lab4.html';
        </script>";
        exit();
    }
    
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Welcome</title>
        <link rel="stylesheet" href="Lab4.css">
    </head>
    <body>
        <div class="wrapper">
            <div class="form signup">
                <header>Welcome <?php echo htmlspecialchars($_SESSION['name']); ?>!</header>
                <form action="login.php" method="GET">
                    <input type="submit" name="logout" value="Logout">
                </form>
            </div>
        </div>
    </body>
    </html>
    <?php
    exit();
}

$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "registration";

$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signup'])) {
    $name = trim($conn->real_escape_string($_POST['fullname']));
    $email = trim($conn->real_escape_string($_POST['email']));
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirmPassword']);


    if (empty($name) || empty($email) || empty($password) || empty($confirmPassword)) {
        echo "<script>
            alert('All fields are required and cannot contain only spaces.');
            window.location.href = 'Lab4.html';
        </script>";
        exit();  
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>
            alert('Please enter a valid email address.');
            window.location.href = 'Lab4.html';
        </script>";
        exit();  
    }

    if (md5($password) !== md5($confirmPassword)) {
        echo "<script>
            alert('Passwords do not match!');
            window.location.href = 'Lab4.html';
        </script>";
        exit();
    }

    $checkEmail = "SELECT email FROM user WHERE email = ?";
    $stmt = $conn->prepare($checkEmail);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        echo "<script>
            alert('Email already registered!');
            window.location.href = 'Lab4.html';
        </script>";
        exit();
    }
    $stmt->close();

    $sql = "INSERT INTO user (name, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $email, md5($password));

    if ($stmt->execute()) {
        echo "<script>
            alert('Registration successful!');
            window.location.href = 'Lab4.html';
        </script>";
    } else {
        echo "<script>
            alert('Error: " . $stmt->error . "');
            window.location.href = 'Lab4.html';
        </script>";
    }
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $email = $conn->real_escape_string($_POST['login_email']);
    $password = md5($_POST['login_password']);

    $sql = "SELECT * FROM user WHERE email = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['name'] = $user['name'];
        echo "<script>
            alert('Login successful!');
            window.location.href = 'login.php';  // Changed to redirect to this file
        </script>";
    } else {
        echo "<script>
            alert('Invalid email or password!');
            window.location.href = 'Lab4.html';
        </script>";
    }
    $stmt->close();
}

$conn->close();
?>
