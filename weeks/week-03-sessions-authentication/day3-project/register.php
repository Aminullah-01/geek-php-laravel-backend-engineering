<?php
// including database connectiong file
include "config.php";


// checking the request method
if($_SERVER['REQUEST_METHOD'] == "POST"){

    $errors = [];
    // recieved user data
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $username = trim($_POST['username']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    
    // check if the input is empty
    if(empty($first_name)){
        $errors ["first_name"] = "first name can't be empty";
    }
    if(empty($last_name)){
        $errors ["last_name"] = "last name can't be empty";
    }
    if(empty($username)){
        $errors ["username"] = "username can't be empty";
    }
    if(empty($email)){
        $errors ["email"] = "email can't be empty";
    }
    if(empty($password)){
        $errors ["password"] = "password can't be empty";
    }
    


    // check if there is not error
    if(empty($errors)){
        // hash password
        $encripted_password = password_hash($password, PASSWORD_DEFAULT);
        try{
            // inserting the user data to database
            $insert = $db->query("INSERT INTO users(`first_name`, `last_name`, `username`, `email`, `pass_word`) VALUES('$first_name', '$last_name', '$username', '$email', '$encripted_password')");
             if($insert){
            header("Location: login.php");
            exit();
        }
        else{
            echo "Data not inserted";
        }
        }
       
        catch(Exception $error){
            $errors[] = "internal server error";
        }
    }
    


}

//  including header page
include "header.php";


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
                <div class="grid">
                    <div>
                        <label for="first_name">First Name</label>
                        <input type="text" id="first_name" name="first_name" placeholder="e.g. John" autocomplete="given-name">
                        <?php if(isset($errors['first_name'])): ?>
                        <small style = "color: #f87171;">
                            <?php echo $errors['first_name']; ?>
                        </small>
                        <?php endif; ?>
                    </div>

                    <div>
                        <label for="last_name">Last Name</label>
                        <input type="text" id="last_name" name="last_name" placeholder="e.g. Doe" autocomplete="family-name">
                        <?php if(isset($errors['last_name'])): ?>
                        <small style = "color: #f87171">
                            <?php echo $errors['last_name']; ?>
                        </small>
                        <?php endif; ?>
                    </div>
                </div>

                <div>
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="e.g. johndoe" autocomplete="username">
                    <?php if(isset($errors['username'])): ?>
                    <small style = "color: #f87171">
                        <?php echo $errors['username']; ?>
                    </small>
                    <?php endif; ?>
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

<?php include 'footer.php'; ?>