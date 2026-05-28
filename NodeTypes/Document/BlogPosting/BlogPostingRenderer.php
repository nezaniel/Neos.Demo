<?php

declare(strict_types=1);

namespace Neos\Demo\NodeTypes\Document\BlogPosting;

use Neos\ContentRepository\Core\SharedModel\Node\NodeAddress;
use Neos\ContentRepository\Core\SharedModel\Node\NodeName;
use Neos\Demo\Components\BlogIntro\BlogIntro;
use Neos\Demo\Integration\DocumentFactory;
use Neos\Demo\Integration\PageFactory;
use PackageFactory\ComponentEngine\ComponentCollection;
use PackageFactory\ComponentEngine\ComponentInterface;
use PackageFactory\Neos\ComponentEngine\Integration\ContentRenderer;
use PackageFactory\Neos\ComponentEngine\Integration\DocumentNodeRendererInterface;
use PackageFactory\Neos\ComponentEngine\NeosContext;
use PackageFactory\Neos\ComponentEngine\Presentation\Component\ContentElement;

class BlogPostingRenderer implements DocumentNodeRendererInterface
{
    public function __construct(
        private readonly DocumentFactory $documentFactory,
        private readonly PageFactory $pageFactory,
        private readonly ContentRenderer $contentRenderer,
    ) {
    }

    public function renderAsDocument(NeosContext $context): ComponentInterface
    {
        return $this->documentFactory->create(
            context: $context,
            content: $this->pageFactory->create(
                context: $context,
                overrideContent: ComponentCollection::list(
                    ContentElement::create(
                        editable: $context->renderingMode->isEdit,
                        nodeAddress: NodeAddress::fromNode($context->documentNode),
                        fusionPath: __METHOD__,
                        content: BlogIntro::create(
                            title: $context->neos->getEditable($context->documentNode, 'title', false),
                            abstract: $context->neos->getEditable($context->documentNode, 'abstract', false),
                            imageUri: null,
                            author: $context->nodes->getStringValue($context->documentNode, 'authorName'),
                            date: $context->nodes->getObjectValue($context->documentNode, 'datePublished', \DateTimeImmutable::class)
                                ?->format('d.m.Y'),
                        )
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
