<?php

namespace App\Tests\Auth;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\User;
use Hautelook\AliceBundle\PhpUnit\ReloadDatabaseTrait;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;

class AuthenticationTest extends ApiTestCase
{
    use ReloadDatabaseTrait;

    public function testLogin(): void
    {
        $client = self::createClient();
        $container = self::getContainer();

        $user = new User();
        $user->setEmail('test@example.com');

        /** @var UserPasswordHasher $userPasswordHasher */
        $userPasswordHasher = $container->get('security.user_password_hasher');
        $user->setPassword($userPasswordHasher->hashPassword($user, '$3CR3T'));

        /** @var ManagerRegistry $manager */
        $manager = $container->get('doctrine');
        $manager->getManager()->persist($user);
        $manager->getManager()->flush();

        $response = $client->request('POST', '/auth', [
            'headers' => ['Content-Type' => 'application/json'],
            'json' => [
                'email' => 'test@example.com',
                'password' => '$3CR3T',
            ],
        ]);

        $json = $response->toArray();
        $this->assertResponseIsSuccessful();
        $this->assertArrayHasKey('token', $json);

        // test not authorized
        $client->request('GET', '/greetings');
        $this->assertResponseStatusCodeSame(401);

        // test authorized
        $client->request('GET', '/greetings', ['auth_bearer' => $json['token']]);
        $this->assertResponseIsSuccessful();
    }
}
