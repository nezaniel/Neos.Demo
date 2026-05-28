<?php

declare(strict_types=1);

namespace Neos\Demo\NodeTypes\Content\TextWithImage;

use Neos\Demo\Components\Text\Text;
use PackageFactory\ComponentEngine\ComponentInterface;
use PackageFactory\Neos\ComponentEngine\Integration\ContentNodeRendererInterface;
use PackageFactory\Neos\ComponentEngine\NeosContext;

class TextWithImageRenderer implements ContentNodeRendererInterface
{
    public function renderAsContent(NeosContext $context): ComponentInterface
    {
        return Text::create(
            content: $context->neos->getEditable($context->node, 'text', false),
        );
    }
}
