<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Dev extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $a = date('Y-m-d His');
        $appName = '应用标题';
        $url = 'http://wuguozhang.com';
        return $this->from('lich.wu2014@gmail.com', "GuozhangWu's Blog")
            ->subject('这个是subject')
            ->markdown('emails.test', compact('a', 'appName', 'url'));
//        return $this->text('emails.test');
    }
}
