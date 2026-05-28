<?php

declare(strict_types=1);

namespace Neos\Demo\Integration;

use Neos\ContentRepository\Core\SharedModel\Node\NodeName;
use Neos\Demo\Components\Layout\LandingPage;
use Neos\Flow\Annotations as Flow;
use PackageFactory\ComponentEngine\ComponentInterface;
use PackageFactory\Neos\ComponentEngine\Integration\ContentRenderer;
use PackageFactory\Neos\ComponentEngine\NeosContext;

class LandingPageFactory
{
    public function __construct(
        private readonly HeaderFactory $headerFactory,
        private readonly ContentRenderer $contentRenderer,
        private readonly FooterFactory $footerFactory,
    ) {
    }

    public function create(NeosContext $context, ?ComponentInterface $content): LandingPage
    {
        return LandingPage::create(
            header: $this->headerFactory->create($context),
            heroContent: $this->contentRenderer->forContentCollectionChildNode(
                node: $context->documentNode,
                collectionName: NodeName::fromString('teaser'),
                context: $context,
            ),
            heroImage: null,
            content: $content ?: $this->contentRenderer->forContentCollectionChildNode(
                node: $context->documentNode,
                collectionName: NodeName::fromString('main'),
                context: $context,
            ),
            footer: $this->footerFactory->create($context),
        );
    }
}
