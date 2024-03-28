<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Events\SendMessageEvent;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class RealtimeMessage extends Component
{




    public $message = '';
    public $messages = array();

    public function mount()
    {
        $messages = Message::orderBy('created_at', 'desc')->take(10)->get();
        $this->messages = $messages->reverse()->values()->all();
    }

    public function sendMessage()
    {
        //  event(new SendMessageEvent($this->message));

        SendMessageEvent::dispatch($this->message, Auth::id());
        $this->reset('message');
    }



    #[On('echo:message,SendMessageEvent')]
    public function sendMessageLive($payload)
    {

        $newMessage = new Message();
        $newMessage->user_id = $payload['auth_id'];
        $newMessage->content = $payload['message'];
        $newMessage->save();

        $this->messages[] = $newMessage;


        // Get the count of messages
        $messageCount = count($this->messages);

        // Check if there are more than 10 messages
        if ($messageCount > 10) {
            // Exclude the oldest 1 message
            $this->messages = array_slice($this->messages, 1);
        }

        if (Auth::id() == $payload['auth_id']) {
            $this->message = '';
        }

    }

    public function render()
    {
        return view('livewire.realtime-message');
    }
}
