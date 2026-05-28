<?php

declare(strict_types=1);

namespace Neos\Demo\Components\Image;

use PackageFactory\ComponentEngine as _;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class Image implements _\ComponentInterface
{
    private function __construct(
        private string $src,
        private ?string $alt,
        private ?string $title,
        private ?string $class,
        private ?string $imageClass,
        private ?bool $hasCaption,
        private ?_\ComponentInterface $caption,
    ) {
    }

    public static function create(
        string $src,
        ?string $alt,
        ?string $title,
        ?string $class,
        ?string $imageClass,
        ?bool $hasCaption,
        _\ComponentInterface|string|null $caption,
        bool $renderDummyImage,
    ): self {
        return new self(
            src: $src,
            alt: $alt,
            title: $title,
            class: $class,
            imageClass: $imageClass,
            hasCaption: $hasCaption,
            caption: is_string($caption) ? _\StringComponent::fromString($caption) : $caption,
        );
    }

    public function render(): string
    {
        return '<figure' . ((($temp = $this->class) === null) ? '' : ' class="' . _\Util::escapeAttributeValue($temp) . '"') . '><img src="' . _\Util::escapeAttributeValue($this->src) . '"' . ((($temp = $this->title) === null) ? '' : ' title="' . _\Util::escapeAttributeValue($temp) . '"') . ((($temp = $this->alt) === null) ? '' : ' alt="' . _\Util::escapeAttributeValue($temp) . '"') . ((($temp = $this->imageClass) === null) ? '' : ' class="' . _\Util::escapeAttributeValue($temp) . '"') . ' />' . ((((($temp = $this->hasCaption) === null) ? false : $temp) && ((($temp = $this->caption) === null) ? false : true)) ? '<figcaption>' . ((($temp = $this->caption) === null) ? '' : $temp->render()) . '</figcaption>' : '') . '</figure>';
    }
}
