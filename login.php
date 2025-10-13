<?php
// login.php
session_start();

// Datenbank-Verbindung einbinden
$dbConfig = require_once 'config/database.php';
$dsn = "mysql:host={$dbConfig['host']};dbname={$dbConfig['dbname']};charset={$dbConfig['charset']}";
$pdo = new PDO($dsn, $dbConfig['username'], $dbConfig['password'], [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
]);

// Login-Logik
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        header('Location: dashboard.php'); // oder wohin du willst
        exit;
    } else {
        $error = 'Ungültige E-Mail oder Passwort.';
    }
}
?>

<!DOCTYPE html>
<html lang="de" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Firma XY</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-dark: #00c853;
            --primary-light: #64dd17;
            --background-dark: #0a1929;
            --surface-dark: #12283a;
            --text-primary-dark: #e0f7fa;
            --text-secondary-dark: #b2ebf2;
            --border-dark: #2a4d69;
            --shadow-dark: 0 10px 30px rgba(0, 0, 0, 0.5);

            --background-light: #f0f8ff;
            --surface-light: #ffffff;
            --text-primary-light: #0a1929;
            --text-secondary-light: #37474f;
            --border-light: #cfd8dc;
            --shadow-light: 0 10px 30px rgba(0, 0, 0, 0.1);

            --background: var(--background-dark);
            --surface: var(--surface-dark);
            --text-primary: var(--text-primary-dark);
            --text-secondary: var(--text-secondary-dark);
            --border: var(--border-dark);
            --shadow: var(--shadow-dark);
            --primary: var(--primary-dark);
        }

        [data-theme="light"] {
            --background: var(--background-light);
            --surface: var(--surface-light);
            --text-primary: var(--text-primary-light);
            --text-secondary: var(--text-secondary-light);
            --border: var(--border-light);
            --shadow: var(--shadow-light);
            --primary: var(--primary-light);
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
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background: var(--surface);
            padding: 40px;
            border-radius: 12px;
            box-shadow: var(--shadow);
            width: 100%;
            max-width: 400px;
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: var(--primary);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid var(--border);
            border-radius: 8px;
            background: var(--background);
            color: var(--text-primary);
        }

        .btn {
            width: 100%;
            padding: 12px;
            background: var(--primary);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn:hover {
            background: var(--primary-light);
        }

        .error {
            color: #ff5252;
            margin-bottom: 15px;
            text-align: center;
        }

        .login-link {
            text-align: center;
            margin-top: 15px;
            color: var(--text-secondary);
        }

        .login-link a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
        }

        .theme-switch {
            position: absolute;
            top: 20px;
            right: 20px;
            cursor: pointer;
            font-size: 1.5rem;
            color: var(--text-primary);
        }
    </style>
</head>
<body>
    <div class="theme-switch" id="themeSwitch">
        <i class="fas fa-moon" id="themeIcon"></i>
    </div>

    <div class="login-container">
        <h2>Anmelden</h2>
        <?php if ($error): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="form-group">
                <label for="email">E-Mail</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="form-group">
                <label for="password">Passwort</label>
                <input type="password" name="password" id="password" required>
            </div>
            <button type="submit" class="btn">Login</button>
        </form>
        <div class="login-link">
            Noch kein Konto? <a href="register.php">Hier registrieren</a>
        </div>
    </div>

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