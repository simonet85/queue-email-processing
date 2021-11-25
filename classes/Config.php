<?php

/**
 * Configuration settings
 *
 * PHP version 7.0
 */
class Config
{

    /**
     * SMTP host
     *
     * @var string
     */
    const SMTP_HOST = 'mail.example.com';

    /**
     * SMTP port
     *
     * @var int
     */
    const SMTP_PORT = 587;

    /**
     * SMTP user
     *
     * @var string
     */
    const SMTP_USER = 'sender@example.com';

    /**
     * SMTP password
     *
     * @var string
     */
    const SMTP_PASSWORD = 'secret';
}
