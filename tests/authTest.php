<?php 

require_once dirname(dirname(__FILE__)) . '/web/auth.php';

class authTest extends \PHPUnit\Framework\TestCase
{
    public function getJWTTest()
    {
        $this->assertNotEmpty(getJWT());
    }

    public function validateTokenTest()
    {
        $this->assertTrue(validateToken(getJWT()));
    }
}