<?php 

class InstanceTest extends \Codeception\Test\Unit
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
    public function testCreateInstance()
    {
        $params = [
            'foo' => 'bar',
            'bar' => 'baz'
        ];
        $config = new Viloveul\Config\Configuration($params);
        $this->tester->assertEquals($params, $config->all());
    }

    public function testMerge()
    {
        $config = new Viloveul\Config\Configuration([
            'foo' => 'bar'
        ]);
        $another = new Viloveul\Config\Configuration([
            'bar' => 'baz'
        ]);
        $config->merge($another);
        $this->tester->assertTrue($config->has('bar'));
    }

    public function testMagicGetterAndArrayAccess()
    {
        $config = new Viloveul\Config\Configuration([
            'foo' => 'bar'
        ]);
        $this->tester->assertEquals($config->foo, $config['foo']);
    }

    public function testCantUnsetConfig()
    {
        $this->tester->expectThrowable(Viloveul\Config\IllegalException::class, function() {
            $config = new Viloveul\Config\Configuration([
                'foo' => 'bar'
            ]);
            unset($config['foo']);
        });
    }
}