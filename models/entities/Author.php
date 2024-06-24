<?php

namespace models\entities;

use models\AbstractEntity;

class Author extends AbstractEntity
{
    public string $fullname;

    /**
     * get nom prénom de l'auteur
     * @return string
     */
    public function getFullname(): string
    {
        return $this->fullname;
    }

    /**
     * get nom prénom de l'auteur
     * @param string $fullname
     * @return void
     */
    public function setFullname(string $fullname): void
    {
        $this->fullname = $fullname;
    }
}