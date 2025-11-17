<?php

namespace Tests\Fakes\Email;

use FreightQuote\Email\Email;
use FreightQuote\Email\Emailer;

class FakeEmailer implements Emailer
{
    private int $sentEmailCount = 0;

    public function getSentEmailCount(): int
    {
        return $this->sentEmailCount;
    }

    public function send(Email $email): bool
    {
        if (count($email->getRecipients()) > 0) {
            $this->sentEmailCount++;

            return true;
        }

        return false;
    }
}
