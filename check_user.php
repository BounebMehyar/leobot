<?php
// Assuming user ID is passed via GET request for simplicity
$userid = $_GET['userid'] ;

$users = json_decode(file_get_contents('user.json'), true);
$exists = false;

foreach ($users as $user) {
    if ($user['userid'] === $userid) {
        $exists = true;
        break;
    }
}

echo json_encode(['exists' => $exists]);
?>
