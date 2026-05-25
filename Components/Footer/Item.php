<?php

declare(strict_types=1);

namespace Neos\Demo\Components\Footer;

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
        return '<a href="' . _\Util::escapeAttributeValue($this->uri) . '" class="block py-3 text-slate-600 hocus:text-slate-900">' . _\Util::escapeRenderValue($this->label) . '</a>';
    }
}
