<?php

namespace Acme\Tests\unit\Infrastructure\Repository;

use Acme\Domain\Contract\ClientRepository;
use Acme\Tests\TestCase;
use Doctrine\Common\Collections\ArrayCollection;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use LaravelDoctrine\Migrations\Testing\DatabaseMigrations;

/**
 * Class ClientRepositoryTest
 *
 * @package Acme\Tests\unit\Infrastructure\Repository
 * @author Ulf Tiburtius <ulf@idea-works.de>
 * @since 2017/10/09
 */
class ClientRepositoryTest extends TestCase
{
    use DatabaseMigrations,
        DatabaseTransactions;

    /**
     * @var ClientRepository
     */
    private $sut;

    public function setUp()
    {
        parent::setUp();

        $this->sut = $this->app->make(ClientRepository::class);
    }

    public function tearDown()
    {
        parent::tearDown();

        $this->sut = null;
    }

    public function testFindByName()
    {
        $actual = $this->sut->findByName('baz');
        $this->assertInstanceOf(ArrayCollection::class, $actual);
        $this->assertEquals(0, $actual->count());
    }
}
