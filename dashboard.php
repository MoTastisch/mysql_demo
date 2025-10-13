<?php
session_start();

// Nicht eingeloggt? -> Weiterleitung zur Login-Seite
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Optional: Nutzerdaten aus DB holen
$dbConfig = require_once 'config/database.php';
$dsn = "mysql:host={$dbConfig['host']};dbname={$dbConfig['dbname']};charset={$dbConfig['charset']}";
$pdo = new PDO($dsn, $dbConfig['username'], $dbConfig['password'], [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
]);

$stmt = $pdo->prepare("SELECT name, email FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

if (!$user) {
    // Falls User nicht existiert (mehr), abmelden
    session_destroy();
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="de" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Firma XY</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --background: #0a1929;
            --surface: #12283a;
            --surface-alt: #1a3a52;
            --text-primary: #e0f7fa;
            --text-secondary: #b2ebf2;
            --primary: #00c853;
            --primary-light: #64dd17;
            --border: #2a4d69;
            --shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }

        [data-theme="light"] {
            --background: #f0f8ff;
            --surface: #ffffff;
            --surface-alt: #f0f0f0;
            --text-primary: #0a1929;
            --text-secondary: #37474f;
            --primary: #64dd17;
            --border: #cfd8dc;
            --shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: var(--background);
            color: var(--text-primary);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        header {
            background: var(--surface);
            padding: 20px 0;
            box-shadow: var(--shadow);
        }

        .navbar {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
        }

        .nav-links {
            display: flex;
            gap: 20px;
            list-style: none;
        }

        .nav-links a {
            color: var(--text-primary);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav-links a:hover {
            color: var(--primary);
        }

        .theme-switch {
            cursor: pointer;
            font-size: 1.3rem;
            color: var(--text-primary);
        }

        main {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            padding: 40px 20px;
        }

        .dashboard-card {
            background: var(--surface);
            padding: 40px;
            border-radius: 12px;
            box-shadow: var(--shadow);
            max-width: 600px;
            width: 100%;
            text-align: center;
        }

        .dashboard-card h1 {
            color: var(--primary);
            margin-bottom: 10px;
        }

        .dashboard-card p {
            color: var(--text-secondary);
            margin-bottom: 30px;
        }

        .btn-logout {
            display: inline-block;
            background: var(--primary);
            color: #fff;
            padding: 12px 25px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            transition: background 0.3s;
        }

        .btn-logout:hover {
            background: var(--primary-light);
        }

        .user-list { 
            margin-top: 15px; 
        }
        
        .user-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid var(--border);
        }
        .user-row:last-child { border-bottom: none; }
        .user-name { font-weight: 500; }
        .user-email { color: var(--text-secondary); font-size: 0.9rem; }
        .user-date { color: var(--text-secondary); font-size: 0.85rem; }

        @media (max-width: 600px) {
            .nav-links {
                gap: 10px;
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="navbar">
            <div class="logo">Firma XY Dashboard</div>
            <ul class="nav-links">
                <li><a href="#"><i class="fas fa-user"></i> Profil</a></li>
                <li><a href="#"><i class="fas fa-cog"></i> Einstellungen</a></li>
                <li class="theme-switch" id="themeSwitch"><i class="fas fa-moon" id="themeIcon"></i></li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Abmelden</a></li>
            </ul>
        </div>
    </header>

    <main>
        <div class="dashboard-card">
            <h1>Willkommen, <?= htmlspecialchars($user['name']) ?>!</h1>
            <p>Du bist erfolgreich angemeldet.</p>
            <p><strong>E-Mail:</strong> <?= htmlspecialchars($user['email']) ?></p>
            <a href="logout.php" class="btn-logout">Abmelden</a>
        </div>
        <?php
            $users = [];
            $stmt = $pdo->query("SELECT id, name, email, created_at FROM users ORDER BY created_at DESC");
            $users = $stmt->fetchAll();
        ?>
        <section class="dashboard-card" style="margin-top: 30px;">
            <h2><i class="fas fa-users"></i> Alle Nutzer (<?= count($users) ?>)</h2>
            <div class="user-list">
                <?php foreach ($users as $u): ?>
                    <div class="user-row">
                        <span class="user-name"><?= htmlspecialchars($u['name']) ?></span>
                        <span class="user-email"><?= htmlspecialchars($u['email']) ?></span>
                        <span class="user-date"><?= date('d.m.Y', strtotime($u['created_at'])) ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </main>

    <script>
        // Theme Switcher
        const themeSwitch = document.getElementById('themeSwitch');
        const themeIcon = document.getElementById('themeIcon');
        const html = document.documentElement;

        themeSwitch.addEventListener('click', () => {
            if (html.getAttribute('data-theme') === 'dark') {
                html.setAttribute('data-theme', 'light');
                themeIcon.classList.remove('fa-moon');
                themeIcon.classList.add('fa-sun');
            } else {
                html.setAttribute('data-theme', 'dark');
                themeIcon.classList.remove('fa-sun');
                themeIcon.classList.add('fa-moon');
            }
        });
    </script>
</body>
</html>