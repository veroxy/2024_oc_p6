<?php

namespace repositories;

use models\entities\Message;

class MessageRepository extends AbstractEntityRepository
{
    public function getAllMessages(int $idUser)
    {

        $sql      = "SELECT m.*,current_receiver.*
                FROM message m
                         JOIN user current_receiver
                              ON m.user_id_receiver = current_receiver.id
                         JOIN user sender
                              ON sender.id = m.user_id_sender
                         join user as_receiver
                              ON m.user_id_sender = as_receiver.id
                WHERE current_receiver.id = $idUser
                   OR as_receiver.id = $idUser
                ORDER BY m.created_at ASC ;";
        $result   = $this->db->query($sql);
        $contacts = [];

        while ($message = $result->fetch()) {
//            var_dump($message);
            $sender   = new UserRepository();
            $receiver = new UserRepository();
            $sender   = $sender->getUserById($message['user_id_sender']);
            $receiver = $receiver->getUserById($message['user_id_receiver']);
            $msg      = new Message($message);
            $msg->setSender($sender);
            $msg->setReceiver($receiver);
            $messages[] = $msg;
        }
        foreach ($messages as $message) {
            array_push($contacts, $message->getSender());
            array_push($contacts, $message->getReceiver());
        }
        $contacts = array_unique($contacts, SORT_REGULAR);

        return ['messages' => $messages, 'contacts' => $contacts];
    }

    public function sendMessage(Message $message): void
    {

        if ($message->getId() == -1) {
            $sql = "INSERT INTO message (user_id_sender, 
                     user_id_receiver,
                     content, 
                     created_at,
                     modified_at)
                    VALUES (:user_id_sender,
                            :user_id_receiver,
                            :content,
                            NOW(),
                            NOW()
                    )";
//            var_dump($message);
            $datas = [
                'user_id_sender' => $message->getSender(),
                'user_id_receiver' => $message->getReceiver(),
                'content' => $message->getContent(),
            ];
            var_dump($datas, $message);
//            die();

            $this->db->query($sql, $datas);
        }
    }
}