<?php
// add_message.php
$conversationId = $_POST['conversation_id'];
$message = [
    'timestamp' => time(),
    'text' => $_POST['message'],
    'sender' => 'user' // or 'bot', depending on the context
];

$filePath = "chats/{$conversationId}.json";

// Read the existing content of the file
$chatData = json_decode(file_get_contents($filePath), true);
$chatData['messages'][] = $message;

// Save the updated data back to the file
file_put_contents($filePath, json_encode($chatData, JSON_PRETTY_PRINT));

echo json_encode(['success' => true]);
?>
