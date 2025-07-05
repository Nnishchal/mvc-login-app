<!DOCTYPE html>
<html>
<head>
    <title>MVC Reminder App</title>
    <link rel="stylesheet" href="public/style.css"> <!-- Optional -->
</head>
<body>
    <header>
        <nav>
            <ul style="list-style: none; display: flex; gap: 1rem;">
                <li><a href="?controller=home&action=index">Home</a></li>

                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="?controller=notes&action=index">Reminders</a></li>
                    <li><a href="?controller=login&action=logout">Logout</a></li>
                <?php else: ?>
                    <li><a href="?controller=login&action=login">Login</a></li>
                    <li><a href="?controller=login&action=register">Register</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <main>
