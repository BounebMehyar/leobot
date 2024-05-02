<?php
// Assuming each conversation is stored in a JSON file named by conversation ID.

function getConversationFilePath($conversationId) {
    return "chats/{$conversationId}.json";
}

function sendMessageToConversation($conversationId, $message, $role) {
    $filePath = getConversationFilePath($conversationId);
    if (file_exists($filePath)) {
        $conversationData = json_decode(file_get_contents($filePath), true);
        // Append new message to the messages array
        $conversationData['messages'][] = [
            'role' => $role,
            'content' => $message,
            'timestamp' => date('Y-m-d H:i:s') // Add a timestamp to each message
        ];

        // Save the updated conversation back to the file
        if (file_put_contents($filePath, json_encode($conversationData, JSON_PRETTY_PRINT))) {
            return ['success' => true];
        } else {
            return ['success' => false, 'error' => 'Failed to write to conversation file.'];
        }
    } else {
        return ['success' => false, 'error' => 'Conversation file does not exist.'];
    }
}

// Get data from POST request
$conversationId = $_POST['conversationId'] ?? '';
$message = $_POST['message'] ?? '';
$role = 'user'; // Role can be 'user' or 'bot', depending on your application logic

// Validate inputs
if (empty($conversationId) || empty($message)) {
    echo json_encode(['success' => false, 'error' => 'Missing conversation ID or message.']);
    exit;
}

// Send message to conversation
$result = sendMessageToConversation($conversationId, $message, $role);
echo json_encode($result);
?>
