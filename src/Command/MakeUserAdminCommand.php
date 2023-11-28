<?php

namespace App\Command;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:make:user:admin',
    description: 'Add admin role to a current user',
)]
class MakeUserAdminCommand extends Command
{
    public function __construct(
        private UserRepository $userRepository, 
        private EntityManagerInterface $entityManager
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('userId', InputArgument::REQUIRED, 'The user ID');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $userId = $input->getArgument('userId');
        $user = $this->userRepository->find($userId);

        $user->setRoles(array_unique([...$user->getRoles(), 'ROLE_ADMIN']));
        $this->entityManager->flush();

        $io->success("L'uilisateur {$user->getEmail()} est maintenant administrateur.");

        return Command::SUCCESS;
    }
}
