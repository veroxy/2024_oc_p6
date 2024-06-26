<?php

use models\entities\User;
use repositories\BookRepository;
use repositories\UserRepository;

//use Book;
//use BookRepository;
//use CommentRepository;
//use UserRepository;

/**
 * Contrôleur de la partie admin.
 */
class AdminController extends \controllers\AbstactController
{



    /**
     * Affichage du formulaire de connexion.
     * @return void
     */
    public function displayConnectionForm(): void
    {
        $view = new View("Connexion");
        $view->render("connectionForm");
    }

    /**
     * Connexion de l'utilisateur.
     * @return void
     */
    public function connectUser(): void
    {
        // On récupère les données du formulaire.
        $login    = Utils::request("username");
        $password = Utils::request("password");

        var_dump($login, $password);
        // On vérifie que les données sont valides.
        if (empty($login) || empty($password)) {
            throw new Exception("Tous les champs sont obligatoires. 1");
        }

        // On vérifie que l'utilisateur existe.
        $userRepository = new UserRepository();
        $user           = $userRepository->getUserByLogin($login);

        if (!$user) {
            throw new Exception("L'utilisateur demandé n'existe pas.");
        }

        // On vérifie que le mot de passe est correct.
        if (!password_verify($password, $user->getPassword())) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            throw new Exception("Le mot de passe est incorrect : $hash");
        }

        // On connecte l'utilisateur.
        $_SESSION['user']   = $user;
        $_SESSION['idUser'] = $user->getId();

        // On redirige vers la page de profile.
        Utils::redirect("profile");
    }

    /**
     * /**
     * Affichage du formulaire de connexion.
     * @return void
     */
    public function displaySuscribeForm(): void
    {
        $view = new View("Inscription");
        $view->render("suscribeForm");
    }

    /**
     * Connexion de l'utilisateur.
     * @return void
     */
    public function suscribeUser(): void
    {

        // On récupère les données du formulaire.
        $username = Utils::request("username");
        $email    = Utils::request("email");
        $password = Utils::request("password");
        // On vérifie que les données sont valides.
        if (empty($username) || empty($email) || empty($password)) {
            throw new Exception("Tous les champs sont obligatoires. 1");
        }

        // On crée l'objet User.
        $user = new User([
            'username' => $username,
            'email' => $email,
            'password' => $password
        ]);

        // On vérifie que l'utilisateur n'existe pas déjà.
        $userRepository = new UserRepository();
        $entity         = $userRepository->addUser($user);
        if (!$entity) {
            throw new Exception("Une erreur est survenue lors de l'ajout de l'uilisateur ");
        }

        // On connecte l'utilisateur.
        $_SESSION['user']   = $user;
        $_SESSION['idUser'] = $entity->getId();

        // On redirige vers la page d'profile.
        Utils::redirect("profile");
    }

    /**
     * Déconnexion de l'utilisateur.
     * @return void
     */
    public function disconnectUser(): void
    {
        // On déconnecte l'utilisateur.
        unset($_SESSION['user']);

        // On redirige vers la page d'accueil.
        Utils::redirect("welcome");
    }

    /**
     * Affichage du formulaire d'ajout d'un book.
     * @return void
     */
    public function showUpdateBookForm(): void
    {
        $this->checkIfUserIsConnected();

        // On récupère l'id de l'book s'il existe.
        $id = Utils::request("id", -1);

        // On récupère l'book associé.
        $bookRepository = new BookRepository();
        $book           = $bookRepository->getBookById($id);


        // Si l'book n'existe pas, on en crée un vide.
        if (!$book) {
            $book = new Book;
        }


        // On affiche la page de modification de l'book.
        $view = new View("Edition d'un book");
        $view->render("updateBookForm", [
            'book' => $book
        ]);
    }

    /**
     * Ajout et modification d'un book.
     * On sait si un book est ajouté car l'id vaut -1.
     * @return void
     */
    public function updateBook(): void
    {
        $this->checkIfUserIsConnected();


        // On récupère les données du formulaire.
        $id      = Utils::request("id", -1);
        $title   = Utils::request("title");
        $content = Utils::request("content");

        // On vérifie que les données sont valides.
        if (empty($title) || empty($content)) {
            throw new Exception("Tous les champs sont obligatoires. 2");
        }

        // On crée l'objet Book.
        $book = new Book([
            'id' => $id, // Si l'id vaut -1, l'book sera ajouté. Sinon, il sera modifié.
            'title' => $title,
            'content' => $content,
            'id_user' => $_SESSION['idUser']
        ]);

        // On ajoute l'book.
        $bookRepository = new BookRepository();
        $bookRepository->addOrUpdateBook($book);

        // On redirige vers la page d'profile.
        Utils::redirect("profile");
    }

    /**
     * Suppression d'un book.
     * @return void
     */
    public function deleteBook(): void
    {
        $this->checkIfUserIsConnected();


        $id = Utils::request("id", -1);

        // On supprime l'book.
        $bookRepository = new BookRepository();
        $bookRepository->deleteBook($id);

        // On redirige vers la page d'profile.
        Utils::redirect("profile");
    }

    /**
     * Suppression d'un comment.
     * @return void
     */
    public
    function deleteComment(): void
    {
        $this->checkIfUserIsConnected();


        $id = Utils::request("id", -1);
        // On supprime l'book.
        $commentRepository = new CommentRepository();
        $commentRepository->deleteComment($id);

        // On redirige vers la page d'profile.
        Utils::redirect("profile");
    }

    public
    function orderBy(): void
    {
        $this->checkIfUserIsConnected();

        $order = Utils::request("order", 'ASC');
        $col   = Utils::request("col", 'title');

        $bookRepository = new BookRepository();
        $books          = $bookRepository->orderBy($col, $order);
        $view              = new View("profile");
        $view->render("profile", [
            'books' => $books
        ]);
    }


}