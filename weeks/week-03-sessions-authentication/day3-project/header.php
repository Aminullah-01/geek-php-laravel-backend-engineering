<?php
// Optional: set $pageTitle before including this file
$pageTitle = $pageTitle ?? 'Geek Auth Project';

// Optional: set $activePage to highlight nav (home|register|login|dashboard)
$activePage = $activePage ?? '';

// Optional: basic auth state (adjust to your project)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$isLoggedIn = isset($_SESSION['user']) || isset($_SESSION['user_id']);
$username = $_SESSION['user']['username'] ?? ($_SESSION['username'] ?? '');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?></title>

    <style>
        :root{
            --bg: #0b1220;
            --card: rgba(255,255,255,.08);
            --card-border: rgba(255,255,255,.14);
            --text: rgba(255,255,255,.92);
            --muted: rgba(255,255,255,.70);
            --shadow: 0 18px 45px rgba(0,0,0,.45);
            --hover: rgba(255,255,255,.08);
            --focus: #7c3aed;
            --link: rgba(255,255,255,.90);
        }

        *{ box-sizing: border-box; }
        body{
            margin: 0;
            font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
            color: var(--text);
            background:
                radial-gradient(1200px 600px at 15% 15%, rgba(124,58,237,.25), transparent 60%),
                radial-gradient(900px 500px at 90% 20%, rgba(16,185,129,.14), transparent 55%),
                radial-gradient(900px 600px at 50% 100%, rgba(59,130,246,.10), transparent 60%),
                var(--bg);
            min-height: 100vh;
        }

        a{ color: inherit; }

        .topbar{
            position: sticky;
            top: 0;
            z-index: 10;
            background: rgba(11,18,32,.72);
            border-bottom: 1px solid rgba(255,255,255,.10);
            backdrop-filter: blur(10px);
        }

        .topbar-inner{
            max-width: 1080px;
            margin: 0 auto;
            padding: 14px 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }

        .brand{
            display: inline-flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            color: var(--text);
            font-weight: 700;
            letter-spacing: .2px;
        }

        .logo{
            width: 34px;
            height: 34px;
            border-radius: 10px;
            background:
                radial-gradient(12px 12px at 30% 30%, rgba(255,255,255,.35), transparent 60%),
                linear-gradient(180deg, rgba(124,58,237,1), rgba(59,130,246,1));
            box-shadow: 0 10px 24px rgba(124,58,237,.22);
        }

        nav{
            display: flex;
            align-items: center;
            gap: 6px;
            flex-wrap: wrap;
        }

        .nav-link{
            text-decoration: none;
            color: var(--link);
            font-size: 14px;
            padding: 9px 10px;
            border-radius: 10px;
            border: 1px solid transparent;
            transition: background .15s ease, border-color .15s ease;
        }
        .nav-link:hover{
            background: var(--hover);
            border-color: rgba(255,255,255,.10);
        }
        .nav-link.active{
            background: rgba(124,58,237,.18);
            border-color: rgba(124,58,237,.35);
        }
        .nav-link:focus{
            outline: none;
            box-shadow: 0 0 0 4px rgba(124,58,237,.20);
        }

        .right{
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .pill{
            font-size: 13px;
            color: var(--muted);
            padding: 8px 10px;
            border: 1px solid rgba(255,255,255,.12);
            border-radius: 999px;
            background: rgba(255,255,255,.06);
            max-width: 260px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .btn{
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 9px 12px;
            border-radius: 12px;
            border: 1px solid rgba(255,255,255,.14);
            background: rgba(255,255,255,.06);
            color: var(--text);
            font-weight: 600;
            font-size: 14px;
        }
        .btn:hover{ background: rgba(255,255,255,.10); }

        .btn-primary{
            border-color: rgba(124,58,237,.35);
            background: rgba(124,58,237,.18);
        }
        .btn-primary:hover{ background: rgba(124,58,237,.24); }

        main{
            max-width: 1080px;
            margin: 0 auto;
            padding: 18px 16px;
        }

        @media (max-width: 640px){
            .pill{ display: none; }
        }
    </style>
</head>
<body>
<header class="topbar">
    <div class="topbar-inner">
        <a class="brand" href="index.php" aria-label="Home">
            <span class="logo" aria-hidden="true"></span>
            <span>Authentication Project</span>
        </a>

        <nav aria-label="Primary navigation">
            <a class="nav-link <?= $activePage === 'home' ? 'active' : '' ?>" href="https://cheatsheetseries.owasp.org/cheatsheets/Authentication_Cheat_Sheet.html">Home</a>
            <?php if (!$isLoggedIn): ?>
                <a class="nav-link <?= $activePage === 'register' ? 'active' : '' ?>" href="register.php">Register</a>
                <a class="nav-link <?= $activePage === 'login' ? 'active' : '' ?>" href="login.php">Login</a>
            <?php else: ?>
                <a class="nav-link <?= $activePage === 'dashboard' ? 'active' : '' ?>" href="dashboard.php">Dashboard</a>
            <?php endif; ?>
        </nav>

        <div class="right">
            <?php if ($isLoggedIn): ?>
                <div class="pill" title="<?= htmlspecialchars($username, ENT_QUOTES, 'UTF-8') ?>">
                    Signed in<?= $username ? ' as ' . htmlspecialchars($username, ENT_QUOTES, 'UTF-8') : '' ?>
                </div>
                <a class="btn" href="logout.php">Logout</a>
            <?php else: ?>
                <a class="btn btn-primary" href="register.php">Get started</a>
            <?php endif; ?>
        </div>
    </div>
</header>

<main>
