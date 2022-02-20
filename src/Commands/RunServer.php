<?php

namespace Jet\Jet\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Jet\Jet\Core\BaseManager;

class RunServer extends Command
{
    protected  $title = "runserver";
    protected $description = "Connects to the database and maintains the connection";

    protected $name = 'runserver';


    protected function configure()
    {
        $this
            ->setName($this->title)
            ->setDescription($this->description);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $connection = new BaseManager();
        $connection->connect();
        $output->writeln("Connected to " . $connection->connection['database']);
        exec('php -S localhost:8000');
    }
}