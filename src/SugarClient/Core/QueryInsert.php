<?php
namespace SugarClient\Core;

use SugarClient\Http\Request;
use SugarClient\Http\Requests;

/**
 * Class QueryInsert
 * @package SugarClient\Core
 * @author Piotr Olaszewski <piotroo89 [%] gmail dot com>
 */
class QueryInsert
{
    private $attributes;

    public function __construct($attributes = array())
    {
        $this->attributes = AttributesPreparer::prepare($attributes);
    }

    public function getAttributes()
    {
        return $this->attributes;
    }

    public function into($moduleName)
    {
        $call = Request::call(Requests::setEntry($moduleName, $this->attributes));
        return $call->id;
    }
}
