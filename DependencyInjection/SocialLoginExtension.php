<?php
/**
 * This file is part of SocialLogin4
 *
 * Copyright(c) Akira Kurozumi <info@a-zumi.net>
 *
 *  https://a-zumi.net
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\SocialLogin4\DependencyInjection;


use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Configuration;
use Doctrine\DBAL\DriverManager;
use Eccube\DependencyInjection\EccubeExtension;
use Plugin\SocialLogin4\Entity\Config;
use Plugin\SocialLogin4\Security\Authenticator\Auth0Authenticator;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class SocialLoginExtension extends EccubeExtension
{

    /**
     * @inheritDoc
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        // TODO: Implement load() method.
    }

    /**
     * @inheritDoc
     */
    public function prepend(ContainerBuilder $container)
    {
        $securityConfig = $container->getExtensionConfig('security');
        $firewalls = $securityConfig[0]['firewalls'];
        $firewalls['customer']['guard'] = [
            "authenticators" => [
                Auth0Authenticator::class
            ]
        ];
        $container->prependExtensionConfig('security', ['firewalls' => $firewalls]);
    }
}
