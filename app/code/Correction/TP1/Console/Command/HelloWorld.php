<?php

namespace Correction\TP1\Console\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class HelloWorld extends \Symfony\Component\Console\Command\Command
{
    protected function configure()
    {
        $this->setName('correction:tp1:helloworld')->setDescription('Show a test message') ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("<info>Hello world.</info>");
    }

}