<?php 

require_once dirname(dirname(__FILE__)) . '/web/queryBuilder.php';

class queryBuilderTest extends \PHPUnit\Framework\TestCase
{
 
 
    public function searchableQueryBuilderTest()
    {
        $query = searchableQueryBuilder([
            "name" => [
                "eq" => "asset 1"
            ]
        ], "assets");

        $this->assertEquals($query, "select * from assets where name = 'asset 1'");
    }
}