<?php
namespace SugarClient\Module;

use SugarClient\Core\Module;
use SugarClient\Relation\Type\BelongsTo;


class AOS_Invoices extends Module
{
  public function __construct($attributes = array())
  {
    parent::__construct(array(
        'attributes' => $attributes,
        'belongsTo' => array(
            'account' => BelongsTo::module('Account'),
            'quote' => BelongsTo::module('AOS_Quotes')
        )
    ));
  }
}