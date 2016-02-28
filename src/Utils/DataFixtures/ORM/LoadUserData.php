<?php

namespace Utils\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Redeemar\Entity\Company;
use Redeemar\Entity\User;
use Redeemar\Entity\Category;
use Redeemar\Entity\Logo;
use Redeemar\Entity\Location;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{

    const PASSWORD_DEFAULT = 123;

    /**
     * @var ContainerInterface
     */
    private $container;
    
    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {

        /**
         * @var $objectManager Original object manager stored 
         * for being passed to the Faker Populate class
         */
        $objectManager = $manager;
        
        $factory = $this->container->get('security.encoder_factory');
        
        /** @var $manager \FOS\UserBundle\Doctrine\UserManager */
        $manager = $this->container->get('fos_user.user_manager');

        /** System User */
        $systemUser = $manager->createUser();

        $systemUser->setUsername('systemuser');
        $systemUser->setUsernameCanonical('systemuser'); 
        $systemUser->setEmail('diegoangel77@gmail.com'); 
        $systemUser->setEmailCanonical('diegoangel77@gmail.com'); 
        $systemUser->setEnabled(true); 
        $systemUser->setPassword('systemuser'); 
        $systemUser->setName('System User');
        $systemUser->setRoles(array('ROLE_ADMIN'));
        $encoder = $factory->getEncoder($systemUser);
        $password = $encoder->encodePassword(self::PASSWORD_DEFAULT, $systemUser->getSalt());
        $systemUser->setPassword($password);

        $manager->updateUser($systemUser);

        $this->addReference('system-user', $systemUser);

        /** Owner User */

        $faker = \Faker\Factory::create();
        $faker->seed(1234);

        $populator = new \Faker\ORM\Doctrine\Populator($faker, $objectManager);

        /**
         * Category Entity
         */
        $fakeCategories = ['Gastronomy', 'Electronics', 'Beauty'];
        $populator->addEntity('Redeemar:Category', 3, [
            'name' => function() use($fakeCategories) { 
                return $this->getRandomElementFromArray($fakeCategories); 
            }, 
        ]);

        for ($i = 1; $i <= 5; $i++) {
            $ownerUser = $manager->createUser();

            $username = 'owner' . $i;
            $ownerUser->setUsername($username);
            $ownerUser->setUsernameCanonical($username); 
            $ownerUser->setEmail($username . '@example.org'); 
            $ownerUser->setEmailCanonical($username . '@example.org'); 
            $ownerUser->setEnabled(true); 
            $ownerUser->setName($faker->Name);
            $ownerUser->setRoles(array('ROLE_OWNER'));
            $encoder = $factory->getEncoder($ownerUser);
            $password = $encoder->encodePassword(self::PASSWORD_DEFAULT, $ownerUser->getSalt());
            $ownerUser->setPassword($password);

            $manager->updateUser($ownerUser);
            
            $this->addReference('owner-user' . $i, $ownerUser);
        }

        /** Redeemar User */

        for ($i = 1; $i <= 5; $i++) {
            $redeemarUser = $manager->createUser();

            $username = 'redeemar' . $i;
            $redeemarUser->setUsername($username);
            $ownerUser->setUsernameCanonical($username);
            $redeemarUser->setEmail($username . '@example.org');
            $redeemarUser->setEmailCanonical($username . '@example.org');            
            $redeemarUser->setEnabled(true);
            $redeemarUser->setName($faker->Name);
            $redeemarUser->setRoles(array('ROLE_REDEEMAR_USER'));
            $encoder = $factory->getEncoder($redeemarUser);
            $password = $encoder->encodePassword(self::PASSWORD_DEFAULT, $redeemarUser->getSalt());
            $redeemarUser->setPassword($password);

            $manager->updateUser($redeemarUser);
        }

        /**
         * Company Entity
         */
        $elementsPositions = [1, 2, 3, 4, 5];
        $populator->addEntity('Redeemar:Company', 5, [
            'user' => function() use ($faker) { 
                $position = $faker->unique()->numberBetween(1, 5);
                return $this->getReference('owner-user' . $position); 
            },
            'name' => function() use ($faker) { 
                return $faker->unique()->company(); 
            },
            'website' => function() use ($faker) { 
                return $faker->url(); 
            },
            'video' => 'https://www.youtube.com/watch?v=SwN4LgOw6mo',
        ]);

        /**
         * Logo Entity
         */
        $populator->addEntity('Redeemar:Logo', 5, [
            'path' => function() use ($faker) { 
                return $faker->image($dir = '/tmp', $width = 640, $height = 480); 
            },
        ]); 
        
        /**
         * Campaign Entity
         */
        $populator->addEntity('Redeemar:Campaign', 3, [
            'name' => function() use ($faker) { 
                return $faker->unique()->catchPhrase(); 
            },
            'startDate' => function() use ($faker) { 
                return $faker->dateTimeBetween($startDate = '-30 days', $endDate = '+30 days'); 
            },
            'endDate' => function() use ($faker) { 
                return $faker->dateTimeBetween($startDate = '-30 days', $endDate = '+30 days'); 
            },
        ]);

        /**
         * Location Entity
         */       
        $populator->addEntity('Redeemar:Location', 5, [
            'name' => function() use ($faker) { 
                return $faker->unique()->company(); 
            },
            'contact' => function() use ($faker) { 
                return $faker->unique()->name(); 
            },
            'latitude' => function() use ($faker) { 
                return $faker->latitude($min = 40, $max = 45); 
            },
            'longitude' => function() use ($faker) { 
                return $faker->longitude($min = 73, $max = 79); 
            },
        ]);

        /**
         * Offer Entity
         */
        $populator->addEntity('Redeemar:Offer', 10, [
            'startDate' => function() use ($faker) { 
                return $faker->dateTime('now'); 
            },
            'endDate' => function() use ($faker) { 
                return $faker->dateTime('+3 days'); 
            },
            'redeemarsUsed' => function() use ($faker) { 
                return $faker->numberBetween($min = 1, $max = 60); 
            },
            'redeemarsForValidation' => function() use ($faker) { 
                return $faker->numberBetween($min = 70, $max = 200); 
            },
            'percentage' => function() use ($faker) { 
                return $faker->numberBetween($min = 1, $max = 30); 
            },
            'imagePath' => function() use ($faker) { 
                return $faker->image($dir = '/tmp', $width = 640, $height = 480); 
            },            
            'fixedAmount' => function() use ($faker) { 
                return $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 100); 
            },
            'redeemarPrice' => function() use ($faker) { 
                return $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 100); 
            },
        ]);

        /**
         * Validator User Entity
         */
        $populator->addEntity('Redeemar:ValidatorUser', 10, [
            'charge' => function() {
                return 'Manager';
            },
            'name' => function() use ($faker) {
                return $faker->Name;
            },
            'ipad' => function() use ($faker) {
                return 1;
            },
        ]);

        $populator->execute();  

    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 1;
    }

    /**
     * Randomize an array and return one element
     *
     * @param $array array
     *
     * @return mixed
     */
    private function getRandomElementFromArray($array = [])
    {
        if (empty($array)) {
            return 'Dummy value';
        }

        return $array[array_rand($array)];
    }
}
