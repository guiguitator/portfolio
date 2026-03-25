<?php

namespace App\DataFixtures;

use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TagFixtures extends Fixture
{
    public const TAG_1_REFERENCE = 'tag-1';
    public const TAG_2_REFERENCE = 'tag-2';
    public const TAG_3_REFERENCE = 'tag-3';
    public const TAG_4_REFERENCE = 'tag-4';

    public function load(ObjectManager $manager): void
    {
        $tag1 = new Tag();
        $tag1->setName('Tag n°1');
        $this->addReference(self::TAG_1_REFERENCE, $tag1);
        $manager->persist($tag1);

        $tag2 = new Tag();
        $tag2->setName('Tag n°2');
        $this->addReference(self::TAG_2_REFERENCE, $tag2);
        $manager->persist($tag2);

        $tag3 = new Tag();
        $tag3->setName('Tag n°3');
        $this->addReference(self::TAG_3_REFERENCE, $tag3);
        $manager->persist($tag3);

        $tag4 = new Tag();
        $tag4->setName('Tag n°4');
        $this->addReference(self::TAG_4_REFERENCE, $tag4);
        $manager->persist($tag4);

        $manager->flush();
    }
}
