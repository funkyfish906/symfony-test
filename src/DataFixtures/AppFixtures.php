<?php

namespace App\DataFixtures;

use App\Entity\Developer;
use App\Entity\Project;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $this->loadDevelopers($manager);
        $this->loadProjects($manager);
    }

    private function loadDevelopers(ObjectManager $manager): void
    {
        foreach ($this->getDeveloperData() as [$first_name, $last_name, $position]) {
            $developer = new Developer();
            $developer->setFirstName($first_name);
            $developer->setLastName($last_name);
            $developer->setPosition($position);
            $manager->persist($developer);
            $this->addReference($first_name, $developer);
        }

        $manager->flush();
    }
    private function loadProjects(ObjectManager $manager): void
    {
        foreach ($this->getProjectData() as [$name, $description] ) {
            $project = new Project();
            $project->setName($name);
            $project->setDescription($description);
            $manager->persist($project);
            $this->addReference($name, $project);
            $developers = $this->getDeveloperData();
            shuffle($developers);
            $project->addDevelopers($this->getReference($developers[0][0]));
        }
        $manager->flush();
    }

    private function getDeveloperData(): array
    {
        return [
            ['Jane', 'Ray', 'PHP Developer'],
            ['Tom', 'Doe', 'JS Developer'],
            ['John', 'Winston', 'Project Manager'],
        ];
    }
    private function getProjectData(): array
    {
        return [
            ['lorem','ipsum consectetur'],
            ['adipiscing', 'incididunt labore'],
            ['voluptate', 'dolore pariatur']
        ];
    }
}
