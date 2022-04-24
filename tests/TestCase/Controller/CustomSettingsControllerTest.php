<?php
declare(strict_types=1);

namespace CustomSettings\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use CustomSettings\Controller\CustomSettingsController;

/**
 * CustomSettings\Controller\CustomSettingsController Test Case
 *
 * @uses \CustomSettings\Controller\CustomSettingsController
 */
class CustomSettingsControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'plugin.CustomSettings.CustomSettings',
    ];

    /**
     * Test index method
     *
     * @return void
     * @uses \CustomSettings\Controller\CustomSettingsController::index()
     */
    public function testIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     * @uses \CustomSettings\Controller\CustomSettingsController::view()
     */
    public function testView(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     * @uses \CustomSettings\Controller\CustomSettingsController::add()
     */
    public function testAdd(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     * @uses \CustomSettings\Controller\CustomSettingsController::edit()
     */
    public function testEdit(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     * @uses \CustomSettings\Controller\CustomSettingsController::delete()
     */
    public function testDelete(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
