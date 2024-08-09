<?php


use controllers\AbstactController;
use models\entities\Message;
use repositories\MessageRepository;
use repositories\UserRepository;

class MessageController extends AbstactController
{

    /**
     * //     * @param int|null $senderId
     * @return void
     */
    public function showMessages(): void
    {

        $this->checkIfUserIsConnected();
        $senderId = Utils::request('sender') ?: null;
        $contacts = [];
        $sender   = null;
        if ($senderId) {
            $senderRepo = new UserRepository();
            $sender     = $senderRepo->getUserById($senderId);
        }
        $messageRepo      = new MessageRepository();
        $messagesContacts = $messageRepo->getAllMessages($_SESSION['uid']);
        $view             = new View("Messagerie");
        $view->render("messenger", [
            'contacts' => $messagesContacts['contacts'],
            'messages' => $messagesContacts['messages'],
            'sender' => $sender,]);
    }

    /**
     * @return void
     * @throws Exception
     */
    public function sendMessage(): void
    {
        // On récupère les données du formulaire.
        $id       = Utils::request("id", -1);
        $content  = Utils::request("content");
        $receiver = (int)Utils::request("receiver");

        $userRep     = new UserRepository();
        $id_receiver = $userRep->getUserById($receiver);
        // On vérifie que les données sont valides.
        if (empty($content)) {
            throw new Exception("Tous les champs sont obligatoires. 2");
        }

        // On crée l'objet Message.
        $message = new Message([
            'id' => $id, // Si l'id vaut -1, le ;essqge sera ajouté. Sinon, il sera modifié.
            'content' => $content,
            'sender' => $_SESSION['uid'],
            'receiver' => $receiver
        ]);


        $messageRepo = new MessageRepository();
        $messageRepo->sendMessage($message);
        var_dump('sortie repo', $messageRepo);
        // On redirige vers la page du profile.
        //  TOFIXED ["&sender=$receiver#newMsg"] parametre a mettre
        Utils::redirect("messenger", ['#newMsg']);
    }

    /**
     * // AJAX function
     * @param int|null $senderIdAx
     * @return array
     */
    public function getCurrentSender(?int $senderIdAx)
    {
        $userRepo = new UserRepository();
        $sender   = $userRepo->getUserById($senderIdAx);
        $msgRepo  = new MessageRepository();
        $messages = $msgRepo->getAllMessages($senderIdAx);


        $datas = [
            'sender' => $senderIdAx,
            'messages' => $messages
        ];
        $view  = new View("Messagerie");
        $view->render("messenger",
            $datas);
        return $datas;

    }
}