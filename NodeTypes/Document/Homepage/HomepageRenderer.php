<?php

declare(strict_types=1);

namespace Neos\Demo\NodeTypes\Document\Homepage;

use PackageFactory\ComponentEngine\ComponentInterface;
use PackageFactory\Neos\ComponentEngine\Integration\DocumentNodeRendererInterface;
use PackageFactory\Neos\ComponentEngine\NeosContext;

class HomepageRenderer implements DocumentNodeRendererInterface
{

    public function renderAsDocument(NeosContext $context): ComponentInterface
    {
        // TODO: Implement renderAsDocument() method.
    }
}
