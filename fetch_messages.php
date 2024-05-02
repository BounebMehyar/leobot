<?php
if (isset($_POST['conversation_id'])) {
    $conversationId = $_POST['conversation_id'];
    $filePath = "chats/{$conversationId}.json";

    if (file_exists($filePath)) {
        $chatData = file_get_contents($filePath);
        echo $chatData; // Send JSON data back to the client
    } else {
        echo json_encode(['error' => 'Conversation file not found.']);
    }
} else {
    echo json_encode(['error' => 'No conversation ID provided.']);
}
?>
