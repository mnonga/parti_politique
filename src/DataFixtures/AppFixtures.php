<?php

namespace App\DataFixtures;

use App\Entity\Cellule;
use App\Entity\Commune;
use App\Entity\District;
use App\Entity\Province;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $u = new User();
        $u->setEmail('nongamichee@gmail.com');
        $u->setPassword($this->passwordHasher->hashPassword(
            $u,
            "12345678"
        ));
        $u->setRoles(['ROLE_USER','ROLE_ADMIN']);

        $p = new Province();
        $p->setName('Kinshasa');
        $d = new District();
        $d->setName('Mont-Amba');
        $d->setProvince($p);
        $c = new Commune();
        $c->setName('Limete');
        $c->setDistrict($d);
        $q = new Cellule();
        $q->setName('Kingabwa');
        $q->setCommune($c);

        $manager->persist($u);
        $manager->persist($p);
        $manager->persist($d);
        $manager->persist($c);
        $manager->persist($q);

        $manager->flush();
    }
}
