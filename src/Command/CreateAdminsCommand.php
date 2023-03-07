<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class CreateAdminsCommand extends Command
{
    protected static $defaultName = 'app:admins:create';
    protected static $defaultDescription = 'Создание администратров для разработки';
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager, string $name = null)
    {
        parent::__construct($name);
        $this->entityManager = $entityManager;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        foreach ($this->getAdminsData() as $name){
            $user = new User();
            $user->setName($name);
            $user->addRole(User::ROLE_ADMIN);
            $this->entityManager->persist($user);
        }

        $this->entityManager->flush();

        $io->success('Администраторы созданы.');

        return Command::SUCCESS;
    }

    private function getAdminsData()
    {
        return [
            'Николай',
            'Олег',
            'Владимир',
            'Марина',
        ];
    }
}
