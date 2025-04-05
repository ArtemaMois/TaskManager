<?php


namespace App\Services\Auth;

use App\Events\api\Auth\UserCreatedEvent;
use App\Extensions\RabbitMQ\Facades\RabbitMessage;
use App\Extensions\RabbitMQ\Facades\RabbitMQ;
use App\Jobs\api\Password\SendResetPasswordCodeJob;
use App\Models\User;
use Illuminate\Auth\Authenticatable;
use PhpAmqpLib\Message\AMQPMessage;

class AuthService
{

    public function registerUser(array $data): User
    {
        $data['password'] = $this->getEncryptedPassword($data['password']);
        $data['role_id'] = 3;
        $user = User::query()->create($data);
        $this->emailEvent($user);
        return $user;
    }

    private function getEncryptedPassword(string $password)
    {
        return bcrypt($password);
    }

    private function emailEvent(User $user)
    {
        event(new UserCreatedEvent($user));
    }

    public function resetPassword(User $user)
    {
        $message = RabbitMessage::makeMessage(SendResetPasswordCodeJob::class, $user);
        RabbitMQ::publish($message, 'laravel', 'verification');
    }

    public function getApiToken(User|Authenticatable $user): string
    {
        $token = $user->createToken(env('APP_NAME', "SkillBridge"), ['*'], now()->addYear())->plainTextToken; 
        return $token;
    }


}
