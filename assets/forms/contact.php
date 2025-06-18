<?php
// Cho phép CORS và POST
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json; charset=utf-8');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/PHPMailer/Exception.php';
require '../vendor/PHPMailer/PHPMailer.php';
require '../vendor/PHPMailer/SMTP.php';

// Cấu hình email
$receiving_email_address = 'huyhuynh28082002@gmail.com'; // Email nhận thông báo

// Kiểm tra và xử lý dữ liệu form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $subject = $_POST['subject'] ?? '';
    $message = $_POST['message'] ?? '';

    // Kiểm tra dữ liệu
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        echo json_encode(['status' => 'error', 'message' => 'Vui lòng điền đầy đủ thông tin']);
        exit;
    }

    try {
        $mail = new PHPMailer(true);

        // Cấu hình server
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'huyhuynh28082002@gmail.com'; // Email Gmail của bạn
        $mail->Password = 'tcor oetu thjk dari'; // Mật khẩu ứng dụng Gmail (16 ký tự)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        $mail->CharSet = 'UTF-8';

        // Người gửi và người nhận
        $mail->setFrom($email, $name);
        $mail->addAddress($receiving_email_address);

        // Nội dung email
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = "
            <html>
            <body>
                <h2>Thông tin liên hệ mới</h2>
                <p><strong>Tên:</strong> $name</p>
                <p><strong>Email:</strong> $email</p>
                <p><strong>Chủ đề:</strong> $subject</p>
                <p><strong>Nội dung:</strong><br>$message</p>
            </body>
            </html>";

        $mail->send();
        echo json_encode(['status' => 'success', 'message' => 'Tin nhắn của bạn đã được gửi thành công!']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => 'Có lỗi xảy ra khi gửi tin nhắn: ' . $mail->ErrorInfo]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Phương thức không hợp lệ']);
}
?>
