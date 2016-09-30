<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__.'/../vendor/autoload.php';
    require_once __DIR__.'/../src/Store.php';
    require_once __DIR__.'/../src/Brand.php';

    $app = new Silex\Application();
    $app['debug'] = true;

    $server = 'mysql:host=localhost:8889;dbname=shoes';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->get('/', function() use ($app) {
        return $app['twig']->render('index.html.twig');
    });

    $app->get('/stores', function() use ($app) {
        return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll()));
    });

    $app->post('/stores/add_store', function() use ($app) {
        $store_name = $_POST['store_name'];
        $new_store = new Store($store_name);
        $new_store->save();
        return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll()));
    });

    $app->post('/stores/delete_all', function() use ($app) {
        Store::deleteAll();
        return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll()));
    });

    $app->get('/stores/{id}', function($id) use ($app) {
        $store = Store::find($id);
        $brands = $store->getBrands();
        $non_brands = $store->getNonBrands();
        return $app['twig']->render('store.html.twig', array('store' => $store, 'brands' => $brands, 'nonbrands' => $non_brands));
    });

    $app->delete('/stores/{id}', function($id) use ($app) {
        $store = Store::find($id);
        $store->delete();
        return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll()));
    });

    $app->patch('/stores/{id}', function($id) use ($app) {
        $new_name = $_POST['new_store_name'];
        $store = Store::find($id);
        $store->update($new_name);
        $brands = $store->getBrands();
        $non_brands = $store->getNonBrands();
        return $app['twig']->render('store.html.twig', array('store' => $store, 'brands' => $brands, 'nonbrands' => $non_brands));
    });


    return $app;
?>
