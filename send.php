
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = "yassengaming3737@gmail.com";
    $subject = "طلب جديد من موقع شداتك";

    $phone = $_POST['phone'] ?? '';
    $player_id = $_POST['player_id'] ?? '';
    $player_name = $_POST['player_name'] ?? '';
    $image_uploaded = false;
    $image_path = "";

    if (isset($_FILES['receipt']) && $_FILES['receipt']['error'] == 0) {
        $uploads_dir = __DIR__ . '/uploads';
        if (!is_dir($uploads_dir)) {
            mkdir($uploads_dir, 0777, true);
        }
        $image_path = $uploads_dir . '/' . basename($_FILES['receipt']['name']);
        move_uploaded_file($_FILES['receipt']['tmp_name'], $image_path);
        $image_uploaded = true;
    }

    $message = "رقم الهاتف: $phone\nID اللاعب: $player_id\nاسم اللاعب: $player_name\n";
    if ($image_uploaded) {
        $message .= "تم إرفاق صورة بالطلب.\n";
    }

    $headers = "From: no-reply@shadatak.com\r\nContent-Type: text/plain; charset=UTF-8\r\n";
    mail($to, $subject, $message, $headers);

    header("Location: thankyou.html");
    exit;
}
?>
