<?php

declare(strict_types=1);

namespace Neos\Demo\Components\Cards;

use PackageFactory\ComponentEngine as _;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class Card implements _\ComponentInterface
{
    private function __construct(
        private string $uri,
        private string $title,
        private ?_\ComponentInterface $content,
        private ?string $date,
        private ?string $authorName,
        private ?string $imageUri,
        private ?string $class,
        private ?string $moreLabel,
    ) {
    }

    public static function create(
        string $uri,
        string $title,
        _\ComponentInterface|string|null $content,
        ?string $date,
        ?string $authorName,
        ?string $imageUri,
        ?string $class,
        ?string $moreLabel,
    ): self {
        return new self(
            uri: $uri,
            title: $title,
            content: is_string($content) ? _\StringComponent::fromString($content) : $content,
            date: $date,
            authorName: $authorName,
            imageUri: $imageUri,
            class: $class,
            moreLabel: $moreLabel,
        );
    }

    public function render(): string
    {
        return '<div class="' . _\Util::joinAttributeValues('block shadow-lg bg-white', ((($temp = $this->class) === null) ? '' : _\Util::escapeAttributeValue($temp))) . '"><a href="' . _\Util::escapeAttributeValue($this->uri) . '"><img class="w-full"' . ((($temp = $this->imageUri) === null) ? '' : ' src="' . _\Util::escapeAttributeValue($temp) . '"') . ' alt="" /></a><div class="mt-5 ml-8 italic text-sm">' . (((($temp = $this->date) === null) ? false : true) ? '<time' . ((($temp = $this->date) === null) ? '' : ' datetime="' . _\Util::escapeAttributeValue($temp) . '"') . '>' . ((($temp = $this->date) === null) ? '' : _\Util::escapeText($temp)) . '</time>' : '') . '</div><div class="p-8 pt-3"><h2 class="mb-2 text-xl font-medium leading-tight">' . _\Util::escapeText($this->title) . '</h2><p class="mb-4 text-base">' . ((($temp = $this->content) === null) ? '' : $temp->render()) . '</p>' . (((($temp = $this->authorName) === null) ? false : true) ? '<p class="pb-3 italic text-sm">' . ((($temp = $this->authorName) === null) ? '' : _\Util::escapeText($temp)) . '</p>' : '') . '<a href="' . _\Util::escapeAttributeValue($this->uri) . '" class="inline-block bg-light px-6 pt-2.5 pb-2 text-xs font-medium uppercase leading-normal text-white shadow-md hover:bg-light focus:bg-light active:bg-light">' . (((($temp = $this->moreLabel) === null) ? false : true) ? ((($temp = $this->moreLabel) === null) ? '' : _\Util::escapeText($temp)) : 'More') . '</a></div></div>';
    }
}
