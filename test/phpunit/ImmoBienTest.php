<?php

declare(strict_types=1);

require_once __DIR__ . '/../../class/immobien.class.php';

class ImmoBienTest extends PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function moduleClassShouldHaveCorrectNumber(): void
    {
        $moduleFile = __DIR__ . '/../../core/modules/modImmobien.class.php';
        $this->assertFileExists($moduleFile);
        $content = file_get_contents($moduleFile);
        $this->assertStringContainsString('numero = 700001', $content);
    }

    /**
     * @test
     */
    public function classShouldExist(): void
    {
        $this->assertTrue(class_exists('ImmoBien'));
    }

    /**
     * @test
     */
    public function objectShouldHaveRequiredProperties(): void
    {
        $reflection = new ReflectionClass('ImmoBien');
        $this->assertTrue($reflection->hasProperty('table_element'));
        $this->assertTrue($reflection->hasProperty('element'));
        $this->assertTrue($reflection->hasProperty('ref'));
        $this->assertTrue($reflection->hasProperty('status'));
    }

    /**
     * @test
     */
    public function sqlShouldCreateBienTable(): void
    {
        $sqlFile = __DIR__ . '/../../sql/llx_immo_bien.sql';
        $this->assertFileExists($sqlFile);
        $content = file_get_contents($sqlFile);
        $this->assertStringContainsString('CREATE TABLE', $content);
        $this->assertStringContainsString('llx_immo_bien', $content);
    }
}
