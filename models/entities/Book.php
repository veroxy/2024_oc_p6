<?php

namespace models\entities;

use models\AbstractEntity;

/**
 * Entité Book, un book est défini par les champs
 * id, id_user, title, content, date_creation, modifiedat
 */
class Book extends AbstractEntity
{
    private int $stock = 0;
    private User $user;
    private Author $author;
    private string $title = "";
    private string $content = "";
    private array|int $authors = [];
    private string|null $thumb = null; // TOFIXED Tomemory
    private ?int $views = 0;

    public
    function __construct(array $data = [])
    {
        parent::__construct($data);

        if ($this->title) {
            $this->setSlug($this->title);
        }

    }

    /**
     * get la miniature/illustration du livre
     * @return string|null
     */
    public function getThumb(): ?string
    {
        return $this->thumb;
    }

    /**
     * set la miniature/illustration du livre
     * @param string|null $thumb
     * @return void
     */
    public function setThumb(?string $thumb): void
    {
        $this->thumb = $thumb;
    }

    /**
     * get nombre si est en stock
     * @return int|null
     */
    public function getStock(): ?int
    {
        return $this->stock;
    }

    /**
     * set nb en stock
     * @param int|null $stock
     * @return void
     */
    public function setStock(?int $stock = 0): void
    {
        $this->stock = $stock;
    }

    public
    function getViews(): int
    {
        return $this->views;
    }

    public
    function setViews(?int $views): void
    {

        $this->views = $views != null ? $views : 0;
    }

    /**
     * @return array
     */
    public
    function getNbAuthors(): array|int
    {

        return is_int($this->authors) ? $this->authors : count($this->authors);
    }

    /**
     * auteur principal
     * @return Author
     */
    public
    function getAuthor(): Author
    {
        if (is_array($this->authors) && isset($this->authors) && !empty($this->authors)) {
            return $this->authors[0];
        } else {
            return $this->author;
        }
    }

    /**
     * @param Author $author
     */
    public function setAuthor(Author $author): void
    {
        $this->author = $author;
    }

    /**
     * list des auteur ayant participer
     * @return array
     */
    public
    function getAuthors(): array
    {

        if (is_array($this->authors)) {
            return $this->authors;
        }
    }

    /**
     * @param array $authors
     */
    public
    function setAuthors(array|int $authors): void
    {
        $this->authors = $authors;
    }

    /**
     * Getter pour l'id de l'utilisateur.
     * @return User
     */
    public
    function getUser(): User
    {
        return $this->user;
    }

    /**
     * Setter pour l'id de l'utilisateur.
     * @param User $user
     */
    public
    function setUser(User $user): void
    {
        $this->user = $user;
    }

    /**
     * Getter pour le titre.
     * @return string
     */
    public
    function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Setter pour le titre.
     * @param string $title
     */
    public
    function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * Getter pour le contenu.
     * Retourne les $length premiers caractères du contenu.
     * @param int $length : le nombre de caractères à retourner.
     * Si $length n'est pas défini (ou vaut -1), on retourne tout le contenu.
     * Si le contenu est plus grand que $length, on retourne les $length premiers caractères avec "..." à la fin.
     * @return string
     */
    public
    function getContent(int $length = -1): string
    {
        if ($length > 0) {
            // Ici, on utilise mb_substr et pas substr pour éviter de couper un caractère en deux (caractère multibyte comme les accents).
            $content = mb_substr($this->content, 0, $length);
            if (strlen($this->content) > $length) {
                $content .= "...";
            }
            return $content;
        }
        return $this->content;
    }

    /**
     * Setter pour le contenu.
     * @param string $content
     */
    public
    function setContent(string $content): void
    {
        $this->content = $content;
    }

}