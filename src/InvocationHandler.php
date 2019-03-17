<?php
declare(strict_types=1);

namespace Mo\AOP;


class InvocationHandler implements InvocationHandlerInterface
{
    protected $object;

    protected $method;

    protected $args;

    public function invoke(object $object, string $method, array $args)
    {
        $this->object = $object;
        $this->method = $method;
        $this->args   = $args;

        if (method_exists($this, 'before')) {
            $this->before();
        }

        $data = call_user_func_array([$object, $method], $args);

        if (method_exists($this, 'after')) {
            $this->after();
        }

        return $data;
    }
}
