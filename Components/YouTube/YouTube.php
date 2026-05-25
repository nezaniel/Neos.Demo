<?php

declare(strict_types=1);

namespace Neos\Demo\Components\YouTube;

use Neos\Demo\Components\Alert\Alert;
use PackageFactory\ComponentEngine as _;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class YouTube implements _\ComponentInterface
{
    private function __construct(
        private ?string $videoId,
        private bool $inBackend,
        private Alert $_2114_Alert,
    ) {
    }

    public static function create(
        ?string $videoId,
        bool $inBackend,
    ): self {
        return new self(
            videoId: $videoId,
            inBackend: $inBackend,
            _2114_Alert: Alert::create(
                class: 'aspect-video',
                content: 'Neos.Demo:NodeTypes.Content.YouTube:error.no.videoid',
            ),
        );
    }

    public function render(): string
    {
        return (($this->videoId !== null) ? '<figure class="aspect-video"><iframe src="' . 'https://www.youtube.com/embed/' . (($temp = $this->videoId) === null ? '' : _\Util::escapeAttributeValue($temp)) . '?wmode=transparent' . '" width="100%" height="100%" frameborder="0" allowfullscreen></iframe></figure>' : ($this->inBackend ? $this->_2114_Alert->render() : ''));
    }
}
