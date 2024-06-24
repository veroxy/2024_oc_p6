<?php

namespace models\entities;

use DateTime;
use models\AbstractEntity;

/**
 * Entité représentant un commentaire.
 * Avec les champs id, pseudo, content, et idBook.
 */
class Comment extends AbstractEntity
{
    public int      $idBook;
    public string   $pseudo;
    public string   $content;

    /**
     * Getter pour l'id de l'book.
     * @return int
     */
    public function getIdBook(): int
    {
        return $this->idBook;
    }

    /**
     * Setter pour l'id de l'book.
     * @param int $idBook
     * @return void
     */
    public function setIdBook(int $idBook): void
    {
        $this->idBook = $idBook;
    }

    /**
     * Getter pour le pseudo.
     * @return string
     */
    public function getPseudo(): string
    {
        return $this->pseudo;
    }

    /**
     * Setter pour le pseudo.
     * @param string $pseudo
     * @return void
     */
    public function setPseudo(string $pseudo): void
    {
        $this->pseudo = $pseudo;
    }

    /**
     * Getter pour le contenu.
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * Setter pour le contenu.
     * @param string $content
     * @return void
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * Getter pour la date de création.
     * @return DateTime
     */
}