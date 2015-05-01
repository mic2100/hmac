<?php

namespace HmacTests\Adapters;

use Mardy\Hmac\Adapters\Hash;

class HashTest extends AbstractHashTest
{
    public function testHash()
    {
        $method = $this->getPublicHashMethod('Mardy\Hmac\Adapters\Hash', 'hash');
        $class = new Hash;
        $hash = $method->invokeArgs($class, array('data', 'salt', 10));

        $this->assertSame(
            '93e4ba274b3ce525c8f9a16667e6f95f0b519ba3933f1ece151cfa88cbc7ebaf90b2ed3de7460ff2aceffd259bb9f10e7aa5b79d537676b1ca30132d94162438',
            $hash
        );
    }
}
