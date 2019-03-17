<?php
declare(strict_types=1);

namespace Mo\AOP;


use Mo\AOP\Exception\InvocationHandlerNotFoundException;

class Proxy
{
    protected $object;

    protected static $registers = [];

    protected function __construct(object $object)
    {
        $this->object = $object;
    }

    public static function newInstance(object $object)
    {
        return new self($object);
    }

    public function __call($method, $args)
    {
        $class = get_class($this->object);

        /** @var InvocationHandlerInterface $invocationHandler */
        $invocationHandler = self::$registers[$class] ?? null;

        if (is_null($invocationHandler)) {
            throw new InvocationHandlerNotFoundException("invocation handler for class {$class} not found.");
        }

        return $invocationHandler->invoke($this->object, $method, $args);
    }

    public static function register(string $class, InvocationHandlerInterface $invocationHandler)
    {
        self::$registers[$class] = $invocationHandler;
    }
}
