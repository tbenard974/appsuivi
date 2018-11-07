<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'debug.argument_resolver.service' shared service.

include_once $this->targetDirs[3].'/vendor/symfony/http-kernel/Controller/ArgumentValueResolverInterface.php';
include_once $this->targetDirs[3].'/vendor/symfony/http-kernel/Controller/ArgumentResolver/TraceableValueResolver.php';
include_once $this->targetDirs[3].'/vendor/symfony/http-kernel/Controller/ArgumentResolver/ServiceValueResolver.php';

return $this->privates['debug.argument_resolver.service'] = new \Symfony\Component\HttpKernel\Controller\ArgumentResolver\TraceableValueResolver(new \Symfony\Component\HttpKernel\Controller\ArgumentResolver\ServiceValueResolver(new \Symfony\Component\DependencyInjection\ServiceLocator(array('App\\Controller\\AbsenceController::demande' => function () {
    return ($this->privates['.service_locator.5xT3nu_'] ?? $this->load('get_ServiceLocator_5xT3nuService.php'));
}, 'App\\Controller\\SecurityController::login' => function () {
    return ($this->privates['.service_locator.ypl2DZZ'] ?? $this->load('get_ServiceLocator_Ypl2DZZService.php'));
}, 'App\\Controller\\AbsenceController:demande' => function () {
    return ($this->privates['.service_locator.5xT3nu_'] ?? $this->load('get_ServiceLocator_5xT3nuService.php'));
}, 'App\\Controller\\SecurityController:login' => function () {
    return ($this->privates['.service_locator.ypl2DZZ'] ?? $this->load('get_ServiceLocator_Ypl2DZZService.php'));
}))), ($this->privates['debug.stopwatch'] ?? $this->privates['debug.stopwatch'] = new \Symfony\Component\Stopwatch\Stopwatch(true)));
