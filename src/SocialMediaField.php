<?php

namespace Lulububu\BoltSocialMedia;

use Bolt\Entity\Field;
use Bolt\Entity\Field\Excerptable;
use Bolt\Entity\Field\RawPersistable;
use Bolt\Entity\FieldInterface;

/**
 * Class SocialMediaField
 *
 * @author Joshua Schumacher <joshua@lulububu.de>
 *
 * @ORM\Entity
 */
class SocialMediaField extends Field implements Excerptable, FieldInterface, RawPersistable
{
    public const TYPE = 'socialmedia';
}
