<?php

namespace app\config\common;

use JetBrains\PhpStorm\ArrayShape;

class Params
{
    #[ArrayShape(['adminEmail' => "string", 'senderEmail' => "string", 'senderName' => "string"])]
    public static function cfg(): array
    {
        return [
            'adminEmail'  => 'admin@example.com',
            'senderEmail' => 'noreply@example.com',
            'senderName'  => 'Example.com mailer',
        ];
    }
}
