<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["images"])) {
    $accessToken = "YOUR_ONEDRIVE_ACCESS_TOKEN";  // Replace with your token
    $folderPath = "WeddingUploads"; // Change folder name

    foreach ($_FILES["images"]["tmp_name"] as $key => $tmp_name) {
        $fileName = $_FILES["images"]["name"][$key];
        $filePath = $tmp_name;
        $fileData = file_get_contents($filePath);

        $uploadUrl = "https://graph.microsoft.com/v1.0/me/drive/root:/$folderPath/$fileName:/content";

        $headers = [
            "Authorization: Bearer $accessToken",
            "Content-Type: application/octet-stream"
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $uploadUrl);
        curl_setopt($ch, CURLOPT_PUT, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fileData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        curl_close($ch);
    }

    echo json_encode(["message" => "Upload successful!"]);
} else {
    echo json_encode(["message" => "No file uploaded."]);
}
?>
