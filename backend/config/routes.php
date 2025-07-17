<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
use Hyperf\HttpServer\Router\Router;
use App\Controller\UsuarioController;

Router::addRoute(['GET', 'POST', 'HEAD'], '/', 'App\Controller\IndexController@index');

Router::get('/favicon.ico', function () {
    return '';
});

Router::get('/usuarios', [UsuarioController::class, "listar"]);
Router::addRoute(['POST','OPTIONS'],'/criarusuario', [UsuarioController::class, "salvar"]);
Router::addRoute(['POST','OPTIONS'],'/editarusuario',[UsuarioController::class, "alterar"]);