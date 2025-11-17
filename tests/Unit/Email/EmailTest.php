<?php

namespace Tests\Unit\Email;

use PHPUnit\Framework\TestCase;
use FreightQuote\Email\Email;

class EmailTest extends TestCase
{
    private Email $email;

    public function setUp(): void
    {
        $this->email = new Email();
    }

    public function test_email_recipients(): void
    {
        $emailAddress = 'test@email.com';
        $this->email->addRecipient($emailAddress);
        $this->assertEquals([$emailAddress], $this->email->getRecipients());
    }

    public function test_email_cc(): void
    {
        $emailAddress = 'test@email.com';
        $this->email->addCC($emailAddress);
        $this->assertEquals([$emailAddress], $this->email->getCC());
    }

    public function test_email_bcc(): void
    {
        $emailAddress = 'test@email.com';
        $this->email->addBCC($emailAddress);
        $this->assertEquals([$emailAddress], $this->email->getBCC());
    }

    public function test_email_subject(): void
    {
        $subject = 'test subject';
        $this->email->setSubject($subject);
        $this->assertEquals($subject, $this->email->getSubject());
    }

    public function test_email_body(): void
    {
        $body = 'test body';
        $this->email->setBody($body);
        $this->assertEquals($body, $this->email->getBody());
    }

    public function test_email_attachments(): void
    {
        $path = '/path/to/file';
        $this->email->addAttachment($path);
        $this->assertEquals([$path], $this->email->getAttachments());
    }
}
