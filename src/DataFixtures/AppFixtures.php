<?php

namespace App\DataFixtures;

use App\Entity\Cellule;
use App\Entity\Commune;
use App\Entity\District;
use App\Entity\Membre;
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
        $u = (new User())->setEmail('nongamichee@gmail.com')->setRoles(['ROLE_USER', 'ROLE_ADMIN']);
        $u->setPassword($this->passwordHasher->hashPassword(
            $u,
            "12345678"
        ));

        $p = (new Province())->setName('Kinshasa');
        $p2 = (new Province())->setName('Kongo-Central');


        $d = (new District())->setName('Mont-Amba')->setProvince($p);
        $d2 = (new District())->setName('Tshangu')->setProvince($p);

        $c = (new Commune())->setName('Limete')->setDistrict($d);

        $c2 = (new Commune())->setName('Lemba')->setDistrict($d);

        $q = (new Cellule())->setName('Kingabwa')->setCommune($c);

        $q2 = (new Cellule())->setName('Mombele')->setCommune($c);


        $m = (new Membre())
            ->setFirstName('michee')
            ->setName('nonga')
            ->setLastName('mahuk')
            ->setPhoneNumber('+243812964545')
            ->setEmail('jc@gmail.com')
            ->setSubscriptionDate(new \DateTime("2021-06-01"))
            ->setSexe('M')
            ->setCellule($q);
        $m2 = (new Membre())
            ->setFirstName('madara')
            ->setName('uchiha')
            ->setLastName('rinnegan')
            ->setPhoneNumber('+243812964543')
            ->setEmail('madara@gmail.com')
            ->setSubscriptionDate(new \DateTime("2020-06-01"))
            ->setSexe('M')
            ->setCellule($q2);

        $m3 = new Membre();
        $m3->setFirstName('itachi')
            ->setName('uchiha')
            ->setLastName('sharingan')
            ->setPhoneNumber('+243812964547')
            ->setEmail('itachi@gmail.com')
            ->setSubscriptionDate(new \DateTime("2019-06-01"))
            ->setSexe('F')
            ->setCellule($q2);


        $manager->persist($u);
        $manager->persist($p);
        $manager->persist($p2);
        $manager->persist($d);
        $manager->persist($d2);
        $manager->persist($c);
        $manager->persist($c2);

        $manager->persist($q);
        $manager->persist($q2);
        $manager->persist($m);
        $manager->persist($m2);
        $manager->persist($m3);


        $manager->flush();
    }
}
