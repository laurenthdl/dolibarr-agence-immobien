<?php

declare(strict_types=1);

require_once __DIR__ . '/../../class/immobien.class.php';

class ImmoBienTest extends PHPUnit\Framework\TestCase
{
    protected $object;

    protected function setUp(): void
    {
        global $db;
        $this->object = new ImmoBien($db);
    }

    /**
     * @test
     */
    public function tableElementShouldBeCorrect(): void
    {
        $this->assertEquals('llx_immo_bien', $this->object->table_element);
    }

    /**
     * @test
     */
    public function elementShouldBeCorrect(): void
    {
        $this->assertEquals('immobien', $this->object->element);
    }

    /**
     * @test
     */
    public function objectShouldHaveRefProperty(): void
    {
        $this->assertObjectHasProperty('ref', $this->object);
    }

    /**
     * @test
     */
    public function objectShouldHaveStatusProperty(): void
    {
        $this->assertObjectHasProperty('status', $this->object);
    }

    /**
     * @test
     */
    public function getNextNumRefShouldReturnFormattedString(): void
    {
        $ref = $this->object->getNextNumRef();
        $this->assertStringStartsWith(strtoupper($this->object->element), $ref);
        $this->assertMatchesRegularExpression('/^' . strtoupper($this->object->element) . '-\d{4}-\d{4}$/', $ref);
    }
}
