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

namespace Plugin\SocialLogin4\Controller;


use Eccube\Controller\AbstractController;
use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Csrf\TokenStorage\TokenStorageInterface;

/**
 * Class Auth0Controller
 * @package Plugin\SocialLogin4\Controller
 *
 * @Route("/auth0")
 */
class Auth0Controller extends AbstractController
{
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    public function __construct(
        TokenStorageInterface $tokenStorage
    )
    {
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @param Request $request
     * @return mixed
     *
     * @Route("", name="auth0")
     */
    public function index(Request $request)
    {
        /** @var ClientRegistry $registry */
        $registry = $this->get('oauth2.registry');
        return $registry
            ->getClient('auth0')
            ->redirect(['email']);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Route("/connect_check", name="auth0_connect_check")
     */
    public function connect_check()
    {
        if($this->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirectToRoute('mypage');
        } else {
            return $this->redirectToRoute('auth0');
        }
    }
}