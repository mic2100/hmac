<?php

namespace HmacTests\Adapters;

use Mardy\Hmac\Adapters\HashPbkdf2;

class HashPbkdf2Test extends AbstractHashTest
{
    public function testHash()
    {
        $method = $this->getPublicHashMethod('Mardy\Hmac\Adapters\HashPbkdf2', 'hash');
        $class = new HashPbkdf2;
        $hash = $method->invokeArgs($class, array('data', 'salt', 10));

        $this->assertSame(
            'f87a3d2d424be36c07a3cf95dc9881a26d634adc778a0a93eec7b202a551c5095f1425a551a42000853f5a6072b7a2d34618fb8d9b14924438afb61fae6317f0',
            $hash
        );
    }
}
