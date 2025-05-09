<?php 
if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST["message"])) {
    $api_key = "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";
    $url = "https://openrouter.ai/api/v1/chat/completions";

    $user_message = trim($_POST["message"]);

    $data = [
        "model" => "deepseek/deepseek-r1:free",
        "messages" => [
            [
                "role" => "user",
                "content" => $user_message
            ]
        ]
    ];

    $headers = [
        "Authorization: Bearer " . $api_key,
        "Content-Type: application/json",
        "HTTP-Referer: <YOUR_SITE_URL>",
        "X-Title: <YOUR_SITE_NAME>"
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);
    curl_close($ch);

    $result = json_decode($response, true);
    $ai_response = $result['choices'][0]['message']['content'] ?? 'No response received. (User: Sagar) Limit end in api host: <a href="https://openrouter.ai/settings/keys">https://openrouter.ai/settings/keys</a>';

    echo json_encode(["success" => true, "message" => $ai_response]);
    exit;
}

echo json_encode(["success" => false, "error" => "Invalid request."]);
exit;