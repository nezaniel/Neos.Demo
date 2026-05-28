<?php

declare(strict_types=1);

namespace Neos\Demo\Components\Breadcrumb;

use PackageFactory\ComponentEngine as _;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class Item implements _\ComponentInterface
{
    private function __construct(
        private bool $isFirst,
        private string $uri,
        private string $label,
    ) {
    }

    public static function create(
        bool $isFirst,
        string $uri,
        string $label,
    ): self {
        return new self(
            isFirst: $isFirst,
            uri: $uri,
            label: $label,
        );
    }

    public function render(): string
    {
        return '<li class="flex items-center">' . ((!$this->isFirst) ? '<span aria-hidden="true" class="block py-1 px-2 text-slate-400">›</span>' : '') . '<a href="' . _\Util::escapeAttributeValue($this->uri) . '" class="block py-2 text-slate-500 hocus:text-light hocus:underline">' . _\Util::escapeText($this->label) . '</a></li>';
    }
}
