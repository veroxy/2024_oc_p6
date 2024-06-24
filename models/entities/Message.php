<?php

namespace models\entities;

use models\AbstractEntity;

class Message extends AbstractEntity
{
    public string $content = "";
    public User|int $sender;
    public User|int $receiver;

    /**
     * @return User|int
     */
    public function getReceiver(): User|int
    {
        return $this->receiver;
    }

    /**
     * @param User|int $receiver
     * @return $this
     */
    public function setReceiver(User|int $receiver): Message
    {
        $this->receiver = $receiver;
        return $this;
    }

    /**
     * @return User|int
     */
    public function getSender(): User|int
    {
        return $this->sender;
    }

    /**
     * @param User|int $sender
     * @return $this
     */
    public function setSender(User|int $sender): Message
    {
        $this->sender = $sender;
        return $this;
    }

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