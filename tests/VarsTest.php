<?php
/**
 * Vars test
 * User: moyo
 * Date: 2018/8/22
 * Time: 4:39 PM
 */

namespace Carno\Env\Tests;

use Carno\Env\Vars;
use PHPUnit\Framework\TestCase;
use Throwable;

class VarsTest extends TestCase
{
    public function testLoad()
    {
        $em = null;
        try {
            Vars::load(__DIR__.'/env0.txt');
        } catch (Throwable $e) {
            $em = $e->getMessage();
        }
        $this->assertNotNull($em);

        Vars::load(__DIR__.'/env1.txt', __DIR__.'/env2.txt');

        $this->assertEquals('hello', env('EVK1'));
        $this->assertEquals('world', env('EVK2'));
    }

    public function testOps()
    {
        $this->assertNull(env('NONE'));
        $this->assertEquals('default', env('NONE', 'default'));

        Vars::populate(<<<ENV
EVK1=v1
EVK2=v2
HELLO=world
ENV
        );
        $this->assertEquals('v1', env('EVK1'));
        $this->assertEquals('v2', env('EVK2'));
        $this->assertEquals('world', env('HELLO'));

        Vars::export('HELLO', 'moyo');
        $this->assertEquals('moyo', env('HELLO'));

        Vars::unset('HELLO');
        $this->assertNull(env('HELLO'));

        Vars::unset('TEST=test');
        $this->assertNull(env('TEST'));
    }
}
