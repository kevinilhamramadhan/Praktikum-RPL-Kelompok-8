<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReAngel Login</title>
    <link rel="stylesheet" href="../style/login_style.css">
    <link href="https://fonts.googleapis.com/css2?family=Oxanium&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="top-bar">
            <div class="profile-circle">
                <img class="profile-icon" src="../images/icons/avatar.png" alt="profile">
            </div>
        </div>
        <div class="login-container">
            <h1>ReAngel Login</h1> 
            <div id="error-message"></div>       
                <form id="login-form" method="post" action="../../backend/db/login_db.php">
                    <div class="input-field">
                        <label for="username">Username</label>
                        <input type="text" name="username" placeholder="Username" >
                    </div>
                        <div class="input-field">
                            <div class="password-field">
                                <label for="password-field">Password</label>
                                <input type="password" name="password" id="password-field" placeholder="Password" >
                                <span class="eye-icon" id="toggle-password">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <button type="submit" class="signin-btn">Sign In</button>
                        <div class="options">
                            <label class="remember-container" style="display: flex; align-items: center; cursor: pointer;">
                                <input type="checkbox" name="remember" style="margin-right: 8px;">
                                <span>Remember me</span>
                            </label>
                            <a href="#" class="forgot-password">Forgot Password?</a>
                        </div>
                </form>
        </div>
    </div>
<script src="../script/login_script.js"></script>
</body>
</html>