<h2>Edit Reminder</h2>
<form method="post">
    <input type="hidden" name="id" value="<?= $note['id'] ?>">
    <label>Subject:</label>
    <input type="text" name="subject" value="<?= htmlspecialchars($note['subject']) ?>" required>
    <label>Completed:</label>
    <input type="checkbox" name="completed" <?= $note['completed'] ? 'checked' : '' ?>>
    <button type="submit">Update</button>
</form>
