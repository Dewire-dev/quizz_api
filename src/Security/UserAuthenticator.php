<?php

namespace App\Security;

use ApiPlatform\Api\IriConverterInterface;
use App\Repository\UserRepository;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;

class UserAuthenticator extends AbstractAuthenticator
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly JWTTokenManagerInterface $JWTTokenManager,
        private readonly IriConverterInterface $iriConverter,
        private readonly string $quizSecretKey,
    ) {
    }

    /**
     * Called on every request to decide if this authenticator should be
     * used for the request. Returning `false` will cause this authenticator
     * to be skipped.
     */
    public function supports(Request $request): ?bool
    {
        return $request->getPathInfo() === '/api/login';
    }

    public function authenticate(Request $request): Passport
    {
        $quizSecretKey = $request->headers->get('X-AUTH-SECRET-KEY');

        if ($this->quizSecretKey !== $quizSecretKey) {
            throw new UnauthorizedHttpException('Vous n\'êtes pas autorisé à accéder à l\'API.');
        }

        $ulid = $request->headers->get('X-AUTH-ULID');
        $user = $this->userRepository->findOneBy([
            'ulid' => $ulid,
        ]);

        if (null === $user) {
            throw new UserNotFoundException('Compte non existant');
        }

        return new SelfValidatingPassport(new UserBadge($user->getUlid()));
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        return new Response('', Response::HTTP_OK, [
            'token' => $this->JWTTokenManager->create($token->getUser()),
            'iri' => $this->iriConverter->getIriFromResource($token->getUser()),
        ]);
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        $data = [
            // you may want to customize or obfuscate the message first
            'message' => strtr($exception->getMessageKey(), $exception->getMessageData())

            // or to translate this message
            // $this->translator->trans($exception->getMessageKey(), $exception->getMessageData())
        ];

        return new JsonResponse($data, Response::HTTP_UNAUTHORIZED);
    }
}