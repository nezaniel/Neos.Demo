<?php

declare(strict_types=1);

namespace Neos\Demo\Components\Layout;

use Neos\Demo\Components\JavaScript\JavaScript;
use Neos\Demo\Components\Layout\DocumentMode;
use Neos\Demo\Components\Stylesheet\Stylesheet;
use PackageFactory\ComponentEngine as _;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class Document implements _\ComponentInterface
{
    /**
     * @param _\ComponentCollectionInterface<Stylesheet>|null $stylesheets
     * @param _\ComponentCollectionInterface<JavaScript>|null $headScripts
     */
    private function __construct(
        private string $title,
        private ?_\ComponentCollectionInterface $stylesheets,
        private ?_\ComponentCollectionInterface $headScripts,
        private ?_\ComponentInterface $neosHeaderStuff,
        private ?_\ComponentInterface $content,
        private ?_\ComponentInterface $neosBodyStuff,
        private DocumentMode $mode,
    ) {
    }

    /**
     * @param _\ComponentCollectionInterface<Stylesheet>|null $stylesheets
     * @param _\ComponentCollectionInterface<JavaScript>|null $headScripts
     */
    public static function create(
        string $title,
        ?_\ComponentCollectionInterface $stylesheets,
        ?_\ComponentCollectionInterface $headScripts,
        _\ComponentInterface|string|null $neosHeaderStuff,
        _\ComponentInterface|string|null $content,
        _\ComponentInterface|string|null $neosBodyStuff,
        DocumentMode $mode,
        ?string $debug,
    ): self {
        return new self(
            title: $title,
            stylesheets: $stylesheets,
            headScripts: $headScripts,
            neosHeaderStuff: is_string($neosHeaderStuff) ? _\StringComponent::fromString($neosHeaderStuff) : $neosHeaderStuff,
            content: is_string($content) ? _\StringComponent::fromString($content) : $content,
            neosBodyStuff: is_string($neosBodyStuff) ? _\StringComponent::fromString($neosBodyStuff) : $neosBodyStuff,
            mode: $mode,
        );
    }

    public function render(): string
    {
        return '<html><head><meta charset="UTF-8" /><meta name="viewport" content="width=device-width, initial-scale=1" /><meta name="format-detection" content="telephone=no" /><title>' . _\Util::escapeText($this->title) . '</title>' . ((($temp = $this->stylesheets) === null) ? '' : $temp->render()) . ((($temp = $this->headScripts) === null) ? '' : $temp->render()) . ((($temp = $this->neosHeaderStuff) === null) ? '' : $temp->render()) . '</head><body' . match ($this->mode) { DocumentMode::MODE_FRONTEND => ' class="wat"', DocumentMode::MODE_BACKEND => ' class="neos-backend"' } . '>' . ((($temp = $this->content) === null) ? '' : $temp->render()) . ((($temp = $this->neosBodyStuff) === null) ? '' : $temp->render()) . '</body></html>';
    }
}
