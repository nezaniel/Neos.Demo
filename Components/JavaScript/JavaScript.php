<?php

declare(strict_types=1);

namespace Neos\Demo\Components\JavaScript;

use PackageFactory\ComponentEngine as _;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class JavaScript implements _\ComponentInterface
{
    private function __construct(
        private string $uri,
    ) {
    }

    public static function create(
        string $uri,
    ): self {
        return new self(
            uri: $uri,
        );
    }

    public function render(): string
    {
        return '<script defer src="' . _\Util::escapeAttributeValue($this->uri) . '"></script>';
    }
}
