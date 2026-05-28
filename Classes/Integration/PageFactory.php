<?php

declare(strict_types=1);

namespace Neos\Demo\Integration;

use Neos\ContentRepository\Core\Projection\ContentGraph\Filter\FindAncestorNodesFilter;
use Neos\ContentRepository\Core\Projection\ContentGraph\Node;
use Neos\ContentRepository\Core\SharedModel\Node\NodeName;
use Neos\Demo\Components\Breadcrumb\Breadcrumb;
use Neos\Demo\Components\Breadcrumb\Item;
use Neos\Demo\Components\Layout\Page;
use Neos\Flow\Annotations as Flow;
use PackageFactory\ComponentEngine\ComponentCollection;
use PackageFactory\ComponentEngine\ComponentInterface;
use PackageFactory\Neos\ComponentEngine\Integration\ContentRenderer;
use PackageFactory\Neos\ComponentEngine\NeosContext;

class PageFactory
{
    public function __construct(
        private readonly HeaderFactory $headerFactory,
        private readonly ContentRenderer $contentRenderer,
        private readonly FooterFactory $footerFactory,
    ) {
    }

    public function create(NeosContext $context, ?ComponentInterface $overrideContent): Page
    {
        $ancestors = iterator_to_array($context->subgraph->findAncestorNodes(
            $context->siteNode->aggregateId,
            FindAncestorNodesFilter::create(nodeTypes: 'Neos.Neos:Document')
        )->reverse());

        return Page::create(
            header: $this->headerFactory->create($context),
            breadcrumb: Breadcrumb::create(
                content: ComponentCollection::list(...array_map(
                    fn (Node $node, int $i): Item => Item::create(
                        isFirst: $i === 0,
                        uri: (string)$context->neos->getNodeUri($node),
                        label: $context->nodes->getLabel($node)
                    ),
                    $ancestors,
                    array_keys($ancestors),
                )),
                class: null,
            ),
            content: $overrideContent ?: $this->contentRenderer->forContentCollectionChildNode(
                node: $context->documentNode,
                collectionName: NodeName::fromString('main'),
                context: $context,
            ),
            footer: $this->footerFactory->create($context),
        );
    }
}
