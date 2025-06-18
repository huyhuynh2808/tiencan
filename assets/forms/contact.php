<?php
  /**
  * Requires the "PHP Email Form" library
  * The "PHP Email Form" library is available only in the pro version of the template
  * The library should be uploaded to: vendor/php-email-form/php-email-form.php
  * For more info and help: https://bootstrapmade.com/php-email-form/
  */

  // Replace contact@example.com with your real receiving email address
  $receiving_email_address = 'huyhuynh28082002@gmail.com';

  if( file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php' )) {
    include( $php_email_form );
  } else {
    die( 'Unable to load the "PHP Email Form" Library!');
  }

  $contact = new PHP_Email_Form;
  $contact->ajax = true;
  
  $contact->to = $receiving_email_address;
  $contact->from_name = $_POST['name'];
  $contact->from_email = $_POST['email'];
  $contact->subject = $_POST['subject'];

$contact->smtp = array(
  'host' => 'smtp.gmail.com', // Thay bằng host SMTP của nhà cung cấp email của bạn
  'username' => 'huyhuynh28082002@gmail.com', // Thay bằng địa chỉ email đầy đủ của bạn
  'password' => 'vlbv hhhe zyff riva', // Thay bằng mật khẩu (hoặc mật khẩu ứng dụng nếu dùng Gmail)
  'port' => '587', // Thường là 587 cho TLS hoặc 465 cho SSL
  'encryption' => 'tls' // Thêm dòng này nếu cần (hoặc 'ssl')
);

  $contact->add_message( $_POST['name'], 'From');
  $contact->add_message( $_POST['email'], 'Email');
  $contact->add_message( $_POST['message'], 'Message', 10);

  echo $contact->send();
  if ($contact->send()) {
  echo 'Gửi thành công';
} else {
  echo 'Gửi thất bại';
}
?>
