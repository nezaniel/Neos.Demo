<?php

declare(strict_types=1);

namespace Neos\Demo\Components\Layout;

enum DocumentMode : string
{
    case MODE_FRONTEND = 'frontend';
    case MODE_BACKEND = 'backend';

    public function asString(): string
    {
        return $this->value;
    }

    public function asText(): string
    {
        return $this->value;
    }

    public function asAttributeValue(): string
    {
        return $this->value;
    }
}
