<?php
class NotesController {
    public function index() {
        $notes = Note::getAllByUser($_SESSION['user_id']);
        require_once('views/notes/index.php');
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            Note::create($_SESSION['user_id'], $_POST['subject']);
            header('Location: ?controller=notes&action=index');
        } else {
            require_once('views/notes/create.php');
        }
    }

    public function edit() {
        $note = Note::get($_GET['id']);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            Note::update($_POST['id'], $_POST['subject'], isset($_POST['completed']) ? 1 : 0);
            header('Location: ?controller=notes&action=index');
        } else {
            require_once('views/notes/edit.php');
        }
    }

    public function delete() {
        Note::delete($_GET['id']);
        header('Location: ?controller=notes&action=index');
    }
}
