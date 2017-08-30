<?php

namespace Acme\Infrastructure\Aspects\Logging;

use Go\Aop\Aspect;
use Go\Aop\Intercept\MethodInvocation;
use Go\Lang\Annotation\Before;
use Psr\Log\LoggerInterface as Logger;

/**
 * Class LoggingAspect
 *
 * @package Acme\Infrastructure\Logging
 * @author Ulf Tiburtius <ulf@idea-works.de>
 * @since 05/24/2017
 */
class LoggingAspect implements Aspect
{
    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;

    /**
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param \Go\Aop\Intercept\MethodInvocation $invocation
     *
     * @Before("@execution(Acme\Infrastructure\Aspects\Annotations\Loggable)")
     *
     * @return void
     */
    public function beforeMethodExecution(MethodInvocation $invocation) : void
    {
        $this->logger->info(\sprintf(
            'Executing %s::%s',
            get_class($invocation->getThis()),
            $invocation->getMethod()->getName()
        ), $invocation->getArguments());
    }
}
