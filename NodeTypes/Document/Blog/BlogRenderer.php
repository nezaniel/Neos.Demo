<?php

declare(strict_types=1);

namespace Neos\Demo\NodeTypes\Document\Blog;

use Neos\ContentRepository\Core\Projection\ContentGraph\Filter\FindChildNodesFilter;
use Neos\ContentRepository\Core\Projection\ContentGraph\Filter\Ordering\Ordering;
use Neos\ContentRepository\Core\Projection\ContentGraph\Filter\Ordering\OrderingDirection;
use Neos\ContentRepository\Core\Projection\ContentGraph\Filter\Pagination\Pagination;
use Neos\ContentRepository\Core\Projection\ContentGraph\Node;
use Neos\ContentRepository\Core\SharedModel\Node\NodeName;
use Neos\ContentRepository\Core\SharedModel\Node\PropertyName;
use Neos\Demo\Components\Cards\Card;
use Neos\Demo\Components\Cards\Container;
use Neos\Demo\Integration\DocumentFactory;
use Neos\Demo\Integration\LandingPageFactory;
use Neos\Flow\I18n\EelHelper\TranslationHelper;
use PackageFactory\ComponentEngine\ComponentCollection;
use PackageFactory\ComponentEngine\ComponentInterface;
use PackageFactory\ComponentEngine\StringComponent;
use PackageFactory\Neos\ComponentEngine\Integration\ContentRenderer;
use PackageFactory\Neos\ComponentEngine\Integration\DocumentNodeRendererInterface;
use PackageFactory\Neos\ComponentEngine\NeosContext;

class BlogRenderer implements DocumentNodeRendererInterface
{
    public function __construct(
        private readonly DocumentFactory $documentFactory,
        private readonly LandingPageFactory $landingPageFactory,
        private readonly ContentRenderer $contentRenderer,
    ) {
    }

    public function renderAsDocument(NeosContext $context): ComponentInterface
    {
        $blogPostings = $context->subgraph->findChildNodes(
            parentNodeAggregateId: $context->documentNode->aggregateId,
            filter: FindChildNodesFilter::create(
                nodeTypes: 'Neos.Demo:Document.BlogPosting',
                ordering: Ordering::byProperty(PropertyName::fromString('datePublished'), OrderingDirection::DESCENDING),
                pagination: Pagination::fromLimitAndOffset(10, 0),
            )
        );

        return $this->documentFactory->create(
            context: $context,
            content: $this->landingPageFactory->create(
                context: $context,
                content: ComponentCollection::list(
                    Container::create(
                        class: null,
                        content: ComponentCollection::list(...array_map(
                            fn (Node $blogPosting): Card => Card::create(
                                uri: (string)$context->neos->getNodeUri($blogPosting, true),
                                title: $context->nodes->getStringValue($blogPosting, 'title') ?: 'Untitled',
                                content: ($abstract = $context->nodes->getStringValue($blogPosting, 'abstract'))
                                    ? StringComponent::fromHtmlString($abstract)
                                    : null,
                                date: $context->nodes->getObjectValue(
                                    node: $blogPosting,
                                    propertyName: 'datePublished',
                                    expectedType: \DateTimeImmutable::class,
                                )?->format('Y-m-d') ?: '-',
                                authorName: ($authorName = $context->nodes->getStringValue($blogPosting, 'authorName'))
                                    ? new TranslationHelper()->translate(
                                        id: 'cards.authorPublishedBy',
                                        originalLabel: 'Published by {authorName}',
                                        arguments: [
                                            'authorName' => $authorName,
                                        ],
                                        source: 'Presentation.Cards:cards',
                                        package: 'Neos.Demo',
                                    )
                                    : null,
                                imageUri: null,
                                class: null,
                                moreLabel: null,
                            ),
                            iterator_to_array($blogPostings),
                        )),
                    ),
                    $this->contentRenderer->forContentCollectionChildNode(
                        node: $context->documentNode,
                        collectionName: NodeName::fromString('main'),
                        context: $context,
                    ),
                )
            ),
        );
    }
}
