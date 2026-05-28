<?php

declare(strict_types=1);

namespace Neos\Demo\Integration;

use Neos\ContentRepository\Core\Projection\ContentGraph\Filter\FindSubtreeFilter;
use Neos\ContentRepository\Core\Projection\ContentGraph\Subtree;
use Neos\ContentRepository\Core\Projection\ContentGraph\Subtrees;
use Neos\Demo\Components\Header\Header;
use Neos\Demo\Components\Header\Item;
use Neos\Flow\Annotations as Flow;
use Neos\Flow\Mvc\Exception\NoMatchingRouteException;
use Neos\Flow\ResourceManagement\EelHelper\StaticResourceHelper;
use PackageFactory\ComponentEngine\ComponentCollection;
use PackageFactory\ComponentEngine\StringComponent;
use PackageFactory\Neos\ComponentEngine\NeosContext;

class HeaderFactory
{
    public function create(NeosContext $context): Header
    {
        return Header::create(
            logo: StringComponent::fromHtmlString(new StaticResourceHelper()->content('Neos.Demo', 'Public/Images/logo.svg', true)),
            homeUri: (string)$context->neos->getNodeUri($context->siteNode, true),
            menuItems: $this->getHeaderItems($context, $context->subgraph->findSubtree(
                $context->siteNode->aggregateId,
                FindSubtreeFilter::create(nodeTypes: 'Neos.Neos:Document', maximumLevels: 1)
            ) ?: Subtree::create(0, $context->siteNode, Subtrees::createEmpty())),
        );
    }

    private function getHeaderItems(NeosContext $context, Subtree $subtree): ComponentCollection
    {
        return ComponentCollection::list(...array_filter(array_map(
            function (Subtree $subtree) use ($context): ?Item {
                try {
                    if ($context->nodes->getBoolValue($subtree->node, 'hiddenInMenu') === true) {
                        return null;
                    }
                    return Item::create(
                        uri: (string)$context->neos->getNodeUri($subtree->node),
                        label: $context->nodes->getLabel($subtree->node),
                    );
                } catch (NoMatchingRouteException $e) {
                    return null;
                }
            },
            iterator_to_array($subtree->children),
        )));
    }
}
