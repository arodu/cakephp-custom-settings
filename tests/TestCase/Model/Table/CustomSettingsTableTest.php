<?php
declare(strict_types=1);

namespace CustomSettings\Test\TestCase\Model\Table;

use Cake\TestSuite\TestCase;
use CustomSettings\Model\Table\CustomSettingsTable;

/**
 * CustomSettings\Model\Table\CustomSettingsTable Test Case
 */
class CustomSettingsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \CustomSettings\Model\Table\CustomSettingsTable
     */
    protected $CustomSettings;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'plugin.CustomSettings.CustomSettings',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('CustomSettings') ? [] : ['className' => CustomSettingsTable::class];
        $this->CustomSettings = $this->getTableLocator()->get('CustomSettings', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->CustomSettings);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \CustomSettings\Model\Table\CustomSettingsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
