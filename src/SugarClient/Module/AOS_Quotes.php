<?php
namespace SugarClient\Module;

use SugarClient\Core\Module;
use SugarClient\Relation\Type\BelongsTo;
use SugarClient\Relation\Type\HasMany;

class AOS_Quotes extends Module
{
  public function __construct($attributes = array())
  {
    parent::__construct(array(
        'attributes' => $attributes,
        'belongsTo' => array(
            'account' => BelongsTo::module('Account')
        ),
        'hasMany' => array(
            'invoices' => HasMany::module('AOS_Invoices'),
        )
    ));
  }
}