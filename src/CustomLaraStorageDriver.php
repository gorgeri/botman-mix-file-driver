<?php

namespace Gorgeri\Drivers\Custom;

use App\Conversation\Custom\CustomIncomingMessage;
use App\Conversation\Custom\MixFile;
use BotMan\BotMan\Messages\Attachments\CustomLocation;
use BotMan\BotMan\Messages\Attachments\Location;
use BotMan\Drivers\Web\WebDriver;

class CustomLaraStorageDriver extends WebDriver
{
    const ATTACHMENT_CUSTOM = 'custom';

    public function getMessages()
    {
        if (empty($this->messages)) {
            $message = $this->event->get('message');
            $userId = $this->event->get('chat_id');
            if (!$userId) {
                response()->error('Chat ID is Required')->send();
                die();
            }
            $sender = $this->event->get('sender', $userId);

            $incomingMessage = new CustomIncomingMessage($message, $sender, $userId, $this->payload);

            $incomingMessage = $this->addCustomAttachments($incomingMessage);

            $this->messages = [$incomingMessage];
        }

        return $this->messages;
    }

    protected function addCustomAttachments(CustomIncomingMessage $incomingMessage)
    {
        $attachment = $this->event->get('attachment');
        $files = isset($this->files['attachment_data']) ? $this->files['attachment_data'] : null;
        if ($attachment === self::ATTACHMENT_CUSTOM) {
            $images = collect($files)->map(function ($file) {
                //$path = store_file($file, 'chat'); store files
                return (new MixFile($file, $path))->toWebDriver();
            })->values()->toArray();
            $incomingMessage->setText(MixFile::PATTERN);
            $incomingMessage->setMixFile($images);
        } elseif ($attachment == self::ATTACHMENT_LOCATION) {
            $longitude = $this->event->get('longitude');
            $latitude = $this->event->get('latitude');
            $location_name = $this->event->get('location_name');

            $location = new CustomLocation($longitude, $latitude, $location_name);
            $incomingMessage->setText(Location::PATTERN);
            $incomingMessage->setLocation($location);
        }

        return $incomingMessage;
    }
}