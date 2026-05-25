<?php

declare(strict_types=1);

namespace Neos\Demo\Components\Breadcrumb;

use PackageFactory\ComponentEngine as _;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class Breadcrumb implements _\ComponentInterface
{
    private function __construct(
        private _\ComponentInterface $content,
        private ?string $class,
    ) {
    }

    public static function create(
        _\ComponentInterface|string $content,
        ?string $class,
    ): self {
        return new self(
            content: is_string($content) ? _\StringComponent::fromString($content) : $content,
            class: $class,
        );
    }

    public function render(): string
    {
        return '<nav class="' . _\Util::joinAttributeValues([(($this->class !== null) ? (($temp = $this->class) === null ? '' : _\Util::escapeAttributeValue($temp)) : 'content text-sm mb-4'), 'print:hidden']) . '"><ul class="flex flex-wrap m-0">' . $this->content->render() . '</ul></nav>';
    }
}
