<?php
class Note {
    public static function getAllByUser($user_id) {
        $db = Db::getInstance();
        $req = $db->prepare('SELECT * FROM notes WHERE user_id = ? AND deleted = 0');
        $req->execute([$user_id]);
        return $req->fetchAll();
    }

    public static function create($user_id, $subject) {
        $db = Db::getInstance();
        $req = $db->prepare('INSERT INTO notes (user_id, subject) VALUES (?, ?)');
        $req->execute([$user_id, $subject]);
    }

    public static function update($id, $subject, $completed) {
        $db = Db::getInstance();
        $req = $db->prepare('UPDATE notes SET subject = ?, completed = ? WHERE id = ?');
        $req->execute([$subject, $completed, $id]);
    }

    public static function delete($id) {
        $db = Db::getInstance();
        $req = $db->prepare('UPDATE notes SET deleted = 1 WHERE id = ?');
        $req->execute([$id]);
    }

    public static function get($id) {
        $db = Db::getInstance();
        $req = $db->prepare('SELECT * FROM notes WHERE id = ?');
        $req->execute([$id]);
        return $req->fetch();
    }
}
