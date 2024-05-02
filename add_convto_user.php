<?php
// Function to add a conversation to a user
function addConversation($userid, $conversationId, $title, $filePath) {
    $users = json_decode(file_get_contents('user.json'), true);
    foreach ($users as &$user) {
        if ($user['userid'] === $userid) {
            $user['conversations'][] = [
                'conversationId' => $conversationId,
                'title' => $title,
                'filePath' => $filePath
            ];
            file_put_contents('user.json', json_encode($users, JSON_PRETTY_PRINT));
            return;
        }
    }
}

// Example usage
addConversation('1', 'conv3', 'Support Query 3', 'chats/conv3.json');
?>
