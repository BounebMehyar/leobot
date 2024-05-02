<?php
// create_chat.php
$conversationId = uniqid('conversation_'); // Create a unique ID for the conversation

// Initialize an empty array for the chat
$chatData = [
    'conversation_id' => $conversationId,
    'messages' => []
];

// Determine the file path
$filePath = "chats/conv{$conversationId}.json"; // Make sure the chats directory exists

// Create the JSON file with initial data
if (file_put_contents($filePath, json_encode($chatData, JSON_PRETTY_PRINT))) {
    echo json_encode(['success' => true, 'conversationId' => $conversationId]);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to create the chat file.']);
}



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

