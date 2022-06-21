<?php

namespace Mailchimp;

class Mobile
{
    public function __construct(Mailchimp $master)
    {
        $this->master = $master;
    }
}
