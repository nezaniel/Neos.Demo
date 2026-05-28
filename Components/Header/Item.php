<?php

declare(strict_types=1);

namespace Neos\Demo\Components\Header;

use PackageFactory\ComponentEngine as _;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class Item implements _\ComponentInterface
{
    private function __construct(
        private string $uri,
        private string $label,
    ) {
    }

    public static function create(
        string $uri,
        string $label,
    ): self {
        return new self(
            uri: $uri,
            label: $label,
        );
    }

    public function render(): string
    {
        return '<li><a href="' . _\Util::escapeAttributeValue($this->uri) . '" class="block p-1 hocus:text-slate-900 text-lg lg:text-sm whitespace-nowrap">' . _\Util::escapeText($this->label) . '</a></li>';
    }
}
