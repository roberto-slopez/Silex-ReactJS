<?php
$app = new Silex\Application();
$app['debug'] = true;
$app['app_path'] = __DIR__.'/..';

$app->register(new Herrera\Wise\WiseServiceProvider(), [
        'wise.cache_dir' => __DIR__.'/../App/Config/Cache',
        'wise.path' => __DIR__.'/../App/Config',
        'wise.options' => [
            'parameters' => $app,
            'mode' => 'prod',
            'type' => 'yml',
            'config' => [
                'services' => 'services'
            ]
        ]
    ]
);

\Herrera\Wise\WiseServiceProvider::registerServices($app);
$app['twig']->addExtension(new \Entea\Twig\Extension\AssetExtension($app));

$app->mount('/', new App\Controller\MainController());

return $app;