<?php
declare(strict_types=1);
require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/../../core/modules/modImmobien.class.php';
require_once __DIR__ . '/../../class/immobien.class.php';

class ImmoBienTest extends PHPUnit\Framework\TestCase
{
    /** @test */
    public function moduleClassShouldExist(): void
    {
        $this->assertTrue(class_exists('modImmobien'));
    }

    /** @test */
    public function objectClassShouldExist(): void
    {
        $this->assertTrue(class_exists('ImmoBien'));
    }

    /** @test */
    public function sqlFileShouldContainCreateTable(): void
    {
        $content = file_get_contents(__DIR__ . '/../../sql/llx_immo_bien.sql');
        $this->assertStringContainsString('CREATE TABLE', $content);
        $this->assertStringContainsString('llx_immo_bien', $content);
    }

    /** @test */
    public function uiFilesShouldExist(): void
    {
        $this->assertFileExists(__DIR__ . '/../../index.php');
        $this->assertFileExists(__DIR__ . '/../../card.php');
    }
}
