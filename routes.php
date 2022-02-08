<?php
use Tm\Router;

Router::get('/', [new Tm\Controller\HomeController, 'index'], 'home');

Router::get('/clients', [new Tm\Controller\ClientsController, 'index'], 'clients.index');
Router::store('/clients/create', [new Tm\Controller\ClientsController, 'create'], 'clients.create');
Router::get('/clients/[i:id]', [new Tm\Controller\ClientsController, 'show'], 'clients.show');
Router::store('/clients/[i:id]/edit', [new Tm\Controller\ClientsController, 'edit'], 'clients.edit');
Router::get('/clients/[i:id]/delate', [new Tm\Controller\ClientsController, 'delate'], 'clients.delate');

Router::get('/comptes', [new Tm\Controller\ComptesController, 'index'], 'comptes.index');
Router::store('/comptes/create/[i:id]', [new Tm\Controller\ComptesController, 'create'], 'comptes.create');
Router::post('/comptes/create/clients', [new Tm\Controller\ComptesController, 'clients'], 'comptes.create.clients');
Router::get('/comptes/[i:id]', [new Tm\Controller\ComptesController, 'show'], 'comptes.show');
Router::store('/comptes/[i:id]/credit', [new Tm\Controller\ComptesController, 'krediet'], 'comptes.credit');
Router::store('/comptes/[i:id]/retire', [new Tm\Controller\ComptesController, 'onttrek'], 'comptes.retire');
