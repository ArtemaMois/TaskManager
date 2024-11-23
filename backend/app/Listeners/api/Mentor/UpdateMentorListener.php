<?php

namespace App\Listeners\api\Mentor;

use App\Events\UpdateUserEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class UpdateMentorListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UpdateUserEvent $event): void
    {
        $data = $this->getUpdatedData($event->data);
        Auth::user()->mentor()->update($data);
    }

    private function getUpdatedData(array $data): array
    {
        $result = $data;
        unset($result['photo']);
        return $result;
    }
}
