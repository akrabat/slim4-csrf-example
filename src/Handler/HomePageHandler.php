<?php

declare(strict_types=1);

namespace App\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Log\LoggerInterface;
use Slim\Csrf\Guard;
use Slim\Psr7\Response;
use Slim\Views\Twig;

class HomePageHandler implements RequestHandlerInterface
{
    public function __construct(protected Guard $guard, protected Twig $view)
    {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $response = new Response();

        if ($request->getMethod() === 'GET') {
            // Handle GET
            $csrf['nameKey'] = $this->guard->getTokenNameKey();
            $csrf['valueKey'] = $this->guard->getTokenValueKey();
            $csrf['name'] = $request->getAttribute($csrf['nameKey']);
            $csrf['value'] = $request->getAttribute($csrf['valueKey']);

            return $this->view->render($response, 'form.twig', [
                'csrf' => $csrf,
            ]);
        }

        // Handle POST
        $name = $request->getParsedBody()['name'] ?? '';
        return $this->view->render($response, 'form_response.twig', [
            'name' => $name,
        ]);
    }
}
