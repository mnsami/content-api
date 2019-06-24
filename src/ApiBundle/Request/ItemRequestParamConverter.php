<?php
declare(strict_types=1);

namespace ApiBundle\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;

class ItemRequestParamConverter implements ParamConverterInterface
{
    private const CONFIG_NAME = "itemRequest";
    /**
     * Stores the object in the request.
     *
     * @param ParamConverter $configuration Contains the name, class and options of the object
     *
     * @return bool True if the object has been successfully set, else false
     */
    public function apply(Request $request, ParamConverter $configuration)
    {
        $item = ItemRequest::createFromArray($request->query->all());
        $request->attributes->set($configuration->getName(), $item);
        return true;
    }

    /**
     * Checks if the object is supported.
     *
     * @return bool True if the object is supported, else false
     */
    public function supports(ParamConverter $configuration)
    {
        return $configuration->getName() === self::CONFIG_NAME;
    }
}
