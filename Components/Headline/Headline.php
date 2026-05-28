<?php

declare(strict_types=1);

namespace Neos\Demo\Components\Headline;

use PackageFactory\ComponentEngine as _;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class Headline implements _\ComponentInterface
{
    private function __construct(
        private ?_\ComponentInterface $content,
        private string $tagName,
        private ?string $tagStyle,
        private ?string $class,
    ) {
    }

    public static function create(
        _\ComponentInterface|string|null $content,
        string $tagName,
        ?string $tagStyle,
        ?string $class,
    ): self {
        return new self(
            content: is_string($content) ? _\StringComponent::fromString($content) : $content,
            tagName: $tagName,
            tagStyle: $tagStyle,
            class: $class,
        );
    }

    public function render(): string
    {
        return '<' . ($_712_tag = match ($this->tagName) { 'h1' => 'h1', 'h2' => 'h2', 'h3' => 'h3', 'h4' => 'h4', 'h5' => 'h5', 'h6' => 'h6', default => 'div' }) . ' class="' . _\Util::joinAttributeValues('headline', (((($temp = $this->class) === null) ? false : true) ? ((($temp = $this->class) === null) ? '' : _\Util::escapeAttributeValue($temp)) : match ((((($temp = $this->tagStyle) === null) ? false : true) ? $this->tagStyle : $this->tagName)) { 'h1' => 'text-5xl', 'h2' => 'text-4xl', 'h3' => 'text-3xl', 'h4' => 'text-2xl', 'h5' => 'text-xl', default => 'text-lg' })) . '">' . ((($temp = $this->content) === null) ? '' : $temp->render()) . '</' . $_712_tag . '>';
    }
}
