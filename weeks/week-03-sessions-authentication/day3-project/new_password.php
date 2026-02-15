<?php
    // including database connection file
    include "config.php";

    if(!isset($_GET['token'])) header("location: login.php");

    $now = date("y-m-d H:i:s", time());
    $query = $db->query("SELECT id FROM users WHERE reset_token = '{$_GET['token']}' AND reset_expires > '$now'");
    $user = mysqli_fetch_assoc($query);

    if(!$user){
        die("Reset link is invalid or expired");
    }
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $errors = [];
        $newPassword = $_POST['new_password'];
        $confirmPassword = $_POST['confirm_password'];
         $token = $_GET['token'] ?? '';
        
        if(empty($token)){
            die("Invalid or missing token");
        }

        if(empty($newPassword)){
        
            $errors['new_password'] = "password required";
        }
        if($confirmPassword !== $newPassword){
            $errors['confirm_password'] = "password not match";
        }
        if(empty($errors)){
        $passwordHash = password_hash($newPassword, PASSWORD_DEFAULT);
       $token = $_GET['token'] ?? null;
        $update = $db->query("UPDATE users SET pass_word = '$passwordHash', reset_token = null, reset_expires = null WHERE reset_token = '$token'");
        header("Location: login.php");
    }
    }
    
    

    

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Set New Password</title>

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
            width: 100%;
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

        label{
            display: block;
            margin-bottom: 6px;
            font-size: 13px;
            color: var(--muted);
        }

        input[type="password"]{
            width: 100%;
            padding: 11px 12px;
            border-radius: 12px;
            border: 1px solid var(--input-border);
            background: var(--input-bg);
            color: var(--text);
            outline: none;
            transition: border-color .15s ease, box-shadow .15s ease;
        }

        input::placeholder{ color: rgba(255,255,255,.45); }

        input:focus{
            border-color: rgba(124,58,237,.95);
            box-shadow: 0 0 0 4px rgba(124,58,237,.20);
        }

        .actions{
            margin-top: 4px;
            display: grid;
        }

        button[type="submit"]{
            appearance: none;
            border: 0;
            cursor: pointer;
            padding: 12px 14px;
            border-radius: 12px;
            background: linear-gradient(180deg, rgba(124,58,237,1), rgba(109,40,217,1));
            color: #fff;
            font-weight: 600;
            letter-spacing: .2px;
            box-shadow: 0 10px 24px rgba(124,58,237,.28);
            width: 100%;
            transition: transform .08s ease, filter .18s ease;
        }

        button[type="submit"]:hover{ filter: brightness(1.05); }
        button[type="submit"]:active{ transform: translateY(1px); }

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
        }
    </style>
</head>
<body>
    <div class="auth-wrap">
        <div class="card">
            <h1>Set new password</h1>
            <p class="subtitle">Enter your new password and confirm it to finish resetting.</p>

            <form method="POST" action="">
                <div>
                    <label for="new_password">New Password</label>
                    <input
                        type="password"
                        id="new_password"
                        name="new_password"
                        placeholder="Create a strong password"
                        autocomplete="new-password"
                    />
                    <?php if(isset($errors['new_password'])): ?>
                        <small style = "color: #f87171;">
                            <?php echo $errors['new_password']; ?>
                        </small>
                        <?php endif; ?>
                </div>

                <div>
                    <label for="confirm_password">Confirm Password</label>
                    <input
                        type="password"
                        id="confirm_password"
                        name="confirm_password"
                        placeholder="Re-enter your new password"
                        autocomplete="new-password"
                    />
                    <?php if(isset($errors['confirm_password'])): ?>
                        <small style = "color: #f87171;">
                            <?php echo $errors['confirm_password']; ?>
                        </small>
                        <?php endif; ?>
                </div>

               

                <div class="actions">
                    <button type="submit">Update Password</button>
                </div>
            </form>

            <div class