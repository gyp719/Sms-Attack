<?php

namespace App\Jobs;

use App\Handlers\SmsHandler;
use App\Models\SmsTemplate;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendSmsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected SmsTemplate $smsTemplate;

    protected string $phone;

    public function __construct(SmsTemplate $smsTemplate, $phone)
    {
        $this->smsTemplate = $smsTemplate;;
        $this->phone = $phone;
    }

    public function handle()
    {
        $smsHandler = new SmsHandler();

        $smsHandler->send($this->smsTemplate, $this->phone);
    }
}
