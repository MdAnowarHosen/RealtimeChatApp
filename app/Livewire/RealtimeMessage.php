<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Events\SendMessageEvent;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class RealtimeMessage extends Component
{
    use LivewireAlert;



    public string $message;

    public function sendMessage()
    {
      //  event(new SendMessageEvent($this->message));

      SendMessageEvent::dispatch($this->message);

        $this->message = '';
    }

    #[On('echo:message,SendMessageEvent')]
    public function notifyNewOrder($payload)
    {
        $this->alert('info', $payload['message']);
    }

    public function render()
    {
        return view('livewire.realtime-message');
    }

}
