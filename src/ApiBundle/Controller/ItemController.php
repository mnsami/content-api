<?php
declare(strict_types=1);

namespace ApiBundle\Controller;

use ApiBundle\Request\ItemRequest;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations\Get;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class ItemController extends AbstractFOSRestController
{
    /**
     * @Get("/items")
     * @ParamConverter(name="itemRequest", converter="item", class="ApiBundle\Request\ItemRequest")
     */
    public function getItemsAction(ItemRequest $itemRequest)
    {
        return View::create($itemRequest, 200);
    }
}
