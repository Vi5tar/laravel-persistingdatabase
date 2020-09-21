<?php

namespace Vi5tar;

trait PersistingDatabase {
    protected static $dbSetupNeeded = true;

    public function setUp(): void
    {
        parent::setUp();

        $this->setupDbIfNeeded();
    }

    public function setupDb(): void
    {
        // override and setup db as needed for tests in test case.
    }

    /**
     * Setup database according to setupDb if needed.
     * 
     * @return void
     */
    protected function setupDbIfNeeded() {
        if (self::$dbSetupNeeded) {
            $this->resetDatabase();
            $this->setupDb();
            self::$dbSetupNeeded = false;
        }
    }

    /**
     * Reset database according to setupDb.
     */
    protected function reSetupDb() {
        self::$dbSetupNeeded = true;
        $this->setupDbIfNeeded();
    }

    /**
     * Reset database to a freshly migrated state.
     * 
     * @return void
     */
    protected function resetDatabase()
    {
        $this->usingInMemoryDatabase()
                        ? $this->artisan('migrate')
                        : $this->artisan('migrate:fresh');
    }

    /**
     * Determine if an in-memory database is being used.
     * Swiped this from Illuminate\Foundation\Testing\RefreshDatabase
     *
     * @return bool
     */
    protected function usingInMemoryDatabase()
    {
        $default = config('database.default');

        return config("database.connections.$default.database") === ':memory:';
    }
}