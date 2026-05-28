<?php

declare(strict_types=1);

namespace Neos\Demo\Components\Alert;

use PackageFactory\ComponentEngine as _;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class Alert implements _\ComponentInterface
{
    private function __construct(
        private ?_\ComponentInterface $content,
        private ?string $class,
    ) {
    }

    public static function create(
        _\ComponentInterface|string|null $content,
        ?string $class,
    ): self {
        return new self(
            content: is_string($content) ? _\StringComponent::fromString($content) : $content,
            class: $class,
        );
    }

    public function render(): string
    {
        return (((($temp = $this->content) === null) ? false : true) ? '<p class="' . _\Util::joinAttributeValues(((($temp = $this->class) === null) ? '' : _\Util::escapeAttributeValue($temp)), 'flex items-center justify-center p-8 bg-orange-400 text-white text-xl') . '">' . ((($temp = $this->content) === null) ? '' : $temp->render()) . '</p>' : '');
    }
}
