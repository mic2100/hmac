<?php

namespace HmacTests\Adapters;

use Mardy\Hmac\Adapters\Bcrypt;

class BcryptTest extends AbstractHashTest
{
    public function testHash()
    {
        $method = $this->getPublicHashMethod('Mardy\Hmac\Adapters\Bcrypt', 'hash');
        $class = new Bcrypt;
        $hash = $method->invokeArgs($class, array('data', 'saltsaltsaltsaltsaltsalt', 10));

        $this->assertSame(
            '$2y$10$saltsaltsaltsaltsaltsOXGL7/EzwyfvCo3lZ7aheA9M9iYVXx9y',
            $hash
        );
    }

    public function testSetAlgorithmSuccessful()
    {
        $class = new Bcrypt;
        $this->assertInstanceOf('Mardy\Hmac\Adapters\Bcrypt', $class->setConfig(['algorithm' => PASSWORD_DEFAULT]));
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSetAlgorithmExceptionExpected()
    {
        $class = new Bcrypt;
        $this->assertInstanceOf('Mardy\Hmac\Adapters\Bcrypt', $class->setConfig(['algorithm' => 999]));
    }
}
