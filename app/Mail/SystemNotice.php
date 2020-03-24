<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SystemNotice extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * 邮件属性
     *
     * @var
     */
    private $content, $systemEmail, $systemName, $systemHomepage;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->systemEmail, $this->systemName)
            ->markdown('emails.systemNotice', get_object_vars($this));
    }

    /**
     * @param mixed $content
     */
    public function setContent($content): void
    {
        $this->content = $content;
    }

    /**
     * @param mixed $systemEmail
     */
    public function setSystemEmail($systemEmail): void
    {
        $this->systemEmail = $systemEmail;
    }

    /**
     * @param mixed $systemName
     */
    public function setSystemName($systemName): void
    {
        $this->systemName = $systemName;
    }

    /**
     * @param mixed $systemHomepage
     */
    public function setSystemHomepage($systemHomepage): void
    {
        $this->systemHomepage = $systemHomepage;
    }

    /**
     * @param string $subject
     */
    public function setSubject(string $subject): void
    {
        $this->subject = $subject;
    }
}
