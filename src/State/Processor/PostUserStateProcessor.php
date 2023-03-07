<?php

namespace App\State\Processor;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class PostUserStateProcessor implements ProcessorInterface
{
    public function __construct(
        private readonly ProcessorInterface $persistProcessor,
        private readonly RequestStack $requestStack,
        private readonly string $quizSecretKey,
    ) {
    }

    public function process($data, Operation $operation, array $uriVariables = [], array $context = [])
    {
        if (
            $this->requestStack->getCurrentRequest()->headers->get('X-AUTH-SECRET-KEY')
            !== $this->quizSecretKey
        ) {
            throw new UnauthorizedHttpException('Vous n\'avez pas l\'autorisation de créer un compte.');
        }

        return $this->persistProcessor->process($data, $operation, $uriVariables, $context);
    }
}