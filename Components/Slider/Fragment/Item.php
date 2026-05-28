<?php

declare(strict_types=1);

namespace Neos\Demo\Components\Slider\Fragment;

use PackageFactory\ComponentEngine as _;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class Item implements _\ComponentInterface
{
    private function __construct(
        private ?string $videoUri,
        private ?string $youtubeId,
        private ?string $vimdeoId,
        private ?_\ComponentInterface $content,
        private ?string $class,
    ) {
    }

    public static function create(
        ?string $videoUri,
        ?string $youtubeId,
        ?string $vimdeoId,
        _\ComponentInterface|string|null $content,
        ?string $class,
    ): self {
        return new self(
            videoUri: $videoUri,
            youtubeId: $youtubeId,
            vimdeoId: $vimdeoId,
            content: is_string($content) ? _\StringComponent::fromString($content) : $content,
            class: $class,
        );
    }

    public function render(): string
    {
        return '<li' . ((($temp = $this->videoUri) === null) ? '' : ' data-splide-html-video="' . _\Util::escapeAttributeValue($temp) . '"') . (((($temp = $this->youtubeId) === null) ? false : true) ? ' data-splide-youtube="https://www.youtube.com/watch?v=' . ((($temp = $this->youtubeId) === null) ? '' : _\Util::escapeAttributeValue($temp)) . '"' : '') . (((($temp = $this->vimdeoId) === null) ? false : true) ? ' data-splide-vimeo="https://vimeo.com/' . ((($temp = $this->vimdeoId) === null) ? '' : _\Util::escapeAttributeValue($temp)) . '"' : '') . ' class="' . _\Util::joinAttributeValues('splide__slide', (((($temp = $this->class) === null) ? false : true) ? ((($temp = $this->class) === null) ? '' : _\Util::escapeAttributeValue($temp)) : 'flex flex-col items-center justify-center')) . '">' . ((($temp = $this->content) === null) ? '' : $temp->render()) . '</li>';
    }
}
