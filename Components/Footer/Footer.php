<?php

declare(strict_types=1);

namespace Neos\Demo\Components\Footer;

use PackageFactory\ComponentEngine as _;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class Footer implements _\ComponentInterface
{
    private function __construct(
        private ?_\ComponentInterface $menuItems,
        private ?_\ComponentInterface $content,
    ) {
    }

    public static function create(
        _\ComponentInterface|string|null $menuItems,
        _\ComponentInterface|string|null $content,
    ): self {
        return new self(
            menuItems: is_string($menuItems) ? _\StringComponent::fromString($menuItems) : $menuItems,
            content: is_string($content) ? _\StringComponent::fromString($content) : $content,
        );
    }

    public function render(): string
    {
        return '<div aria-hidden="true" class="flex-1 print:hidden"></div><footer class="' . _\Util::joinAttributeValues(['mt-12 text-sm print:border-t print:border-slate-200/80', (($this->menuItems !== null) ? 'border-t border-slate-200/80' : '')]) . '">' . (($this->menuItems !== null) ? '<nav class="content py-5 flex flex-wrap gap-x-10 print:hidden">' . (($temp = $this->menuItems) === null ? '' : $temp->render()) . '</nav>' : '') . '' . (($this->content !== null) ? '<div class="py-5 bg-slate-100 shadow-inner empty:hidden print:bg-transparent print:shadow-none">' . (($temp = $this->content) === null ? '' : $temp->render()) . '</div>' : '') . '</footer>';
    }
}
