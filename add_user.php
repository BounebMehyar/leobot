<?php
// Function to check if the user already exists
function userExists($userid) {
    $users = json_decode(file_get_contents('user.json'), true);
    foreach ($users as $user) {
        if ($user['userid'] === $userid) {
            return true;
        }
    }
    return false;
}

// Function to add a new user
function addUser($userid, $username, $cin) {
    $users = json_decode(file_get_contents('user.json'), true);
    if (!userExists($userid)) {
        $users[] = [
            'userid' => $userid,
            'username' => $username,
            'cin' => $cin,
            'conversations' => []
        ];
        file_put_contents('user.json', json_encode($users, JSON_PRETTY_PRINT));
        echo json_encode(['success' => true, 'message' => 'User added']);
    } else {
        echo json_encode(['success' => false, 'message' => 'User already exists']);
    }
}

// Extract POST data
$userid = $_POST['userid'] ?? '';
$username = $_POST['username'] ?? '';
$cin = $_POST['cin'] ?? '';

// Add user
addUser($userid, $username, $cin);
?>
