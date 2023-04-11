<?php

namespace Lulububu\BoltSocialMedia;

use Bolt\Widget\BaseWidget;
use Bolt\Widget\Injector\RequestZone;
use Bolt\Widget\Injector\Target;
use Bolt\Widget\TwigAwareInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class SocialMediaWidget
 *
 * @author Joshua Schumacher <joshua@lulububu.de>
 */
class SocialMediaWidget extends BaseWidget implements TwigAwareInterface
{
    /**
     * @var string $name
     */
    protected $name = 'Bolt Social Media Widget';

    /**
     * @var string $target
     */
    protected $target = Target::AFTER_HEAD_CSS;

    /**
     * @var string $zone
     */
    protected $zone = RequestZone::BACKEND;

    /**
     * @var string $templateFolder
     */
    protected $templateFolder = 'vendor/lulububu/bolt-social-media/templates/';

    /**
     * @var string $template
     */
    protected $template = '@socialmedia/assets.html.twig';

    /**
     * @var int $priority
     */
    protected $priority = 200;

    /**
     * @var string[]
     */
    private $routes = [
        'bolt_content_edit',
        'bolt_content_new',
        'bolt_content_duplicate',
    ];

    /**
     * @param array $params
     *
     * @return string|null
     */
    public function run(array $params = []): ?string
    {
        $extension = $this->getExtension();
        $request   = $extension->getRequest();

        if (
            !in_array($request->get('_route'), $this->routes, true) ||
            $extension->getRequest()->getMethod() !== Request::METHOD_GET
        ) {
            return null;
        }

        return parent::run();
    }
}
