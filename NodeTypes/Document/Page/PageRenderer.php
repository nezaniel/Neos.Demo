<?php

declare(strict_types=1);

namespace Neos\Demo\NodeTypes\Document\Page;

use Neos\Demo\Integration\DocumentFactory;
use Neos\Demo\Integration\PageFactory;
use PackageFactory\ComponentEngine\ComponentInterface;
use PackageFactory\Neos\ComponentEngine\Integration\DocumentNodeRendererInterface;
use PackageFactory\Neos\ComponentEngine\NeosContext;

class PageRenderer implements DocumentNodeRendererInterface
{
    public function __construct(
        private readonly DocumentFactory $documentFactory,
        private readonly PageFactory $pageFactory,
    ) {
    }

    public function renderAsDocument(NeosContext $context): ComponentInterface
    {
        return $this->documentFactory->create(
            context: $context,
            content: $this->pageFactory->create($context, null),
        );
    }
}
