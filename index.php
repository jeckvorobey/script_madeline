<?php
    if (!file_exists('madeline.php')) {
    copy('https://phar.madelineproto.xyz/madeline.php', 'madeline.php');
    }

    include 'madeline.php';

    const API_ID = 18982202;
    const API_HASH = 'd6f0bb999fa96cea4230dc9bb65da760';


    class  MyEventHandler  extends \danog\MadelineProto\EventHandler 
    {
        public function onUpdateNewMessage(array $update)
        {
            if ($update['message']['_'] === 'messageEmpty' || $update['message']['out'] ?? false) {
                return;
            }
            //print_r($update);
            return $update;
        }  
    }

    /*
     * Настройки для запуска библиотеки MadeLineProto
     */
    $settings = new \danog\MadelineProto\Settings;
    $settings->setAppInfo((new \danog\MadelineProto\Settings\AppInfo)
    ->setApiId(API_ID)
    ->setApihash(API_HASH)
    );
    /**
     * Запуск ссесси библиотеки
     */
    $MadelineProto = new \danog\MadelineProto\API('session.madeline', $settings);
    $MadelineProto->start();

    /**
     * запуск слушателя новых сообщений
     */
    $MadelineProto->startAndLoop(MyEventHandler::class);

    /**
     * Класс для отправки сообщения в ТГ
     */
    class SendMessagesTelegram 
        
    {
        private $mp;

        function __construct($MadelineProto){
            $this->mp = $MadelineProto;
        }
        /**
        * Принимает массив с данными
        * [
        *    'peer' => string
        *    'msg' => string
        * ]
        */
        function send($data) 
        {   
            if (empty($data)) return;

            $res = $this->mp->messages->sendMessage(['peer' => '333366854', 'message' => 'return 1111']);
            //print_r($res);
            return $res;
        }
    }
