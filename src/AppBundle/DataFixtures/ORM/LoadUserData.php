<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;

class LoadUserData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
    	/** System User */
        $systemUser = new User();
        $systemUser->setUsername('systemuser');
        $systemUser->setUsernameCanonical('systemuser'); 
        $systemUser->setEmail('diegoangel77@gmail.com'); 
        $systemUser->setEmailCanonical('diegoangel77@gmail.com'); 
        $systemUser->setEnabled(1); 
        $systemUser->setPassword('$2y$13$ljrehk4t9vkw8gsgsg4cwulJZF\/xmXA645VuovFucVGitbJpZaeNS'); 
        $systemUser->setLastLogin(null); 
        $systemUser->setLocked(0); 
        $systemUser->setExpired(0); 
        $systemUser->setExpiresAt(null); 
        $systemUser->setConfirmationToken(null); 
        $systemUser->setPasswordRequestedAt(null); 
        $systemUser->setCredentialsExpired(0); 
        $systemUser->setCredentialsExpireAt(null); 
        $systemUser->setName('System User');

        /** Owner User */

        /** Redeemar User */

        $manager->persist($systemUser);
        $manager->flush();
    }
}