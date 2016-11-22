<?php

namespace ApeWare\BuilderMacros\Test;

use Illuminate\Support\Collection;

class DdSqlTest extends TestCase
{
    /** @test */
    public function it_provides_a_ddsql_macro()
    {
        $this->assertTrue(Collection::hasMacro('ddsql'));
    }
}