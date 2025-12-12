<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register & Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Sign Up Form -->
    <div class="container" id="signup">
        <h1 class="form-title">Register</h1>
        <form method="POST" action="register.php">
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="first_name" id="first_name" placeholder="First Name" required>
                <label for="first_name">First Name</label>
            </div>
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="last_name" id="last_name" placeholder="Last Name" required>
                <label for="last_name">Last Name</label>
            </div>
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" id="signUpEmail" placeholder="Email" required>
                <label for="signUpEmail">Email</label>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" id="signUpPassword" placeholder="Password" required>
                <label for="signUpPassword">Password</label>
            </div>
            <button type="submit" class="btn">Sign Up</button>
        </form>
        <p class="or">----------or--------</p>
        <div class="links">
            <p>Already Have an Account?</p>
            <button id="signInButton">Sign In</button>
        </div>
    </div>

    <!-- Sign In Form -->
    <div class="container" id="signIn" style="display:none;">
        <h1 class="form-title">Sign In</h1>
        <form method="POST" action="login.php">
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" id="signInEmail" placeholder="Email" required>
                <label for="signInEmail">Email</label>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" id="signInPassword" placeholder="Password" required>
                <label for="signInPassword">Password</label>
            </div>
            <button type="submit" class="btn">Sign In</button>
        </form>
        <p class="or">----------or--------</p>
        <div class="links">
            <p>Don’t Have an Account Yet?</p>
            <button id="signUpButton">Sign Up</button>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>