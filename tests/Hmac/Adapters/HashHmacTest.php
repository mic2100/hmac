<?php

namespace HmacTests\Adapters;

use Mardy\Hmac\Adapters\HashHmac;

class HashHmacTest extends AbstractHashTest
{
    public function testHash()
    {
        $method = $this->getPublicHashMethod('Mardy\Hmac\Adapters\HashHmac', 'hash');
        $class = new HashHmac;
        $hash = $method->invokeArgs($class, array('data', 'salt', 10));

        $this->assertSame(
            '43df19dbd6af799125bd60a4dd1de19680400227badf8713112f04cfa10834cbee84a188a5929f3dd722e60faa9eb1d486c8d872548f9ce68dfb714a29431d1d',
            $hash
        );
    }
}
