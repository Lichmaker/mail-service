<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReplyNotice extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * 发送方邮箱
     *
     * @var string
     */
    private $fromEmail;

    /**
     * 发送方名称
     *
     * @var string
     */
    private $fromName;

    /**
     * 邮件模版内容属性
     *
     * @var
     */
    private $url, $appName, $originUsername, $originContent, $replyUsername, $content, $articleUrl;

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
        return $this->from($this->fromEmail, $this->fromName)
            ->markdown('emails.replyNotice', get_object_vars($this));
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url): void
    {
        $this->url = $url;
    }

    /**
     * @param mixed $appName
     */
    public function setAppName($appName): void
    {
        $this->appName = $appName;
    }

    /**
     * @param mixed $originUsername
     */
    public function setOriginUsername($originUsername): void
    {
        $this->originUsername = $originUsername;
    }

    /**
     * @param mixed $originContent
     */
    public function setOriginContent($originContent): void
    {
        $this->originContent = $originContent;
    }

    /**
     * @param mixed $replyUsername
     */
    public function setReplyUsername($replyUsername): void
    {
        $this->replyUsername = $replyUsername;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content): void
    {
        $this->content = $content;
    }

    /**
     * @param mixed $articleUrl
     */
    public function setArticleUrl($articleUrl): void
    {
        $this->articleUrl = $articleUrl;
    }

    /**
     * @param string $subject
     */
    public function setSubject(string $subject): void
    {
        $this->subject = $subject;
    }

    /**
     * @param string $fromEmail
     */
    public function setFromEmail(string $fromEmail): void
    {
        $this->fromEmail = $fromEmail;
    }

    /**
     * @param string $fromName
     */
    public function setFromName(string $fromName): void
    {
        $this->fromName = $fromName;
    }
}
