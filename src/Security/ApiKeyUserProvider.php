<?php
namespace App\Security;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;

class ApiKeyUserProvider implements UserProviderInterface
{
    private $em;

    /**
     * [__construct]
     */
    public function __construct()
    {
        $this->em = $GLOBALS['kernel']->getContainer()->get('doctrine')->getManager();
    }

    /**
     * [loadUserByApiKey]
     * @param  $apiKey
     * @return string
     */
    public function loadUserByApiKey($apiKey)
    {
        $user = $this->em->getRepository('App:User')
            ->findOneBy(['token' => $apiKey]);

        if(empty($user)){
            throw new UsernameNotFoundException('Could not find user. Sorry!');
        }

        // $this->user = $user;

        return $user->getName();
    }

    /**
     * [loadUserByUsername]
     * @param  [type] $username
     * @return user object
     */
    public function loadUserByUsername($username)
    {
        return new User(
            $username,
            null,
            '',
            // the roles for the user - you may choose to determine
            // these dynamically somehow based on the user
            array('ROLE_API')
        );
    }

    /**
     * [refreshUser]
     * @param  UserInterface $user
     * @return
     */
    public function refreshUser(UserInterface $user)
    {
        // this is used for storing authentication in the session
        // but in this example, the token is sent in each request,
        // so authentication can be stateless. Throwing this exception
        // is proper to make things stateless
        throw new UnsupportedUserException();
    }

    /**
     * [supportsClass]
     * @param  user class $class
     * @return user object
     */
    public function supportsClass($class)
    {
        return User::class === $class;
    }
}