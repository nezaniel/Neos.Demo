<?php

declare(strict_types=1);

namespace Neos\Demo\Components\Stylesheet;

use PackageFactory\ComponentEngine as _;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class Stylesheet implements _\ComponentInterface
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
        return '<link rel="stylesheet" href="' . _\Util::escapeAttributeValue($this->uri) . '" />';
    }
}
