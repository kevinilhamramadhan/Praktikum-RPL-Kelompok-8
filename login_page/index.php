<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReAngel Login</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            font-family: Arial, sans-serif;
            background-image: url('../images/backgrounds/login.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: #fff;
        }

        .container{
            width: 280px;
            padding-bottom: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.7);
            overflow: visible;
        }

        .login-container {
            background-color: #2a2a2a;
            border-radius: 5px;
            padding-bottom: 15px;
            border: 1px solid #222;
        }

        .top-bar {
            height: 20px;
            background-color: transparent;
            position: relative;
            display: flex;
            justify-content: center;
        }

        .profile-circle {
            width: 60px;
            height: 60px;
            background-color: #17c24d;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            position: absolute;
            top: -10px;
            border: 3px solid #121212;
        }

        .profile-icon {
            width: 40px;
            height: 40px;
        }

        .profile-head {
            width: 20px;
            height: 20px;
            background-color: #121212;
            border-radius: 50%;
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
        }

        .profile-body {
            width: 28px;
            height: 14px;
            background-color: #121212;
            border-radius: 50% 50% 50% 50% / 60% 60% 40% 40%;
            position: absolute;
            top: 18px;
            left: 50%;
            transform: translateX(-50%);
        }

        h1 {
            text-align: center;
            font-size: 18px;
            letter-spacing: 0.5px;
            margin: 45px 0 18px;
            font-weight: normal;
        }

        .input-field {
            margin: 8px 20px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 8px 10px;
            border: none;
            background-color: #1e1e1e;
            color: #aaa;
            border-radius: 3px;
            box-sizing: border-box;
            font-size: 13px;
        }

        .password-field {
            position: relative;
        }

        .eye-icon {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #17c24d;
            cursor: pointer;
            font-size: 16px;
            display: flex;
            align-items: center;
        }

        .signin-btn {
            background-color: #27832e;
            color: #fff;
            border: none;
            border-radius: 3px;
            padding: 8px;
            margin: 8px 20px;
            text-align: center;
            cursor: pointer;
            font-size: 14px;
        }

        .options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 0 20px;
            font-size: 12px;
        }

        .remember-container {
            display: flex;
            align-items: center;
        }

        .checkbox {
            width: 12px;
            height: 12px;
            border: 1px solid #333;
            background-color: transparent;
            margin-right: 6px;
            cursor: pointer;
        }

        .forgot-password {
            color: #17c24d;
            text-decoration: none;
            font-size: 12px;
        }

        .signup-section {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #888;
        }

        .signup-link {
            color: #17c24d;
            text-decoration: none;
        }

        /* Eye icon SVG styling */
        .eye-icon svg {
            width: 16px;
            height: 16px;
            fill: #17c24d;
        }
    </style>
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
            <?php
            // This is just to show how PHP would be integrated, but we're keeping it frontend-only
            $error_message = "";
            if (!empty($error_message)) {
                echo '<div class="error-message">' . $error_message . '</div>';
            }
            ?>
            
            <form method="post" action="#">
                <div class="input-field">
                    <input type="text" name="username" placeholder="Username">
                </div>
                
                <div class="input-field">
                    <div class="password-field">
                        <input type="password" name="password" id="password-field" placeholder="Password">
                        <span class="eye-icon" id="toggle-password">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
                            </svg>
                        </span>
                    </div>
                </div>
                
                <div class="signin-btn">Sign In</div>
                
                <div class="options">
                    <label class="remember-container">
                        <div class="checkbox"></div>
                        <span>Remember me</span>
                    </label>
                    <a href="#" class="forgot-password">Forgot Password?</a>
                </div>
            </form>
        </div>
        <div class="signup-section">
                Don't have any account? <a href="#" class="signup-link">Sign up here</a>
        </div>
    </div>
    <script>
        // Toggle password visibility
        document.getElementById('toggle-password').addEventListener('click', function() {
            const passwordField = document.getElementById('password-field');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
            } else {
                passwordField.type = 'password';
            }
        });

        // Make checkbox clickable
        document.querySelector('.checkbox').addEventListener('click', function() {
            this.style.backgroundColor = this.style.backgroundColor === 'rgb(23, 194, 77)' ? 'transparent' : '#17c24d';
        });

        // Make Sign In button clickable
        document.querySelector('.signin-btn').addEventListener('click', function() {
            document.querySelector('form').submit();
        });
    </script>
</body>
</html>