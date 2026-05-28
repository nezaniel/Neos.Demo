<?php

declare(strict_types=1);

namespace Neos\Demo\Components\Header;

use PackageFactory\ComponentEngine as _;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class Header implements _\ComponentInterface
{
    private function __construct(
        private ?_\ComponentInterface $logo,
        private string $homeUri,
        private ?_\ComponentInterface $menuItems,
    ) {
    }

    public static function create(
        _\ComponentInterface|string|null $logo,
        string $homeUri,
        _\ComponentInterface|string|null $menuItems,
    ): self {
        return new self(
            logo: is_string($logo) ? _\StringComponent::fromString($logo) : $logo,
            homeUri: $homeUri,
            menuItems: is_string($menuItems) ? _\StringComponent::fromString($menuItems) : $menuItems,
        );
    }

    public function render(): string
    {
        return '<header class="relative lg:sticky print:hidden z-50 top-0 bg-white/90 text-sm supports-backdrop-blur:bg-white/80 backdrop-blur-sm transition-shadow"><div class="max-w-screen-xl mx-auto py-6 items-center grid grid-cols-[auto_minmax(0,1fr)_auto_auto] grid-rows-[auto_minmax(0,auto)] gap-4 lg:gap-x-10 lg:gap-y-0"><a href="' . _\Util::escapeAttributeValue($this->homeUri) . '" class="block border-transparent border-2 lg:row-span-full self-start">' . ((($temp = $this->logo) === null) ? '' : $temp->render()) . '</a><nav class="row-start-2 col-span-full lg:row-start-1 lg:col-span-1"><ul class="flex flex-col items-center gap-10 text-center text-slate-600 lg:!flex lg:!h-auto lg:!overflow-visible lg:flex-row">' . ((($temp = $this->menuItems) === null) ? '' : $temp->render()) . '</ul></nav></div></header>';
    }
}
