<?php

namespace App\Command;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[AsCommand(
    name: 'app:create-user',
    description: 'Add a short description for your command',
)]
class CreateUserCommand extends Command
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private UserPasswordHasherInterface $hasher,
        private UserRepository $userRepository,
        private ValidatorInterface $validator
    )
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('email', InputArgument::REQUIRED, 'The email of the new user')
            ->addArgument('password', InputArgument::REQUIRED, 'The plain password of the new user')
            ->addOption('admin', null, InputOption::VALUE_NONE, 'If set, the user is created as an administrator')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        
        $emailConstraint = new Assert\Email();
        $email = $input->getArgument('email');

        // Check that the email address is valid
        if (count($this->validator->validate($email, $emailConstraint)) > 0) {
            $io->error(sprintf('The email address "%s" is invalid.', $email));
            return Command::FAILURE;
        }

        // Check that the new user's email address isn't already in use
        if ($this->userRepository->findOneBy(['email' => $email])) {
            $io->error('A user with the same email address already exists.');
            return Command::FAILURE;
        }

        // Make sure the password is at least 8 characters long
        $password = $input->getArgument('password');
        if (mb_strlen($password) < 8) {
            $io->error('The password must be at least 8 characters long.');
            return Command::FAILURE;
        }

        // Create a new user
        $user = new User();
        $user->setEmail($email);

        $hashedPassword = $this->hasher->hashPassword($user, $password);
        $user->setPassword($hashedPassword);

        if ($input->getOption('admin')) {
            $user->setRoles(['ROLE_ADMIN']);
        }

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $io->success('User was successfully created.');

        return Command::SUCCESS;
    }
}
