<?php

declare(strict_types=1);

namespace Neos\Demo\Components\Cards;

use PackageFactory\ComponentEngine as _;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class Container implements _\ComponentInterface
{
    private function __construct(
        private ?string $class,
        private _\ComponentInterface $content,
    ) {
    }

    public static function create(
        ?string $class,
        _\ComponentInterface|string $content,
    ): self {
        return new self(
            class: $class,
            content: is_string($content) ? _\StringComponent::fromString($content) : $content,
        );
    }

    public function render(): string
    {
        return '<div class="' . _\Util::joinAttributeValues(['grid sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-12 not-prose', (($temp = $this->class) === null ? '' : _\Util::escapeAttributeValue($temp))]) . '">' . $this->content->render() . '</div>';
    }
}
