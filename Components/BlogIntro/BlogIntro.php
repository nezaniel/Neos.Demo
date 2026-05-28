<?php

declare(strict_types=1);

namespace Neos\Demo\Components\BlogIntro;

use Neos\Demo\Components\Headline\Headline;
use PackageFactory\ComponentEngine as _;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class BlogIntro implements _\ComponentInterface
{
    private function __construct(
        private ?_\ComponentInterface $abstract,
        private ?string $imageUri,
        private ?string $author,
        private ?string $date,
        private Headline $_1616_Headline,
    ) {
    }

    public static function create(
        _\ComponentInterface|string|null $title,
        _\ComponentInterface|string|null $abstract,
        ?string $imageUri,
        ?string $author,
        ?string $date,
    ): self {
        return new self(
            abstract: is_string($abstract) ? _\StringComponent::fromString($abstract) : $abstract,
            imageUri: $imageUri,
            author: $author,
            date: $date,
            _1616_Headline: Headline::create(
                content: _\SlotComponent::list(
                    $title,
                ),
                tagName: 'h1',
                tagStyle: 'h1',
                class: null,
            ),
        );
    }

    public function render(): string
    {
        return '<div class="flex flex-wrap justify-center"><div class="text-center lg:w-8/12">' . $this->_1616_Headline->render() . '<p>' . ((($temp = $this->abstract) === null) ? '' : $temp->render()) . '</p><p>' . ((($temp = $this->date) === null) ? '' : _\Util::escapeText($temp)) . ' - ' . ((($temp = $this->author) === null) ? '' : _\Util::escapeText($temp)) . '</p></div></div>' . (((($temp = $this->imageUri) === null) ? false : true) ? '<div class="bg-cover bg-center max-h-48 h-screen print:h-auto print:!bg-none"' . (((($temp = $this->imageUri) === null) ? false : true) ? ' style="background-image: url(' . ((($temp = $this->imageUri) === null) ? '' : _\Util::escapeAttributeValue($temp)) . ');"' : '') . '></div>' : '');
    }
}
