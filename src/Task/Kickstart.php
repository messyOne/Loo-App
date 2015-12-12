<?php

namespace Task;

use User\UserFactory;
use Loo\Core\MasterFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use User\UserRoles;

/**
 * Creates the default test data
 */
class Kickstart extends Command
{
    /**
     * Configure
     */
    protected function configure()
    {
        $this
            ->setName('app:kickstart')
            ->setDescription('Creates example data')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $factory = new MasterFactory();
        $entityManager = $factory->getDatabaseFactory()->getEntityManager();
        $tool = $factory->getDatabaseFactory()->getSchemaTool();

        $output->writeln("Drop database...");
        $tool->dropDatabase();
        $output->writeln("Create database...");
        $tool->createSchema($entityManager->getMetadataFactory()->getAllMetadata());

        $users = (new UserFactory())->getUsers();
        $user = $users->create('user', 'testtest', UserRoles::USER);
        $entityManager->persist($user);

        $output->writeln("Persist data...");
        $entityManager->flush();
    }
}
