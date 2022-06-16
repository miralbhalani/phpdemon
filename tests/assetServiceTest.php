<?php 

require_once dirname(dirname(__FILE__)) . '/web/assetService.php';

class assetServiceTest extends \PHPUnit\Framework\TestCase
{
 
 
    public function GetAllTest()
    {
        $assetService = new \Web\AssetService;
        $data = $assetService->GetAll([]);

        $this->assertEquals(count($data), 3);
    }

    public function GetAllSearchTest()
    {
        $assetService = new \Web\AssetService;
        $data = $assetService->GetAll([
            "name" => [
                "eq" => "asset 1"
            ]
        ]);

        $this->assertEquals(count($data), 1);
    }

    public function getdataOneTest()
    {      
        $assetService = new AssetService();
        $data = $assetService->GetOne(1);
        
        $this->assertEquals($data['id'], 1);
    }

    public function insertTest()
    {      
        $assetService = new AssetService();
        $data = $assetService->insert(["name" => "some data"]);
  
        
        $this->assertNotEmpty($data);
    }

    public function updateTest()
    {      
        $assetService = new AssetService();
        $data = $assetService->insert(["id"=> 1, "name" => "some data"]);
  
        
        $this->assertNotEmpty($data);
    }

    public function deleteTest()
    {      
        $assetService = new AssetService();
        $data = $assetService->delete(1);
  
        
        $this->assertNotEmpty($data);
    }
}