<?php

declare(strict_types=1);

namespace Neos\Demo\NodeTypes\Content\Columns\Three;

use Neos\ContentRepository\Core\SharedModel\Node\NodeName;
use Neos\Demo\Components\Columns\ThreeColumns;
use PackageFactory\ComponentEngine\ComponentCollection;
use PackageFactory\ComponentEngine\ComponentInterface;
use PackageFactory\Neos\ComponentEngine\Integration\ContentNodeRendererInterface;
use PackageFactory\Neos\ComponentEngine\Integration\ContentRenderer;
use PackageFactory\Neos\ComponentEngine\NeosContext;

class ThreeRenderer implements ContentNodeRendererInterface
{
    public function __construct(
        private readonly ContentRenderer $contentRenderer,
    ) {
    }

    public function renderAsContent(NeosContext $context): ComponentInterface
    {
        return ThreeColumns::create(ComponentCollection::list(
            $this->contentRenderer->forContentCollectionChildNode($context->node, NodeName::fromString('column0'), $context),
            $this->contentRenderer->forContentCollectionChildNode($context->node, NodeName::fromString('column1'), $context),
            $this->contentRenderer->forContentCollectionChildNode($context->node, NodeName::fromString('column2'), $context),
        ));
    }
}
