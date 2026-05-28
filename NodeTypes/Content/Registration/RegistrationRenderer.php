<?php

declare(strict_types=1);

namespace Neos\Demo\NodeTypes\Content\Registration;

use PackageFactory\ComponentEngine\ComponentInterface;
use PackageFactory\ComponentEngine\StringComponent;
use PackageFactory\Neos\ComponentEngine\Integration\ContentNodeRendererInterface;
use PackageFactory\Neos\ComponentEngine\NeosContext;

class RegistrationRenderer implements ContentNodeRendererInterface
{
    public function renderAsContent(NeosContext $context): ComponentInterface
    {
        return StringComponent::fromString('');
    }
}
