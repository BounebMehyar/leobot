<?php

$dataSource = 'user.json';

$userid = $_GET['userid'];

$jsonData = file_get_contents($dataSource);
$userData = json_decode($jsonData, true);

$conversationTitles = [];

foreach ($userData as $user) {
    if ($user['userid'] == $userid) {
        if (isset($user['conversation'])) {
            foreach ($user['conversation'] as $conversation) {
                $conversationTitles[] = ['title' => $conversation['title']];
            }
        }
        break; 
    }
}

echo json_encode($conversationTitles);
?>
