<?php

namespace Unit1\HelloWorldCli\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class HelloWorldCommand extends Command
{
    /**
     * @inheritDoc
     */
    protected function configure()
    {
        $this->setName('hello:world');
        $this->setDescription('Print Hello World');
        parent::configure();
    }

    /**
     * CLI command description
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $output->writeln("Hello World");
        $output->writeln("<error>Error</error>");
        $output->writeln("<info>Info</info>");
//        $this->progressBarDemo($output);
        $this->TableDemo($output);
    }

    private function TableDemo($output) {
        $table = new \Symfony\Component\Console\Helper\Table($output);
        $table
            ->setHeaders(['ISBN', 'Title', 'Author'])
            ->setRows([
                ['99921-58-10-7', 'Divine Comedy', 'Dante Alighieri'],
                ['9971-5-0210-0', 'A Tale of Two Cities', 'Charles Dickens'],
                ['960-425-059-0', 'The Lord of the Rings', 'J. R. R. Tolkien'],
                ['80-902734-1-6', 'And Then There Were None', 'Agatha Christie'],
            ])
        ;
        $table->render();
    }

    private function progressBarDemo($output) {
        // creates a new progress bar (50 units)
        $progressBar = new \Symfony\Component\Console\Helper\ProgressBar($output, 50);

        // starts and displays the progress bar
        $progressBar->start();

        $i = 0;
        while ($i++ < 50) {
            sleep(1);
            // ... do some work

            // advances the progress bar 1 unit
            $progressBar->advance();

            // you can also advance the progress bar by more than 1 unit
            // $progressBar->advance(3);
        }

        // ensures that the progress bar is at 100%
        $progressBar->finish();
    }
}
