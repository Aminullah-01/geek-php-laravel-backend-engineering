<?php
session_start();
require "config.php";
require_once "classes/AuthService.php";
require_once "classes/UserRepository.php";

$userRepo = new UserRepository($pdo);
$auth = new AuthService($userRepo);

if (!$auth->check()) {
    header("Location: login.php");
    exit;
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profile</title>

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

        .wrap{
            width: min(720px, 100%);
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

        .header{
            display: flex;
            gap: 14px;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            padding-bottom: 14px;
            border-bottom: 1px solid rgba(255,255,255,.10);
            margin-bottom: 16px;
        }

        .title{
            margin: 0;
            font-size: 28px;
            letter-spacing: .2px;
        }

        .subtitle{
            margin: 6px 0 0;
            color: var(--muted);
            font-size: 14px;
            line-height: 1.4;
        }

        .actions{
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn{
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 12px;
            border-radius: 12px;
            border: 1px solid rgba(255,255,255,.14);
            background: rgba(20, 7, 138, 0.51);
            color: white;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: transform .08s ease, filter .18s ease, background .15s ease;
        }
        .btn:hover{ background: rgba(255,255,255,.10); }
        .btn:active{ transform: translateY(1px); }

        .btn-danger{
            border: 0;
            background: linear-gradient(180deg, rgba(237, 58, 58, 1), rgba(217, 40, 40, 1));
            box-shadow: 0 10px 24px rgba(124,58,237,.28);
        }
        .btn-danger:hover{ filter: brightness(1.05); }

        .grid{
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        .block{
            border: 1px solid rgba(255,255,255,.12);
            background: rgba(255,255,255,.06);
            border-radius: 14px;
            padding: 14px;
        }

        .label{
            margin: 0 0 6px;
            font-size: 13px;
            color: var(--muted);
        }

        .value{
            margin: 0;
            font-size: 15px;
            color: var(--text);
            word-break: break-word;
        }

        .avatar{
            width: 54px;
            height: 54px;
            border-radius: 16px;
            background:
                radial-gradient(14px 14px at 30% 30%, rgba(255,255,255,.28), transparent 60%),
                linear-gradient(180deg, rgba(124,58,237,1), rgba(59,130,246,1));
            box-shadow: 0 14px 28px rgba(0,0,0,.25);
            flex: 0 0 auto;
        }

        .who{
            display: flex;
            gap: 12px;
            align-items: center;
            min-width: 240px;
        }

        .meta{
            display: grid;
        }

        .hint{
            margin: 14px 0 0;
            font-size: 13px;
            color: var(--muted);
            text-align: center;
        }

        @media (max-width: 720px){
            .grid{ grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <div class="wrap">
        <div class="card">
            <div class="header">
                <div class="who">
                    <div class="avatar" aria-hidden="true"></div>
                    <div class="meta">
                        <h1 class="title">Your Profile</h1>
                        <p class="subtitle">Account details and quick actions.</p>
                    </div>
                </div>

                <div class="actions">
                    <a class="btn btn-danger" href="logout.php">Log out</a>
                </div>
            </div>

            <!-- Replace these placeholders with your real user data later -->
            <div class="grid">
                <div class="block">
                    <p class="label">Full Name</p>
                    <p class="value">
                        <?php echo $_SESSION['fullName']; ?>
                    </p>
                </div>

                <div class="block">
                    <p class="label">Username</p>
                    <p class="value">
                        <?php echo $_SESSION['username']; ?>
                    </p>
                </div>

                <div class="block">
                    <p class="label">Email</p>
                    <p class="value">
                        <?php echo $_SESSION['email']; ?>
                    </p>
                </div>

                
            </div>

        
        </div>
    </div>