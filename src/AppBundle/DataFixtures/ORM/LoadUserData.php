<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Company;
use AppBundle\Entity\User;
use AppBundle\Entity\Category;
use AppBundle\Entity\Logo;
use AppBundle\Entity\Location;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{

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

        $testPassword = '123';
        
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
        $password = $encoder->encodePassword($testPassword, $systemUser->getSalt());
        $systemUser->setPassword($password);

        $manager->updateUser($systemUser);

        $this->addReference('system-user', $systemUser);

        /** Owner User */
        $ownerUser = $manager->createUser();

        $ownerUser->setUsername('owneruser');
        $ownerUser->setUsernameCanonical('owneruser'); 
        $ownerUser->setEmail('diegoangel@hotmail.com'); 
        $ownerUser->setEmailCanonical('diegoangel@hotmail.com'); 
        $ownerUser->setEnabled(true); 
        $ownerUser->setName('Owner User');
        $ownerUser->setRoles(array('ROLE_OWNER'));
        $encoder = $factory->getEncoder($ownerUser);
        $password = $encoder->encodePassword($testPassword, $ownerUser->getSalt());
        $ownerUser->setPassword($password);

        $manager->updateUser($ownerUser);

        $this->addReference('owner-user', $ownerUser);

        /** Redeemar User */

        $faker = \Faker\Factory::create();
        $faker->seed(1234);

        for ($i = 0; $i < 10; $i++)
        {
            $redeemarUser = $manager->createUser();

            $fakeUsername = $faker->userName;
            $redeemarUser->setUsername($fakeUsername);
            $ownerUser->setUsernameCanonical($fakeUsername);
            $fakeEmail = $faker->email;
            $redeemarUser->setEmail($fakeEmail);
            $redeemarUser->setEmailCanonical($fakeEmail);            
            $redeemarUser->setEnabled(true);
            $redeemarUser->setName($faker->Name);
            $redeemarUser->setRoles(array('ROLE_REDEEMAR_USER'));
            $encoder = $factory->getEncoder($redeemarUser);
            $password = $encoder->encodePassword($testPassword, $redeemarUser->getSalt());
            $redeemarUser->setPassword($password);

            $manager->updateUser($redeemarUser);

        }

        $populator = new \Faker\ORM\Doctrine\Populator($faker, $objectManager);
        $populator->addEntity('AppBundle:Category', 3);
        $populator->addEntity('AppBundle:Logo', 5);
        $populator->addEntity('AppBundle:Company', 5);
        $populator->addEntity('AppBundle:Location', 5);        

        $populator->execute();  

    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    function getOrder()
    {
        return 1;
    }

}