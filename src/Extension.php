<?php

namespace Lulububu\BoltSocialMedia;

use Bolt\Entity\Content;
use Bolt\Extension\BaseExtension;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Class BoltSocialMedia
 *
 * @author  Joshua Schumacher <joshua@lulububu.de>
 */
class Extension extends BaseExtension
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return 'Bolt 5 Social Media Extension';
    }

    /**
     * @return void
     */
    public function initialize(): void
    {
        $config            = $this->getConfig();
        $contentRepository = $this->entityManager->getRepository(Content::class);
        $settings          = $contentRepository->findOneBy(['contentType' => $config['contenttype'] ?: 'settings']);
        $socialMedia       = $settings ? $settings->getFieldValue($config['field'] ?: 'socialmedia') : '[]';

        $this->addTwigNamespace('socialmedia');
        $this->addWidget(new SocialMediaWidget());
        $this->getTwig()->addGlobal('socialmedia_fields', $config['fields']);
        $this->getTwig()->addGlobal('socialmedia', json_decode($socialMedia, true));
    }

    /**
     * @return void
     */
    public function install(): void
    {
        $container   = $this->getContainer();
        $projectDir  = $container->getParameter('kernel.project_dir');
        $public      = $container->getParameter('bolt.public_folder');
        $current     = dirname(__DIR__);
        $source      = "$current/assets/";
        $destination = "$projectDir/$public/assets/";
        $filesystem  = new Filesystem();

        $filesystem->mirror($source, $destination);
    }
}
