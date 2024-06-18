<?php

namespace models\entities;

use models\AbstractEntity;

class Message extends AbstractEntity
{
    private string   $content = "";

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return $this
     */
    public function setContent(string $content): Message
    {
        $this->content = $content;
        return $this;
    }
}