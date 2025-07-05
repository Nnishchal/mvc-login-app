<h2>Your Reminders</h2>
<a href="?controller=notes&action=create">➕ Create New Reminder</a>
<ul>
<?php foreach ($notes as $note): ?>
    <li>
        <strong><?= htmlspecialchars($note['subject']) ?></strong>
        <?= $note['completed'] ? '(✔ Completed)' : '' ?>
        | <a href="?controller=notes&action=edit&id=<?= $note['id'] ?>">✏ Edit</a>
        | <a href="?controller=notes&action=delete&id=<?= $note['id'] ?>" onclick="return confirm('Are you sure?')">🗑 Delete</a>
    </li>
<?php endforeach; ?>
</ul>
