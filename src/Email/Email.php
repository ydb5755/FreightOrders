<?php

namespace FreightQuote\Email;

class Email
{
    private array $recipients = [];
    private array $cc = [];
    private array $bcc = [];
    private string $subject = '';
    private string $body = '';
    private array $fileAttachments = [];

    public function addRecipient(string $email): void
    {
        $this->recipients[] = $email;
    }

    public function getRecipients(): array
    {
        return $this->recipients;
    }

    public function addCC(string $email): void
    {
        $this->cc[] = $email;
    }

    public function getCC(): array
    {
        return $this->cc;
    }

    public function addBCC(string $email): void
    {
        $this->bcc[] = $email;
    }

    public function getBCC(): array
    {
        return $this->bcc;
    }

    public function setSubject(string $subject): void
    {
        $this->subject = $subject;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function setBody(string $body): void
    {
        $this->body = $body;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function addAttachment(string $path): void
    {
        $this->fileAttachments[] = $path;
    }

    public function getAttachments(): array
    {
        return $this->fileAttachments;
    }
}
