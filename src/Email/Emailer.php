<?php

namespace FreightQuote\Email;



interface Emailer
{
    public function send(Email $email): bool;
}
