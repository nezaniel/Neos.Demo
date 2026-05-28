<?php

declare(strict_types=1);

namespace Neos\Demo\Components\TextWithImage;

use Neos\Demo\Components\Image\Image;
use PackageFactory\ComponentEngine as _;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class TextWithImage implements _\ComponentInterface
{
    private function __construct(
        private ?_\ComponentInterface $text,
        private string $src,
        private bool $renderDummyImage,
        private Image $_1912_Image,
    ) {
    }

    public static function create(
        _\ComponentInterface|string|null $text,
        string $src,
        ?string $alt,
        ?string $title,
        ?bool $hasCaption,
        _\ComponentInterface|string|null $caption,
        bool $renderDummyImage,
    ): self {
        return new self(
            text: is_string($text) ? _\StringComponent::fromString($text) : $text,
            src: $src,
            renderDummyImage: $renderDummyImage,
            _1912_Image: Image::create(
                src: $src,
                alt: $alt,
                title: $title,
                class: 'md:mb-0',
                imageClass: 'w-full max-w-none',
                hasCaption: $hasCaption,
                caption: $caption,
                renderDummyImage: $renderDummyImage,
            ),
        );
    }

    public function render(): string
    {
        return (((((($temp = $this->text) === null) ? false : true) || true) || $this->renderDummyImage) ? '<div class="md:flex md:flex-wrap md:gap-4 md:flex-row">' . $this->_1912_Image->render() . '<div class="min-w-[30ch] flex-1">' . ((($temp = $this->text) === null) ? '' : $temp->render()) . '</div></div>' : '');
    }
}
