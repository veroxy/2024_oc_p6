<?php

namespace repositories;

use BaseRepository;
use PDOStatement;

/**
 * Classe abstraite qui représente un manager. Elle récupère automatiquement le gestionnaire de base de données.
 */
abstract class AbstractEntityRepository
{

    protected $db;

    /**
     * Constructeur de la classe.
     * Il récupère automatiquement l'instance de BaseRepository.
     */
    public function __construct()
    {
        $this->db = BaseRepository::getInstance();
    }


    /**
     * Create an array object Aticle
     * @param PDOStatement $result
     * @return array
     */
    protected function getRelationToMany(PDOStatement $result, $class): array
    {
        $entities = [];
        while ($book = $result->fetch()) {
            $entity = new $class($book);
            $entities[] = $entity;
        }
        return $entities;
    }
}