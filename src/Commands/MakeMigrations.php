<?php

namespace Jet\Jet\Commands;
use \Symfony\Component\Console\Command\Command;
use Jet\Jet\Migrator;

/**
 * make migrations
 *
 * This calculates differences in the tables, finds the differences pushes them to the db.
 */
class MakeMigrations extends Command
{
    //$mg = new Migrator\Calculator();
    //$mg->create_migration_folder();

}