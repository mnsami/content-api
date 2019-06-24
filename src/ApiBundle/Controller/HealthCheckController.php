<?php

namespace ApiBundle\Controller;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations\Get;

class HealthCheckController extends AbstractFOSRestController
{
    /**
     * @Get("/_healthCheck")
     */
    public function aliveAction()
    {
        return View::create(array('status' => 'i am ok'), 200);
    }
}
