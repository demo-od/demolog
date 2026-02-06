<?php

namespace App\Mail;

use App\Services\GmailService;
use Symfony\Component\Mailer\SentMessage;
use Symfony\Component\Mailer\Transport\AbstractTransport;
use Symfony\Component\Mime\Email;

class GmailTransport extends AbstractTransport
{
    protected GmailService $gmail;

    public function __construct(GmailService $gmail)
    {
        parent::__construct();
        $this->gmail = $gmail;
    }

    protected function doSend(SentMessage $message): void
    {
        $email = $message->getOriginalMessage();

        if (!$email instanceof Email) {
            return;
        }

        $to = $email->getTo()[0]->getAddress();
        $subject = $email->getSubject();
        $html = $email->getHtmlBody() ?? $email->getTextBody();

        $this->gmail->send($to, $subject, $html);
    }

    public function __toString(): string
    {
        return 'gmail';
    }
}
