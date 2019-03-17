<?php
declare(strict_types=1);

namespace Mo\AOP;


interface InvocationHandlerInterface
{
    public function invoke(object $object, string $method, array $args);
}
