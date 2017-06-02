<?php
// parameters
$hubVerifyToken = 'TOKEN123456abcd';
$accessToken = "EAARBH2592OcBABNSuEMlSZB2DR8tnjQu7AJd0zDvc1ZCZClZAUfr9YPYF7wYutBlBwZCrxkYEGaGzuNYk1dm1sHBIxxlBnZAgiIchKNVcw7Notb26NO4sqNmEsZAKUejdssLRIkgJtmsuwYf6KnYKrjKtU9R6es7PapYV4Eaxmq5AZDZD";

// check token at setup
if ($_REQUEST['hub_verify_token'] === $hubVerifyToken) {
  echo $_REQUEST['hub_challenge'];
  exit;
}

// handle bot's anwser
$input = json_decode(file_get_contents('php://input'), true);

$senderId = $input['entry'][0]['messaging'][0]['sender']['id'];
$messageText = $input['entry'][0]['messaging'][0]['message']['text'];


$answer = "Sorry,I don't understand.";
if($messageText == "hi") {
    $answer = "Hello! Welcome to UpToDateRaho";
}

if($messageText == "what is your name?") {
    $answer = "My name is UpToDate BaBa";
}

if($messageText == "okay") {
    $answer = "hmm!";
}

if($messageText == "tell me about yourself") {
    $answer = "Well! I am UpToDate BaBa and I am here to keep you updated. You can ask me anything.";
}

if($messageText == "cool") {
    $answer = "yeah, BaBa is always cool :D";
}

$response = [
    'recipient' => [ 'id' => $senderId ],
    'message' => [ 'text' => $answer ]
];
$ch = curl_init('https://graph.facebook.com/v2.6/me/messages?access_token='.$accessToken);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($response));
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_exec($ch);
curl_close($ch);

//based on http://stackoverflow.com/questions/36803518
