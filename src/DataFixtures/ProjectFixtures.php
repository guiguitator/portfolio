<?php

namespace App\DataFixtures;

use App\Entity\Project;
use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProjectFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $project1 = new Project();
        $project1->setName('Project n°1');
        $project1->setCaption('First completed project.');
        $project1->setContent('My first awesome project with tons of features.');
        $project1->setFeatured(true);
        $project1->addTag($this->getReference(TagFixtures::TAG_1_REFERENCE, Tag::class));
        $project1->addTag($this->getReference(TagFixtures::TAG_2_REFERENCE, Tag::class));
        $manager->persist($project1);

        $project2 = new Project();
        $project2->setName('Project n°2');
        $project2->setCaption('Second completed project.');
        $project2->setContent('My second awesome project with tons of features.');
        $project2->setFeatured(true);
        $project2->addTag($this->getReference(TagFixtures::TAG_2_REFERENCE, Tag::class));
        $manager->persist($project2);

        $project3 = new Project();
        $project3->setName('Project n°3');
        $project3->setCaption('Third completed project.');
        $project3->setContent('My third awesome project with tons of features.');
        $project3->setFeatured(true);
        $project3->addTag($this->getReference(TagFixtures::TAG_3_REFERENCE, Tag::class));
        $project3->addTag($this->getReference(TagFixtures::TAG_4_REFERENCE, Tag::class));
        $manager->persist($project3);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            TagFixtures::class,
        ];
    }
}
