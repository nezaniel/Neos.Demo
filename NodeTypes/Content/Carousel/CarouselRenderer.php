<?php

declare(strict_types=1);

namespace Neos\Demo\NodeTypes\Content\Carousel;

use Neos\Demo\Components\Slider\Slider;
use PackageFactory\ComponentEngine\ComponentInterface;
use PackageFactory\Neos\ComponentEngine\Integration\ContentNodeRendererInterface;
use PackageFactory\Neos\ComponentEngine\Integration\ContentRenderer;
use PackageFactory\Neos\ComponentEngine\Integration\RenderingUseCase;
use PackageFactory\Neos\ComponentEngine\NeosContext;

class CarouselRenderer implements ContentNodeRendererInterface
{
    public function __construct(
        private readonly ContentRenderer $contentRenderer,
    ) {
    }

    public function renderAsContent(NeosContext $context): ComponentInterface
    {
        return Slider::create(
            content: $this->contentRenderer->renderContentChildren($context, RenderingUseCase::CONTENT),
            class: null,
            label: null,
            sliderIsDecoration: false,
        );
    }
}
