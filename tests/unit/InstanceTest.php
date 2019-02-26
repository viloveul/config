<?php 

class InstanceTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected $myConfig;

    protected $myParams = [
        'foo' => 'bar',
        'bar' => 'baz'
    ];
    
    protected function _before()
    {
        $this->myConfig = new Viloveul\Config\Configuration($this->myParams);
    }

    protected function _after()
    {
    }

    // tests
    public function testCreateInstance()
    {
        $this->tester->assertEquals(
            $this->myParams,
            $this->myConfig->all()
        );
    }

    public function testMerge()
    {
        $another = new Viloveul\Config\Configuration([
            'baz' => 'hello'
        ]);
        $this->myConfig->merge($another);
        $this->tester->assertTrue($this->myConfig->has('baz'));
    }

    public function testSetter()
    {
        $this->myConfig->setHello('world');
        $this->tester->assertTrue($this->myConfig->has('hello'));
    }

    public function testMagicGetterAndArrayAccess()
    {
        $this->tester->assertEquals($this->myParams['foo'], $this->myConfig->getFoo());
        $this->tester->assertEquals($this->myParams['foo'], $this->myConfig['foo']);
        $this->tester->assertEquals($this->myParams['foo'], $this->myConfig->foo);
    }

    public function testCantUnsetConfig()
    {
        $this->tester->expectThrowable(Viloveul\Config\IllegalException::class, function() {
            unset($this->myConfig['foo']);
        });
    }
}