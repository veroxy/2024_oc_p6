<?php

namespace controllers;
use models\entities\User;
use Utils;

abstract class AbstactController
{


    private static false|User $connectedUser;

    /**
     * @return false|User
     */
    public static function getConnectedUser(): User|bool
    {
        return self::$connectedUser;
    }

    /**
     * @param false|User $connectedUser
     */
    public static function setConnectedUser(User|bool $connectedUser): void
    {
        self::$connectedUser = $connectedUser;
    }

    /**
     * Vérifie que l'utilisateur est connecté.
     * @return void
     */
    public function checkIfUserIsConnected(): void
    {
        // On vérifie que l'utilisateur est connecté.
        if (!isset($_SESSION['user'])) {
            Utils::redirect("connectionForm");
        }
    }

}