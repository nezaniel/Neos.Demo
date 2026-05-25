<?php

declare(strict_types=1);

namespace Neos\Demo\Components\Layout;

use PackageFactory\ComponentEngine as _;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class LandingPage implements _\ComponentInterface
{
    private function __construct(
        private _\ComponentInterface $header,
        private _\ComponentInterface $heroContent,
        private ?string $heroImage,
        private _\ComponentInterface $content,
        private _\ComponentInterface $footer,
    ) {
    }

    public static function create(
        _\ComponentInterface|string $header,
        _\ComponentInterface|string $heroContent,
        ?string $heroImage,
        _\ComponentInterface|string $content,
        _\ComponentInterface|string $footer,
    ): self {
        return new self(
            header: is_string($header) ? _\StringComponent::fromString($header) : $header,
            heroContent: is_string($heroContent) ? _\StringComponent::fromString($heroContent) : $heroContent,
            heroImage: $heroImage,
            content: is_string($content) ? _\StringComponent::fromString($content) : $content,
            footer: is_string($footer) ? _\StringComponent::fromString($footer) : $footer,
        );
    }

    public function render(): string
    {
        return '' . $this->header->render() . '' . ((true || ($this->heroImage !== null)) ? '<div class="' . _\Util::joinAttributeValues(['overflow-hidden bg-dark flex flex-col print:bg-transparent print:m-0 print:py-20', (($this->heroImage !== null) ? 'bg-cover bg-center -mt-[var(--header-height)] h-screen print:h-auto print:!bg-none' : 'pt-20 pb-32')]) . '"' . (($this->heroImage !== null) ? ' style="' . 'background-image: url(' . (($temp = $this->heroImage) === null ? '' : _\Util::escapeAttributeValue($temp)) . ');text-shadow:1px 0 0 rgb(0 0 0 / 50%);' . '"' : '') . '><div class="content flex flex-col items-center justify-center prose prose-2xl prose-white print:prose flex-1">' . $this->heroContent->render() . '</div></div>' : '') . '<main class="content prose">' . $this->content->render() . '</main>' . $this->footer->render() . '';
    }
}
