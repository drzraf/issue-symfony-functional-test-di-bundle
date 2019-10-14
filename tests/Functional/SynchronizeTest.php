<?php

namespace MyBundle\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class SynchronizeTest extends KernelTestCase
{
    private $queueController;

    public function setUp()
    {
        parent::setUp();
        // self::bootKernel(['debug' => true, 'environment' => 'test']);
        $this->bootKernel();
        

        die('boot complete');
        $this->syncController = self::$container->get('MyBundle\Controller\SynchronizationController');
        $this->queueController = self::$container->get('MyBundle\Controller\QueueController');
    }

    // Test that running the command actually trigger MailChimp (geocoder)
    public function testEnqueueSync()
    {
        die('test');
    }
}
