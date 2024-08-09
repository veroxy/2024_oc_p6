<?php


require_once 'config/_config.php';
require_once 'config/autoload.php';

$action = Utils::request('action', 'welcome');

// Try catch global pour gérer les erreurs
try {
    // Pour chaque action, on appelle le bon contrôleur et la bonne méthode.
    switch ($action) {
        // Pages accessibles à tous.
        case 'welcome':
            $_SESSION['show-title'] = true;
            $welcomeController      = new WelcomeController();
            $welcomeController->welcome();
            break;

        // Section admin & connexion.
        case 'profile':

            $_SESSION['show-title'] = true;
            $profileId              = Utils::request('id');
            $userController         = new UserController();
            $userController->showProfile(isset($profileId) ? $profileId : $_SESSION['uid']);
            break;

        case 'updateProfile':
            $userController = new UserController();
            $userController->updateProfile();
            break;

        case 'messenger':
            $_SESSION['show-title'] = true;
            $userController         = new MessageController();
            $userController->showMessages();
            break;

        case 'sendMessage':
            $userController = new MessageController();
            $userController->sendMessage();
            break;
        case 'getCurrentSender':
            $senderId       = Utils::request('sender');
            $userController = new MessageController();
            $userController->getCurrentSender($senderId);

        case 'connectionForm':
            $adminController = new AdminController();
            $adminController->displayConnectionForm();
            break;

        case 'connectUser':
            $adminController = new AdminController();
            $adminController->connectUser();
            break;

        case 'suscribeForm':
            $adminController = new AdminController();
            $adminController->displaySuscribeForm();
            break;

        case 'suscribeUser':
            $adminController = new AdminController();
            $adminController->suscribeUser();
            break;
        case 'updateUser':
            $adminController = new AdminController();
            $adminController->updateUser();
            break;

        case 'disconnectUser':
            $adminController = new AdminController();
            $adminController->disconnectUser();
            break;
        // books
        case 'books':
            $articleController = new BookController();
            $articleController->all();
            break;
        case 'book':
            $_SESSION['show-title'] = true;
            $bookId                 = Utils::request('id');
            $articleController      = new BookController();
            $articleController->showBook($bookId);
            break;
        case 'updateBookForm':
            $bookId            = Utils::request('id');
            $articleController = new BookController();
            $articleController->updateBook($bookId);
            break;

        case 'updateFormScript':
            $bookUpdated       = $_REQUEST;
            $articleController = new BookController();
            $articleController->updateBookScript($bookUpdated);
            break;

        case 'deleteBook':
            $bookId            = Utils::request('id');
            $articleController = new BookController();
            $articleController->deleteBook($bookId);
            break;

        case 'searchBook':
            $bookSearch        = isset($_POST['search']) ? $_POST['search'] : null;
            $articleController = new BookController();
            if (isset($bookSearch)) {
                $articleController->searchBook($bookSearch);
            } else {
                $articleController->all();
            }
            break;
        default:
            throw new Exception("La page demandée n'existe pas.");
    }
} catch (Exception $e) {
    // En cas d'erreur, on affiche la page d'erreur.
    $errorView = new View('Erreur');
    if (DEV) {
        $errorView->render('errorPage',
            ['errorMessage' => $e->getMessage(),
                'errorFile' => $e->getFile(),
                'errorLine' => $e->getLine()
            ]);
    } else {
        $errorView->render('errorPage', ['errorMessage' => $e->getMessage()]);
    }
}
