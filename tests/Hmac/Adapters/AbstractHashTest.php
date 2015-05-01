<?php

namespace HmacTests\Adapters;

abstract class AbstractHashTest extends \PHPUnit_Framework_TestCase
{
    protected function getPublicHashMethod($class, $name)
    {
        $class = new \ReflectionClass($class);
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method;
    }
}