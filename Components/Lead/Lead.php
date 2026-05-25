<?php

declare(strict_types=1);

namespace Neos\Demo\Components\Lead;

use PackageFactory\ComponentEngine as _;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class Lead implements _\ComponentInterface
{
    private function __construct(
        private _\ComponentInterface $content,
    ) {
    }

    public static function create(
        _\ComponentInterface|string $content,
    ): self {
        return new self(
            content: is_string($content) ? _\StringComponent::fromString($content) : $content,
        );
    }

    public function render(): string
    {
        return (true ? '<p class="lead">' . $this->content->render() . '</p>' : '');
    }
}
