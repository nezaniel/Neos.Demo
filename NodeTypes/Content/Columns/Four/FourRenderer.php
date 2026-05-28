<?php

declare(strict_types=1);

namespace Neos\Demo\NodeTypes\Content\Columns\Four;

use Neos\ContentRepository\Core\SharedModel\Node\NodeName;
use Neos\Demo\Components\Columns\FourColumns;
use PackageFactory\ComponentEngine\ComponentCollection;
use PackageFactory\ComponentEngine\ComponentInterface;
use PackageFactory\Neos\ComponentEngine\Integration\ContentNodeRendererInterface;
use PackageFactory\Neos\ComponentEngine\Integration\ContentRenderer;
use PackageFactory\Neos\ComponentEngine\NeosContext;

class FourRenderer implements ContentNodeRendererInterface
{
    public function __construct(
        private readonly ContentRenderer $contentRenderer,
    ) {
    }

    public function renderAsContent(NeosContext $context): ComponentInterface
    {
        return FourColumns::create(ComponentCollection::list(
            $this->contentRenderer->forContentCollectionChildNode($context->node, NodeName::fromString('column0'), $context),
            $this->contentRenderer->forContentCollectionChildNode($context->node, NodeName::fromString('column1'), $context),
            $this->contentRenderer->forContentCollectionChildNode($context->node, NodeName::fromString('column2'), $context),
            $this->contentRenderer->forContentCollectionChildNode($context->node, NodeName::fromString('column3'), $context),
        ));
    }
}
