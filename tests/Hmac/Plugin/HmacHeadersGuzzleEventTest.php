<?php

namespace HmacTests\Plugin;

use GuzzleHttp\Event\BeforeEvent;
use GuzzleHttp\Event\SubscriberInterface;
use Mardy\Hmac\Adapters\Hash;
use Mardy\Hmac\Manager;
use Mardy\Hmac\Plugin\HmacHeadersGuzzleEvent;

class HmacHeadersGuzzleEventTest extends \PHPUnit_Framework_TestCase
{
    private $plugin;

    public function setup()
    {
        if (!class_exists('\GuzzleHttp\Event\BeforeEvent') && !class_exists('\GuzzleHttp\Event\SubscriberInterface')) {
            $this->markTestSkipped(
                'GuzzleHttp libraries are missing. Install them by adding "guzzlehttp/guzzle" to your composer file.'
            );
        }

        $this->plugin = new HmacHeadersGuzzleEvent(
            $this->getAdapterInterfaceMock(),
            'key',
            'data',
            microtime(true)
        );
    }

    public function testGetEvents()
    {
        $this->assertSame(['before' => ['onBefore', 100]], $this->plugin->getEvents());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testInitWithIncorrectHeadersExceptionExpected()
    {
        $class = new HmacHeadersGuzzleEvent(
            $this->getAdapterInterfaceMock(),
            'key',
            'data',
            microtime(true),
            ['error']
        );
    }

    public function testOnBefore()
    {
        $this->assertNull($this->plugin->onBefore($this->getBeforeEventMock()));
    }

    private function getAdapterInterfaceMock()
    {
        return $this->getMockBuilder('Mardy\Hmac\Adapters\AdapterInterface')
                    ->disableOriginalConstructor()
                    ->getMock();
    }

    private function getRequestInterfaceMock()
    {
        //GuzzleHttp\Message\RequestInterface
        return $this->getMockBuilder('GuzzleHttp\Message\RequestInterface')
                    ->disableOriginalConstructor()
                    ->getMock();
    }

    private function getBeforeEventMock()
    {
        $event = $this->getMockBuilder('GuzzleHttp\Event\BeforeEvent')
                      ->disableOriginalConstructor()
                      ->getMock();

        $event->expects($this->any())
              ->method('getRequest')
              ->will($this->returnValue($this->getRequestInterfaceMock()));

        return $event;
    }

    private function getManager()
    {
        return new Manager(new Hash);
    }
}
