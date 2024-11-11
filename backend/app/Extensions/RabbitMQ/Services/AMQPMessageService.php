<?php 

namespace App\Extensions\RabbitMQ\Services;

use App\Models\User;

class AMQPMessageService
{
    /**
     * Создает сообщение, передаваемое в RabbitMQ
     * 
     * @method string makeMessage()
     * 
     * @param string $executableClass
     * @param \App\Models\User $user
     * @return string
     */
    public function makeMessage(string $executableClass, mixed $params): string
    {
        $data = ['class' => $executableClass, 'data' => $params];
        $result = $this->serialize($data);
        return $result;
    }

    /**
     * Сериализует данные для сообщения
     * 
     * @method string serialize()
     * 
     * @param array $data
     * @return string
     */
    private function serialize(array $data): string
    {
        return serialize($data);
    }

    /**
     * Десериализует значение сообщения брокера
     * 
     * @method mixed deserialize()
     * @param string $data
     * @return mixed
     */
    public function deserialize(string $data)
    {
        return unserialize($data);
    }
}