<?php

/**
 * Composer autoloader
 */
require dirname(__DIR__) . '/vendor/autoload.php';


/**
 * Process the items in the queue
 */
$dir = dirname(__DIR__) . '/queue/';
$queue = new Queue($dir);

$mail = $queue->getNextItem();

while ($mail !== null) {

    /**
     * Configure the PHPMailer object and send the email
     */
    $mail->isSMTP();
    $mail->Host = Config::SMTP_HOST;
    $mail->Port = Config::SMTP_PORT;
    $mail->SMTPAuth = true;
    $mail->Username = Config::SMTP_USER;
    $mail->Password = Config::SMTP_PASSWORD;
    $mail->SMTPSecure = 'tls';
    $mail->CharSet = 'UTF-8';

    if ($mail->send()) {
        echo "Message sent!\n";
    } else {
        echo "Mailer error: " . $mail->ErrorInfo . "\n";
    }

    /**
     * Get the next queue item
     */
    $mail = $queue->getNextItem();
}
