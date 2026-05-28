<?php

declare(strict_types=1);

namespace Neos\Demo\Integration;

use Neos\Demo\Components\JavaScript\JavaScript;
use Neos\Demo\Components\Layout\Document;
use Neos\Demo\Components\Layout\DocumentMode;
use Neos\Demo\Components\Stylesheet\Stylesheet;
use Neos\Flow\Annotations as Flow;
use Neos\Flow\Configuration\ConfigurationManager;
use PackageFactory\ComponentEngine\ComponentCollection;
use PackageFactory\ComponentEngine\ComponentInterface;
use PackageFactory\ComponentEngine\StringComponent;
use PackageFactory\Neos\ComponentEngine\Integration\NeosStuffFactory;
use PackageFactory\Neos\ComponentEngine\NeosContext;

class DocumentFactory
{
    public function __construct(
        private readonly NeosStuffFactory $neosStuffFactory,
        private readonly ConfigurationManager $configurationManager,
    ) {
    }

    public function create(NeosContext $context, ComponentInterface $content): ComponentInterface
    {
        return ComponentCollection::list(
            StringComponent::fromHtmlString('<!DOCTYPE html>'),
            Document::create(
                title: $context->nodes->getStringValue($context->documentNode, 'title') ?: 'Neos Demo',
                stylesheets: ComponentCollection::list(
                    Stylesheet::create((string)$context->neos->getStaticResourceUri('Neos.Demo', 'Styles/Main.css'))
                ),
                headScripts: ComponentCollection::list(
                    JavaScript::create((string)$context->neos->getStaticResourceUri('Neos.Demo', 'Scripts/Main.js'))
                ),
                neosHeaderStuff: $this->neosStuffFactory->tryGetHeadStuff($context),
                content: $content,
                neosBodyStuff: $this->neosStuffFactory->tryGetBodyStuff($context->renderingMode->isEdit),
                mode: $context->renderingMode->isEdit ? DocumentMode::MODE_BACKEND : DocumentMode::MODE_FRONTEND,
                debug: $this->configurationManager->getConfiguration(
                    configurationType: ConfigurationManager::CONFIGURATION_TYPE_SETTINGS,
                    configurationPath: 'Neos.Demo.debugMode',
                ) ? 'true' : null,
        ));
    }
}
