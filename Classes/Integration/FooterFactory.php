<?php

declare(strict_types=1);

namespace Neos\Demo\Integration;

use Neos\ContentRepository\Core\Projection\ContentGraph\Filter\FindReferencesFilter;
use Neos\ContentRepository\Core\Projection\ContentGraph\Reference;
use Neos\ContentRepository\Core\SharedModel\Node\NodeName;
use Neos\ContentRepository\Core\SharedModel\Node\ReferenceName;
use Neos\Demo\Components\Footer\Footer;
use Neos\Demo\Components\Footer\Item;
use Neos\Flow\Annotations as Flow;
use PackageFactory\ComponentEngine\ComponentCollection;
use PackageFactory\Neos\ComponentEngine\Integration\ContentRenderer;
use PackageFactory\Neos\ComponentEngine\NeosContext;

class FooterFactory
{
    public function __construct(
        private readonly ContentRenderer $contentRenderer,
    ) {
    }

    public function create(NeosContext $context): Footer
    {
        return Footer::create(
            menuItems: ComponentCollection::list(
                ...array_map(
                    fn(Reference $reference): Item => Item::create(
                        uri: (string)$context->neos->getNodeUri($reference->node, true),
                        label: $context->nodes->getLabel($reference->node),
                    ),
                    iterator_to_array(
                        $context->subgraph->findReferences(
                            nodeAggregateId: $context->siteNode->aggregateId,
                            filter: FindReferencesFilter::create(
                                referenceName: ReferenceName::fromString('metaNavigationItems')
                            )
                        )
                    ),
                ),
            ),
            content: $this->contentRenderer->forContentCollectionChildNode(
                node: $context->siteNode,
                collectionName: NodeName::fromString('footer'),
                context: $context,
                additionalClasses: ['content'],
            ),
        );
    }
}
