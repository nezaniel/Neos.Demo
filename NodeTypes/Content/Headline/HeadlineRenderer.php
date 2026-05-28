<?php

declare(strict_types=1);

namespace Neos\Demo\NodeTypes\Content\Headline;

use Neos\Demo\Components\Headline\Headline;
use PackageFactory\ComponentEngine\ComponentInterface;
use PackageFactory\Neos\ComponentEngine\Integration\ContentNodeRendererInterface;
use PackageFactory\Neos\ComponentEngine\NeosContext;

class HeadlineRenderer implements ContentNodeRendererInterface
{
    public function renderAsContent(NeosContext $context): ComponentInterface
    {
        return Headline::create(
            content: $context->neos->getEditable($context->node, 'title', false),
            tagName: $context->nodes->getStringValue($context->node, 'tagName') ?: 'h2',
            tagStyle: $context->nodes->getStringValue($context->node, 'tagStyle'),
            class: null,
        );
    }
}
