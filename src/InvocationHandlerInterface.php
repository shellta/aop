<?php
declare(strict_types=1);

namespace Mo\AOP;


interface InvocationHandlerInterface
{
    public function invoke(object $proxy, string $method, array $args);
}
