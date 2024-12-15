<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/resources/css/login-style.css">
    <title>BRGY. SYSTEM</title>
</head>

<body>
    <div id="login-page">
        <h2 style="text-align: center;" id="title">BARANGAY MANAGEMENT SYSTEM</h2>
        <form action="includes/auth/login.php" method="POST">
            <div class="container">
                <h1>ADMIN LOGIN</h1>
                <?php if (isset($_GET['error']) && $_GET['error'] == 1): ?>
                    <p style="color: red;">Wrong Username or Password</p>
                <?php endif; ?>
                <label for="username">USERNAME:</label><br>
                <input type="text" placeholder="Enter Username" name="username" required><br>
                <label for="password">PASSWORD:</label><br>
                <input type="password" placeholder="Enter Password" name="password" required><br>
                <button type="submit" id="login-button">LOGIN</button>
            </div>
        </form>
    </div>
</body>

</html>
