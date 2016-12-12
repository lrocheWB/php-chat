<?php

namespace App\Controller;

use App\Services\MessageManager;
use App\Modele\DBFactory;
use JMS\Serializer\SerializerBuilder;

class ChatController
{
    /**
     * @var MessageManager
     */
    private $messageManager;

    /**
     * @var SerializerBuilder
     */
    private $serializer;

    public function __construct()
    {
        $database = DBFactory::create('mysql');
        $this->messageManager = new MessageManager($database);
        $this->serializer = SerializerBuilder::create()->build();
    }

    public function getMessagesAction()
    {
        $messages = [];

        if (isset($_GET["csrf"]) && $_GET["csrf"] == $_SESSION["token"]) {
            $messages = $this->messageManager->get();
        }

        echo $this->serializer->serialize($messages, 'json');
    }

    public function postMessagesAction()
    {
        if (isset($_POST["csrf"]) && $_POST["csrf"] == $_SESSION["token"]) {
            $this->messageManager->post($_POST['user_id'], $_POST['msg']);
        }

        echo $this->serializer->serialize(['status_code' => 200], 'json');
    }
}
