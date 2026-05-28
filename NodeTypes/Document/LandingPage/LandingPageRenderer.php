<?php

declare(strict_types=1);

namespace Neos\Demo\NodeTypes\Document\LandingPage;

use Neos\Demo\Integration\DocumentFactory;
use Neos\Demo\Integration\LandingPageFactory;
use PackageFactory\ComponentEngine\ComponentInterface;
use PackageFactory\Neos\ComponentEngine\Integration\DocumentNodeRendererInterface;
use PackageFactory\Neos\ComponentEngine\NeosContext;

class LandingPageRenderer implements DocumentNodeRendererInterface
{
    public function __construct(
        private readonly DocumentFactory $documentFactory,
        private readonly LandingPageFactory $landingPageFactory,
    ) {
    }

    public function renderAsDocument(NeosContext $context): ComponentInterface
    {
        return $this->documentFactory->create(
            context: $context,
            content: $this->landingPageFactory->create($context, null),
        );
    }
}
