<?php

namespace Acme\Infrastructure\Aspects\Annotations;

use Doctrine\Common\Annotations\Annotation;

/**
 * Class Loggable
 *
 * @package Acme\Infrastructure\Aspects\Annotations
 * @author Ulf Tiburtius <ulf@idea-works.de>
 * @since 2017/08/25
 *
 * @Annotation
 * @Target("METHOD")
 */
class Loggable extends Annotation
{
}
