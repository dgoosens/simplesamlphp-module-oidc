<?php

/*
 * This file is part of the simplesamlphp-module-oidc.
 *
 * Copyright (C) 2018 by the Spanish Research and Academic Network.
 *
 * This code was developed by Universidad de Córdoba (UCO https://www.uco.es)
 * for the RedIRIS SIR service (SIR: http://www.rediris.es/sir)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SimpleSAML\Modules\OpenIDConnect\Controller;

use SimpleSAML\Modules\OpenIDConnect\Factories\TemplateFactory;
use SimpleSAML\Modules\OpenIDConnect\Repositories\ClientRepository;
use Zend\Diactoros\ServerRequest;

class ClientIndexController
{
    /**
     * @var ClientRepository
     */
    private $clientRepository;
    /**
     * @var TemplateFactory
     */
    private $templateFactory;

    public function __construct(ClientRepository $clientRepository, TemplateFactory $templateFactory)
    {
        $this->clientRepository = $clientRepository;
        $this->templateFactory = $templateFactory;
    }

    public function __invoke(ServerRequest $request)
    {
        $clients = $this->clientRepository->findAll();

        return $this->templateFactory->render('oidc:clients/index.twig', [
            'clients' => $clients,
        ]);
    }
}
