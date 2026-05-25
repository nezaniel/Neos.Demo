<?php

declare(strict_types=1);

namespace Neos\Demo\Components\Layout;

use PackageFactory\ComponentEngine as _;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class Page implements _\ComponentInterface
{
    private function __construct(
        private _\ComponentInterface $header,
        private _\ComponentInterface $breadcrumb,
        private _\ComponentInterface $content,
        private _\ComponentInterface $footer,
    ) {
    }

    public static function create(
        _\ComponentInterface|string $header,
        _\ComponentInterface|string $breadcrumb,
        _\ComponentInterface|string $content,
        _\ComponentInterface|string $footer,
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
        return '' . $this->header->render() . '' . $this->breadcrumb->render() . '<main class="content prose">' . $this->content->render() . '</main>' . $this->footer->render() . '';
    }
}
