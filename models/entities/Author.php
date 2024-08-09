<?php

namespace models\entities;

use models\AbstractEntity;

/**
 *
 */
class Author extends AbstractEntity
{
    /**
     * @var string
     */
    private string $firstName;
    /**
     * @var string
     */
    private string $lastName;    /**
     * @var string
     */
    private string $fullname;

    /**
     * get nom prénom de l'auteur
     * @return string
     */
    public function getFullname(): string
    {
        return $this->fullname = $this->getFirstName() . ' ' . $this->getLastName();
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return $this
     */
    public function setFirstName(string $firstName): Author
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     *
     * /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return $this
     */
    public function setLastName(string $lastName): Author
    {
        $this->lastName = $lastName;
        return $this;
    }
}