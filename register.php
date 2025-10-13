<?php
session_start();
$dbConfig = require_once 'config/database.php';
$dsn = "mysql:host={$dbConfig['host']};dbname={$dbConfig['dbname']};charset={$dbConfig['charset']}";
$pdo = new PDO($dsn, $dbConfig['username'], $dbConfig['password'], [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
]);

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = strtolower(trim($_POST['email']));
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    if ($password !== $password_confirm) {
        $error = 'Die Passwörter stimmen nicht überein.';
    } elseif (strlen($password) < 6) {
        $error = 'Passwort muss mindestens 6 Zeichen lang sein.';
    } else {
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $error = 'E-Mail bereits registriert.';
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
            $stmt->execute([$name, $email, $hash]);
            $success = 'Konto erfolgreich erstellt. Du kannst dich jetzt einloggen.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="de" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <title>Registrieren - Firma XY</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Gleiche Styles wie login.php – damit es einheitlich bleibt */
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

        .register-container {
            background: var(--surface);
            padding: 40px;
            border-radius: 12px;
            box-shadow: var(--shadow);
            width: 100%;
            max-width: 400px;
        }

        .register-container h2 {
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

        .success {
            color: #00c853;
            margin-bottom: 15px;
            text-align: center;
        }

        .theme-switch {
            position: absolute;
            top: 20px;
            right: 20px;
            cursor: pointer;
            font-size: 1.5rem;
            color: var(--text-primary);
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
    </style>
</head>
<body>
    <div class="theme-switch" id="themeSwitch">
        <i class="fas fa-moon" id="themeIcon"></i>
    </div>

    <div class="register-container">
        <h2>Konto erstellen</h2>

        <?php if ($error): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <?php if ($success): ?>
            <div class="success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" required>
            </div>
            <div class="form-group">
                <label for="email">E-Mail</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="form-group">
                <label for="password">Passwort</label>
                <input type="password" name="password" id="password" required minlength="6">
            </div>
            <div class="form-group">
                <label for="password_confirm">Passwort bestätigen</label>
                <input type="password" name="password_confirm" id="password_confirm" required minlength="6">
            </div>
            <button type="submit" class="btn">Konto erstellen</button>
        </form>

        <div class="login-link">
            Bereits ein Konto? <a href="login.php">Hier einloggen</a>
        </div>
    </div>

    <script>
        // Theme Switcher (gleich wie in login.php)
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