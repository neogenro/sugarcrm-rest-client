<?php
namespace Tests\SugarClient\Core;

use PHPUnit_Framework_TestCase;
use SugarClient\Core\WhereClause;
use SugarClient\Module\Account;

class WhereClauseTest extends PHPUnit_Framework_TestCase
{
    private $moduleDbName;

    protected function setUp()
    {
        parent::setUp();
        $account = new Account();
        $this->moduleDbName = $account->getModuleDbName();
    }

    /**
     * @test
     */
    public function shouldBuildWhereFromSimpleArray()
    {
        //given
        $params = array('name' => 'some name');

        //when
        $whereBuilder = new WhereClause($this->moduleDbName, $params);

        //then
        $this->assertEquals("accounts.name = 'some name'", $whereBuilder->getWhere());
    }

    /**
     * @test
     */
    public function shouldBuildWhereForMultipleSimpleValues()
    {
        //given
        $params = array('name' => 'some name', 'phone_office' => '123456');

        //when
        $whereBuilder = new WhereClause($this->moduleDbName, $params);

        //then
        $this->assertEquals("accounts.name = 'some name' AND accounts.phone_office = '123456'", $whereBuilder->getWhere());
    }

    /**
     * @test
     */
    public function shouldBuildWhereForLikeKeyword()
    {
        //given
        $params = array('name' => "LIKE 'name%'");

        //when
        $whereBuilder = new WhereClause($this->moduleDbName, $params);

        //then
        $this->assertEquals("accounts.name LIKE 'name%'", $whereBuilder->getWhere());
    }

    /**
     * @test
     */
    public function shouldBuildWhereForInKeyword()
    {
        //given
        $params = array('id' => "in ('3432fdsf', '3423-dfs', '786sdv')");

        //when
        $whereBuilder = new WhereClause($this->moduleDbName, $params);

        //then
        $this->assertEquals("accounts.id in ('3432fdsf', '3423-dfs', '786sdv')", $whereBuilder->getWhere());
    }

    /**
     * @test
     */
    public function shouldPrepareWhereFromString()
    {
        //given
        $params = "accounts.name = 'some name' OR phone_office = '333222111'";

        //when
        $whereBuilder = new WhereClause($this->moduleDbName, $params);

        //then
        $this->assertEquals($params, $whereBuilder->getWhere());
    }
}
