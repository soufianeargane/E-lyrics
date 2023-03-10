<?php
include_once 'classes/songClass.php';

$user = new Song();

function sanitize($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (count($_POST) > 0) {
    # code...
    $info = [];
    $info['action'] = $_POST['action'];

    if ($_POST['action'] == 'read') {

        $result = $user->getData();
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        $info['data'] = $result;
        echo json_encode($info);
    } elseif ($_POST['action'] == 'save') {
        for ($i = 0; $i < (sizeof($_POST) - 1) / 3; $i++) {
            # code... 
            $alias_singer = "singer_" . ($i + 1);
            $singer = sanitize($_POST[$alias_singer]);
            $alias_song = "song_" . ($i + 1);
            $song = sanitize($_POST[$alias_song]);
            $alias_lyrics = "lyrics_" . ($i + 1);
            $lyrics = sanitize($_POST[$alias_lyrics]);
            $result = $user->inserData($singer, $song, $lyrics);
        }
        echo json_encode($info);
    } elseif ($_POST['action'] == 'delete') {
        $id = $_POST['id'];
        $result = $user->deleteData($id);
        echo json_encode($info);
    } elseif ($_POST['action'] == 'edit') {
        $id = $_POST['id'];
        $result = $user->getSingleData($id);
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        $result = $result[0];
        $info['data'] = $result;
        echo json_encode($info);
    } elseif ($_POST['action'] == 'update') {
        $id = $_POST['id'];
        $singer = sanitize($_POST['singer']);
        $song = sanitize($_POST['song']);
        $lyrics = sanitize($_POST['lyrics']);
        $result = $user->updateData($id, $singer, $song, $lyrics);
        echo json_encode($info);
    } elseif ($_POST['action'] == 'sortbysinger' || $_POST['action'] == 'sortbysong') {
        $order = $_POST['order'];
        $result = $user->orderBy($order);
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        $info['data'] = $result;
        echo json_encode($info);
    }
}
