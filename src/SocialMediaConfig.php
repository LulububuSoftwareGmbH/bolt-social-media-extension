<?php

namespace Lulububu\BoltSocialMedia;

use Bolt\Extension\ExtensionInterface;
use Bolt\Extension\ExtensionRegistry;
use Tightenco\Collect\Support\Collection;

/**
 * Class SocialMediaConfig
 *
 * @author Joshua Schumacher <joshua@lulububu.de>
 */
class SocialMediaConfig
{
    /**
     * @var ExtensionRegistry $registry
     */
    private ExtensionRegistry $registry;

    /**
     * @param ExtensionRegistry $registry
     */
    public function __construct(ExtensionRegistry $registry)
    {
        $this->registry = $registry;
    }

    /**
     * @return Collection|null
     */
    public function getConfig(): ?Collection
    {
        $extension = $this->registry->getExtension(Extension::class);

        if ($extension) {
            /* @phpstan-ignore-next-line We need to do this because the ExtensionInterface does not have a getConfig */
            return $extension->getConfig();
        }

        return null;
    }
}
