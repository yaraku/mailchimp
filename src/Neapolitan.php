<?php

namespace Mailchimp;

class Neapolitan
{
    public function __construct(Mailchimp $master)
    {
        $this->master = $master;
    }
}
