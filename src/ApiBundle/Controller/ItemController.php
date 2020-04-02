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
        $command = $itemRequest->getCommand();
        if ($itemRequest->isForComics()) {
            $handler = $this->get('content.application.get_items_from_comics');
        } elseif ($itemRequest->isForSpace()) {
            $handler = $this->get('content.application.get_items_from_space_launches');
        }

        $result = $handler->handle($command);

        return View::create($result->toArray(), 200);
    }
}
