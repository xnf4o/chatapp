<?php

namespace App\Jobs;

use App\Http\Controllers\Api\ChatApp;
use App\Models\Mailing;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class SendMessageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $message, $number, $mailing_id, $access_token;
    private $chatApp;

    public function __construct($message, $number, $mailing_id, $access_token)
    {
        $this->message = $message;
        $this->number = $number;
        $this->mailing_id = $mailing_id;
        $this->access_token = $access_token;

        $this->chatApp = new ChatApp();
    }

    public function handle()
    {
        $mailing = Mailing::find($this->mailing_id);
        $response = $this->chatApp->sendMessage($this->number, $this->message, $this->access_token);
        if($response->success)
        {
            $mailing->update([
                'chatapp_id' => $response->data->id,
                'status' => 'in_progress',
            ]);
        }
        else
        {
            $mailing->update([
                'status' => 'failed',
            ]);
        }

        //Log::info('Send message to ' . $this->number . ' with text: ' . $this->message);
        // Здесь код для отправки сообщения, например, запись в базу данных или отправка API-запроса.
    }
}
