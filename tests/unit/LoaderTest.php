<?php 

class LoaderTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testCanLoadFile()
    {
        $config = Viloveul\Config\ConfigFactory::load(__DIR__.'/../../configs.php');
        $this->tester->assertInstanceOf(Viloveul\Config\Contracts\Configuration::class, $config);
    }

    public function testCanReadValue()
    {
        $config = Viloveul\Config\ConfigFactory::load(__DIR__.'/../../configs.php');
        $this->tester->assertTrue($config->has('foo'));
    }

    public function testCantLoadNonExistingFile()
    {
        $this->tester->expectThrowable(Viloveul\Config\LoaderException::class, function() {
            $config = Viloveul\Config\ConfigFactory::load(__DIR__.'/../../non-existing-file.php');
            $this->tester->assertInstanceOf(Viloveul\Config\Contracts\Configuration::class, $config);
        });
    }
}