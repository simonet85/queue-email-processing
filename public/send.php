<?php

/**
 * Start the timer
 */
$start_time = microtime(true);


/**
 * Composer autoloader
 */
require '../vendor/autoload.php';


/**
 * Create a new email
 */
$mail = new PHPMailer();

$mail->setFrom('sender@example.com');
$mail->addAddress('recipient@example.com');

$mail->Subject = 'An email sent from PHP';
$mail->Body = 'This is a test message';



/**
 * Add the email to the queue
 */
$dir = dirname(__DIR__) . '/queue/';
$queue = new Queue($dir);

if ($queue->push($mail) === false)
{
    echo 'Unable to queue email';
    exit();
}


/**
 * Calculate the time taken to execute the script
 */
$end_time = microtime(true);
$time = number_format($end_time - $start_time, 5);


/**
 * Return to index.php
 */
header("Location: index.php?time=$time");
exit();
