<?php
require "config.php";          // this should create $pdo
require "classes/User.php";
require "classes/UserRepository.php";

$userRepo = new UserRepository($pdo);

$errors = [];
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $fullName = trim($_POST["fullName"] ?? "");
    $username = trim($_POST["username"] ?? "");
    $email    = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";

    // Validation (field-specific errors)
    if ($fullName === "") $errors["fullName"] = "Full name is required";
    if ($username === "") $errors["username"] = "Username is required";

    if ($email === "") {
        $errors["email"] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Invalid email format";
    }

    if ($password === "") {
        $errors["password"] = "Password is required";
    } elseif (strlen($password) < 8) {
        $errors["password"] = "Password must be at least 8 characters";
    }

    // Check duplicates
    if (empty($errors) && $userRepo->existsByEmail($email)) {
        $errors["email"] = "Email already exists";
    }

    // Save user
    if (empty($errors)) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $user = new User($fullName, $username, $email, $hash);

        if ($userRepo->createUser($user)) {
            $success = "Account created successfully. You can now log in.";
        } else {
            $errors["general"] = "Registration failed. Please try again.";
        }
    }
}

    



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>

    <style>
        :root{
            --bg: #0b1220;
            --card: rgba(255,255,255,.08);
            --card-border: rgba(255,255,255,.14);
            --text: rgba(255,255,255,.92);
            --muted: rgba(255,255,255,.70);
            --input-bg: rgba(255,255,255,.10);
            --input-border: rgba(255,255,255,.18);
            --focus: #7c3aed;
            --btn: #7c3aed;
            --btn-hover: #6d28d9;
            --shadow: 0 18px 45px rgba(0,0,0,.45);
        }

        *{ box-sizing: border-box; }
        html, body{ height: 100%; }

        body{
            margin: 0;
            font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
            color: var(--text);
            background:
                radial-gradient(1200px 600px at 15% 15%, rgba(124,58,237,.35), transparent 60%),
                radial-gradient(900px 500px at 90% 20%, rgba(16,185,129,.20), transparent 55%),
                radial-gradient(900px 600px at 50% 100%, rgba(59,130,246,.18), transparent 60%),
                var(--bg);
            display: grid;
            place-items: center;
            padding: 28px 16px;
        }

        .auth-wrap{
            width: min(520px, 100%);
        }

        .card{
            background: var(--card);
            border: 1px solid var(--card-border);
            border-radius: 16px;
            box-shadow: var(--shadow);
            padding: 26px;
            backdrop-filter: blur(10px);
        }

        h1{
            margin: 0 0 6px;
            font-size: 28px;
            letter-spacing: .2px;
        }

        .subtitle{
            margin: 0 0 18px;
            color: var(--muted);
            font-size: 14px;
            line-height: 1.4;
        }

        form{
            margin-top: 8px;
            display: grid;
            gap: 14px;
        }

        .grid{
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        label{
            display: block;
            margin-bottom: 6px;
            font-size: 13px;
            color: var(--muted);
        }

        input[type="text"],
        input[type="email"],
        input[type="password"]{
            width: 100%;
            padding: 11px 12px;
            border-radius: 12px;
            border: 1px solid var(--input-border);
            background: var(--input-bg);
            color: var(--text);
            outline: none;
            transition: border-color .15s ease, box-shadow .15s ease, transform .05s ease;
        }

        input::placeholder{ color: rgba(255,255,255,.45); }

        input:focus{
            border-color: rgba(124,58,237,.95);
            box-shadow: 0 0 0 4px rgba(124,58,237,.20);
        }

        .actions{
            display: flex;
            gap: 12px;
            align-items: center;
            margin-top: 4px;
        }

        input[type="submit"]{
            appearance: none;
            border: 0;
            cursor: pointer;
            padding: 12px 14px;
            border-radius: 12px;
            background: linear-gradient(180deg, rgba(124,58,237,1), rgba(109,40,217,1));
            color: white;
            font-weight: 600;
            letter-spacing: .2px;
            box-shadow: 0 10px 24px rgba(124,58,237,.28);
            width: 100%;
            transition: transform .08s ease, filter .18s ease;
        }

        input[type="submit"]:hover{ filter: brightness(1.05); }
        input[type="submit"]:active{ transform: translateY(1px); }

        .helper{
            margin-top: 14px;
            color: var(--muted);
            font-size: 13px;
            text-align: center;
        }

        .helper a{
            color: rgba(255,255,255,.9);
            text-decoration: none;
            border-bottom: 1px solid rgba(255,255,255,.25);
        }

        .helper a:hover{
            border-bottom-color: rgba(255,255,255,.55);
        }

        @media (max-width: 520px){
            .card{ padding: 20px; }
            .grid{ grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <div class="auth-wrap">
        <div class="card">
            <h1>Register</h1>
            <p class="subtitle">Create your account by filling in the details below.</p>

            <form method="POST" autocomplete="on">
                <?php if ($success): ?>
                    <p style="color:green;"><?= $success ?></p>
                    <?php endif; ?>

                    <?php if (isset($errors["general"])): ?>
                    <p style="color:red;"><?= $errors["general"] ?></p>
                    <?php endif; ?>
                <div class="grid">

                    <div>
                        <label for="first_name">Full Name</label>
                        <input type="text" id="first_name" name="fullName" placeholder="e.g. John Doe" autocomplete="given-name">
                        <?php if(isset($errors['fullName'])): ?>
                        <small style = "color: #f87171;">
                            <?php echo $errors['fullName']; ?>
                        </small>
                        <?php endif; ?>
                    </div>

                    <div>
                        <label for="last_name">Username</label>
                        <input type="text" id="last_name" name="username" placeholder="e.g. johndoe" autocomplete="username">
                        <?php if(isset($errors['username'])): ?>
                        <small style = "color: #f87171">
                            <?php echo $errors['username']; ?>
                        </small>
                        <?php endif; ?>
                    </div>
                </div>

                

                <div>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="e.g. john@example.com" autocomplete="email">
                    <?php if(isset($errors['email'])): ?>
                    <small style = "color: #f87171">
                        <?php echo $errors['email']; ?>
                    </small>
                    <?php endif; ?>
                </div>

                <div>
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Create a strong password" autocomplete="new-password">
                    <?php if(isset($errors['password'])): ?>
                    <small style = "color: #f87171;">
                        <?php echo $errors['password']; ?>
                    </small>
                    <?php endif; ?>
                </div>

                <div class="actions">
                    <input type="submit" value="Register">
                </div>
            </form>

            <div class="helper">
                Already have an account? <a href="login.php">Sign in</a>
            </div>
        </div>
    </div>
</body>
</html>