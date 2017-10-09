<?php

namespace Acme\Tests\unit\Infrastructure\Repository;

use Acme\Domain\Contract\ClientRepository;
use Acme\Tests\DatabaseTestCase;
use Acme\Tests\TestCase;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class ClientRepositoryTest
 *
 * @package Acme\Tests\unit\Infrastructure\Repository
 * @author Ulf Tiburtius <ulf@idea-works.de>
 * @since 2017/10/09
 */
class ClientRepositoryTest extends TestCase
{
    /**
     * @var ClientRepository
     */
    private $sut;

    use DatabaseTestCase {
        setUp as protected traitSetUp;
    }

    public function setUp()
    {
        $this->traitSetUp();

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
