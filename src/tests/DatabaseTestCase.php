<?php

namespace Acme\Tests;

use Illuminate\Support\Facades\Artisan;

/**
 * Class DatabaseTestCase
 *
 * @package Tests
 * @author Ulf Tiburtius <ulf@idea-works.de>
 * @since 09.10.17
 */
trait DatabaseTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->prepareForTests();
    }

    public function prepareForTests()
    {
        Artisan::call('doctrine:migrations:migrate');
    }
}
