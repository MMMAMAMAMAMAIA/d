<?php
// Allow CORS so browser can call this file
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

// Your bot credentials (keep secret!)
$botToken = "8399262239:AAEq3d_Lt5LLTMBrktum0hjPznF2h-_EF3A";
$chatId = "-4845132846";

// Get JSON body from fetch()
$input = json_decode(file_get_contents("php://input"), true);
$message = $input["text"] ?? "No message";

// Telegram API URL
$url = "https://api.telegram.org/bot$botToken/sendMessage";

// Prepare data
$postData = [
    'chat_id' => $chatId,
    'text' => $message
];

// Send request with cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
$response = curl_exec($ch);
curl_close($ch);

// Return Telegram response as JSON
header('Content-Type: application/json');
echo $response;
?>
