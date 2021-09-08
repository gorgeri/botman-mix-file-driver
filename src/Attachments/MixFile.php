<?php

namespace Gorgeri\Drivers\Custom\Attachments;

use BotMan\BotMan\Messages\Attachments\Attachment;

class MixFile extends Attachment
{
    /**
     * Pattern that messages use to identify image uploads.
     */
    const PATTERN = '%%%_MIX_FILING_%%%';

    /** @var string */
    protected $url;

    protected $file;

    /** @var string */
    protected $title;

    /**
     * Video constructor.
     * @param $file
     * @param string $url
     * @param mixed $payload
     */
    public function __construct($file, $url, $payload = null)
    {
        parent::__construct($payload);
        $this->file = $file;
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param string $file
     */
    public function setFile(string $file)
    {
        $this->file = $file;
    }

    /**
     * @param $url
     * @return MixFile
     */
    public function url($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param $title
     * @return MixFile
     */
    public function title($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get the instance as a web accessible array.
     * This will be used within the WebDriver.
     *
     * @return array
     */
    public function toWebDriver()
    {
        return [
            'type' => 'mix',
            'url' => $this->url,
            'file_type' => $this->file ? $this->file->getMimeType() : null,
            'title' => $this->title,
        ];
    }
}