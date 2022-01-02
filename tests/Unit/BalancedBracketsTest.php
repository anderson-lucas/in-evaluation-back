<?php

namespace Tests\Unit;

use App\Console\Commands\BalancedBrackets;
use PHPUnit\Framework\TestCase;

class BalancedBracketsTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $command = new BalancedBrackets();

        $valid = '(){}[]';
        $this->assertTrue($command->isBracketsBalanced($valid));

        $valid = '[{()}](){}';
        $this->assertTrue($command->isBracketsBalanced($valid));

        $invalid = '[]{()';
        $this->assertNotTrue($command->isBracketsBalanced($invalid));

        $invalid = '[{)]';
        $this->assertNotTrue($command->isBracketsBalanced($invalid));
    }
}
