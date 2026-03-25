<?php

namespace App\DataFixtures;

use App\Entity\Message;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MessageFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $unansweredMessage = new Message();
        $unansweredMessage->setSenderName('Paul Dupont');
        $unansweredMessage->setSenderEmail('paul.dupont@mail.com');
        $unansweredMessage->setSubject('Message de M. Dupont');
        $unansweredMessage->setContent('...');
        $manager->persist($unansweredMessage);

        $answeredMessage = new Message();
        $answeredMessage->setSenderName('Pierre Dupuit');
        $answeredMessage->setSenderEmail('pierre.dupuit@mail.com');
        $answeredMessage->setSubject('Message de M. Dupuit');
        $answeredMessage->setContent('...');
        $manager->persist($answeredMessage);

        $manager->flush();
    }
}
