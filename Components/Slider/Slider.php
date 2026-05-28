<?php

declare(strict_types=1);

namespace Neos\Demo\Components\Slider;

use PackageFactory\ComponentEngine as _;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class Slider implements _\ComponentInterface
{
    private function __construct(
        private ?_\ComponentInterface $content,
        private ?string $class,
        private ?string $label,
        private bool $sliderIsDecoration,
    ) {
    }

    public static function create(
        _\ComponentInterface|string|null $content,
        ?string $class,
        ?string $label,
        bool $sliderIsDecoration,
    ): self {
        return new self(
            content: is_string($content) ? _\StringComponent::fromString($content) : $content,
            class: $class,
            label: $label,
            sliderIsDecoration: $sliderIsDecoration,
        );
    }

    public function render(): string
    {
        return '<section x-data="slider"' . ((($temp = $this->label) === null) ? '' : ' aria-label="' . _\Util::escapeAttributeValue($temp) . '"') . ($this->sliderIsDecoration ? ' role="group"' : '') . ' class="' . _\Util::joinAttributeValues('splide', ((($temp = $this->class) === null) ? '' : _\Util::escapeAttributeValue($temp))) . '"><div class="splide__track">' . ((($temp = $this->content) === null) ? '' : $temp->render()) . '</div></section>';
    }
}
