<?php

declare(strict_types=1);

namespace App\Tests;

use App\Service\MyService;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndexWithoutMock()
    {
        $client = static::createClient();

        $client->request('GET', '/');

        static::assertResponseIsSuccessful();
        static::assertSelectorTextSame('h1', 'foo');
    }

    public function testIndexWithMock()
    {
        $client = static::createClient();

        $myService = $this->createMock(MyService::class);
        $myService->expects(static::once())
            ->method('test')
            ->willReturn('bar')
        ;
        static::$container->set(MyService::class, $myService);

        $client->request('GET', '/');

        static::assertResponseIsSuccessful();
        static::assertSelectorTextSame('h1', 'bar');
    }
}
