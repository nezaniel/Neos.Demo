<?php

declare(strict_types=1);

namespace Neos\Demo\Components\Layout;

use PackageFactory\ComponentEngine as _;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class Page implements _\ComponentInterface
{
    private function __construct(
        private ?_\ComponentInterface $header,
        private ?_\ComponentInterface $breadcrumb,
        private ?_\ComponentInterface $content,
        private ?_\ComponentInterface $footer,
    ) {
    }

    public static function create(
        _\ComponentInterface|string|null $header,
        _\ComponentInterface|string|null $breadcrumb,
        _\ComponentInterface|string|null $content,
        _\ComponentInterface|string|null $footer,
    ): self {
        return new self(
            header: is_string($header) ? _\StringComponent::fromString($header) : $header,
            breadcrumb: is_string($breadcrumb) ? _\StringComponent::fromString($breadcrumb) : $breadcrumb,
            content: is_string($content) ? _\StringComponent::fromString($content) : $content,
            footer: is_string($footer) ? _\StringComponent::fromString($footer) : $footer,
        );
    }

    public function render(): string
    {
        return ((($temp = $this->header) === null) ? '' : $temp->render()) . ((($temp = $this->breadcrumb) === null) ? '' : $temp->render()) . '<main class="content prose">' . ((($temp = $this->content) === null) ? '' : $temp->render()) . '</main>' . ((($temp = $this->footer) === null) ? '' : $temp->render());
    }
}
