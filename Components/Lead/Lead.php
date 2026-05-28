<?php

declare(strict_types=1);

namespace Neos\Demo\Components\Lead;

use PackageFactory\ComponentEngine as _;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class Lead implements _\ComponentInterface
{
    private function __construct(
        private ?_\ComponentInterface $content,
    ) {
    }

    public static function create(
        _\ComponentInterface|string|null $content,
    ): self {
        return new self(
            content: is_string($content) ? _\StringComponent::fromString($content) : $content,
        );
    }

    public function render(): string
    {
        return (((($temp = $this->content) === null) ? false : true) ? '<p class="lead">' . ((($temp = $this->content) === null) ? '' : $temp->render()) . '</p>' : '');
    }
}
