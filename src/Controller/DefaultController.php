<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\MyService;
use Symfony\Component\HttpFoundation\Response;

class DefaultController
{
    private $myService;

    public function __construct(MyService $myService)
    {
        $this->myService = $myService;
    }

    public function index()
    {
        $result = $this->myService->test();

        return new Response(\sprintf('<h1>%s</h1>', $result));
    }
}
