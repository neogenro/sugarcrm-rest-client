<?php
namespace SugarClient\Core;

/**
 * Class WhereClause
 * @package SugarClient\Core
 * @author Piotr Olaszewski <piotroo89 [%] gmail dot com>
 */
class WhereClause
{
    private static $reservedKeywordsRegExp = '/(^| )(LIKE|IN)/i';

    private $moduleDbName;
    private $params;
    private $where;

    public function __construct($moduleDbName, $params)
    {
        $this->moduleDbName = $moduleDbName;
        $this->params = $params;
        $this->where = $this->prepareWhere($params);
    }

    private function prepareWhere($params)
    {
        $whereString = '';
        if (is_array($params)) {
            foreach ($params as $column => $value) {
                $whereString .= $this->buildWhereForSingleValue($column, $value);
            }
            $whereString = rtrim($whereString, ' AND ');
        } elseif (is_string($params)) {
            $whereString = $params;
        }
        return $whereString;
    }

    private function buildWhereForSingleValue($column, $value)
    {
        if(false === strpos($column, '.')){
            $where = $this->getModuleDbName() . '.' . $column;
        }
        else{
            $where = $column;
        }
        if ($this->isValueHasReservedKeywords($value)) {
            $where .= ' ' . $value . ' AND ';
        } else {
            $where .= " = '" . $value . "' AND ";
        }
        return $where;
    }

    private function isValueHasReservedKeywords($string)
    {
        return preg_match(self::$reservedKeywordsRegExp, $string);
    }

    public function getParams()
    {
        return $this->params;
    }

    public function getWhere()
    {
        return $this->where;
    }

    private function getModuleDbName()
    {
        return $this->moduleDbName;
    }
}
