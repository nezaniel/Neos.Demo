<?php

declare(strict_types=1);

namespace Neos\Demo\Components\Columns;

use PackageFactory\ComponentEngine as _;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class Columns implements _\ComponentInterface
{
    private function __construct(
        private string $breakpoint,
        private int $columns,
        private ?string $class,
        private ?_\ComponentInterface $content,
    ) {
    }

    public static function create(
        string $breakpoint,
        int $columns,
        ?string $class,
        _\ComponentInterface|string|null $content,
    ): self {
        return new self(
            breakpoint: $breakpoint,
            columns: $columns,
            class: $class,
            content: is_string($content) ? _\StringComponent::fromString($content) : $content,
        );
    }

    public function render(): string
    {
        return '<div class="' . _\Util::joinAttributeValues(((($temp = $this->class) === null) ? '' : _\Util::escapeAttributeValue($temp)), 'grid grid-cols-1 gap-8', match ($this->breakpoint) { 'sm' => match ($this->columns) { 2 => 'sm:grid-cols-2', 3 => 'sm:grid-cols-3', 4 => 'sm:grid-cols-2 md:grid-cols-4' }, 'md' => match ($this->columns) { 2 => 'md:grid-cols-2', 3 => 'md:grid-cols-3', 4 => 'md:grid-cols-2 lg:grid-cols-4' }, 'lg' => match ($this->columns) { 2 => 'lg:grid-cols-2', 3 => 'lg:grid-cols-3', 4 => 'lg:grid-cols-2 xl:grid-cols-4' } }) . '">' . ((($temp = $this->content) === null) ? '' : $temp->render()) . '</div>';
    }
}
