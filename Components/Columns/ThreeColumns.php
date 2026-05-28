<?php

declare(strict_types=1);

namespace Neos\Demo\Components\Columns;

use Neos\Demo\Components\Columns\Columns;
use PackageFactory\ComponentEngine as _;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class ThreeColumns implements _\ComponentInterface
{
    private function __construct(
        private ?_\ComponentInterface $content,
        private Columns $_810_Columns,
    ) {
    }

    public static function create(
        _\ComponentInterface|string|null $content,
    ): self {
        return new self(
            content: is_string($content) ? _\StringComponent::fromString($content) : $content,
            _810_Columns: Columns::create(
                breakpoint: 'md',
                columns: 3,
                class: null,
                content: _\SlotComponent::list(
                    $content,
                ),
            ),
        );
    }

    public function render(): string
    {
        return (((($temp = $this->content) === null) ? false : true) ? $this->_810_Columns->render() : '');
    }
}
