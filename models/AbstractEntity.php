<?php

namespace models;

use DateTime;

abstract class AbstractEntity
{
    // Par défaut l'id vaut -1, ce qui permet de vérifier facilement si l'entité est nouvelle ou pas. 
    protected int    $id   = -1;
    protected string $slug = "";

    protected DateTime $createdAt;
    protected DateTime $modifiedAt;

    /**
     * Constructeur de la classe.
     * Si un tableau associatif est passé en paramètre, on hydrate l'entité.
     *
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        if (!empty($data)) {
            $this->hydrate($data);
        }
    }

    /**
     * Système d'hydratation de l'entité.
     * Permet de transformer les données d'un tableau associatif.
     * Les noms de champs de la table doivent correspondre aux noms des attributs de l'entité.
     * Les underscore sont transformés en camelCase (ex: date_creation devient setDateCreation).
     * @return void
     */
    protected function hydrate(array $data): void
    {
        foreach ($data as $key => $value) {
            $method = 'set' . str_replace('_', '', ucwords($key, '_'));
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    /**
     * Getter pour la date de création.
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * Setter pour la date de création.
     * Si la date est une string, on la convertit en DateTime.
     * @param string|DateTime $dateCreatedAt
     * @param string $format : le format pour la convertion de la date si elle est une string.
     * Par défaut, c'est le format de date mysql qui est utilisé.
     */
    public function setCreatedAt(string|DateTime $dateCreatedAt, string $format = 'Y-m-d H:i:s'): void
    {
        if (is_string($dateCreatedAt)) {
            $dateCreatedAt = DateTime::createFromFormat($format, $dateCreatedAt);
        }
        $this->createdAt = $dateCreatedAt;
    }

    /**
     * Getter pour la date de modification.
     * @return DateTime
     */
    public function getDateModifieddAt(): DateTime
    {
        return $this->modifiedAt;
    }

    /**
     * Setter pour la date de modification.
     * Si la date est une string, on la convertit en DateTime.
     * @param string|DateTime $modifiedAt
     * @param string $format : le format pour la convertion de la date si elle est une string.
     * Par défaut, c'est le format de date mysql qui est utilisé.
     */
    public function setDateModifieddAt(string|DateTime $modifiedAt, string $format = 'Y-m-d H:i:s'): void
    {
        if (is_string($modifiedAt)) {
            $modifiedAt = DateTime::createFromFormat($format, $modifiedAt);
        }
        $this->modifiedAt = $modifiedAt;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {

        return $this->slug;
    }

    /**
     * @param string $input
     * @return void
     */
    public function setSlug(string $input): void
    {

        $textlower = isset($input) ? strtolower($input) : strtolower(isset($this->title));
        //convert special characters to normal
        $utf8normal   = iconv('utf-8', 'ascii//TRANSLIT', $textlower);
        $specialchars = preg_replace("/[:']/", '', $utf8normal);
        $this->slug   = str_replace(' ', '_', $specialchars);

    }

    /**
     * Getter pour l'id.
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Setter pour l'id.
     * @param int $id
     * @return void
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }
}