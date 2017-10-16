<?php
/**
 * @Project: slim_project.
 * @Author: Gerley Adriano Miranda Cruz
 * @Created: 22/01/2017
 */

require_once __DIR__ .'/vendor/autoload.php';

$app = new \Slim\Slim(array('templates.path' => 'templates'));

$app->get('/pessoas/', function () use ($app){
    (new \controllers\Pessoa($app))->lista();
});

$app->get('/pessoas/:id', function ($id) use ($app) {
    (new \controllers\Pessoa($app))->get($id);
});

$app->post('/pessoas/', function () use ($app) {
    (new \controllers\Pessoa())->adicionar();
});

$app->put('/pessoas/:id', function ($id) use ($app) {
    (new \controllers\Pessoa())->editar($id);
});

$app->delete('/pessoas/:id', function ($id) use ($app) {
    (new \controllers\Pessoa())->excluir($id);
});

$app->run();