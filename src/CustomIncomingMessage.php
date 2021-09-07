<?php

namespace App\Conversation\Custom;

use BotMan\BotMan\Messages\Incoming\IncomingMessage;

class CustomIncomingMessage extends IncomingMessage
{
    /** @var array */
    protected $mixFile = [];

    public function __construct($message, $sender, $recipient, $payload = null)
    {
        parent::__construct($message, $sender, $recipient, $payload);
    }

    /**
     * @return array
     */
    public function getMixFile()
    {
        return $this->mixFile;
    }

    /**
     * @param array $mixFile
     */
    public function setMixFile(array $mixFile)
    {
        $this->mixFile = $mixFile;
    }
}