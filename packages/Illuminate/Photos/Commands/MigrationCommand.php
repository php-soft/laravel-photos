<?php

namespace PhpSoft\Illuminate\Photos\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;

class MigrationCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'modulename:migrate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Photos module generate migration.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $this->createMigration();
        $this->info("Run 'php artisan migrate' to finish migration.");
    }

    /**
     * Create the migration.
     *
     * @param string $name
     *
     * @return bool
     */
    protected function createMigration()
    {
        $migration = file_get_contents(__DIR__ . '/migrations/photos_setup_tables.php');
        $migration = '<?php' . $migration;

        $filename = date('Y_m_d_His').'_photos_setup_tables';
        file_put_contents(base_path('/database/migrations').'/'.$filename.'.php', $migration);

        $this->line("<info>Created Migration:</info> $filename");
    }
}
