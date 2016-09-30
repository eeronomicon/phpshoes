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
        return $app['twig']->render('index.html.twig', array('stores' => Store::getAll(), 'brands' => Brand::getAll()));
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

    $app->post('/stores/{id}/add_brand', function($id) use ($app) {
        $store = Store::find($id);
        $store->addBrand($_POST['brand_id']);
        $brands = $store->getBrands();
        $non_brands = $store->getNonBrands();
        return $app['twig']->render('store.html.twig', array('store' => $store, 'brands' => $brands, 'nonbrands' => $non_brands));
    });

    $app->get('/brands', function() use ($app) {
        return $app['twig']->render('brands.html.twig', array('brands' => Brand::getAll()));
    });

    $app->post('/brands/add_brand', function() use ($app) {
        $brand_name = $_POST['brand_name'];
        $new_brand = new Brand($brand_name);
        $new_brand->save();
        return $app['twig']->render('brands.html.twig', array('brands' => Brand::getAll()));
    });

    $app->post('/brands/delete_all', function() use ($app) {
        Brand::deleteAll();
        return $app['twig']->render('brands.html.twig', array('brands' => Brand::getAll()));
    });

    $app->get('/brands/{id}', function($id) use ($app) {
        $brand = Brand::find($id);
        $stores = $brand->getStores();
        $non_stores = $brand->getNonStores();
        return $app['twig']->render('brand.html.twig', array('brand' => $brand, 'stores' => $stores, 'nonstores' => $non_stores));
    });

    $app->delete('/brands/{id}', function($id) use ($app) {
        $brand = Brand::find($id);
        $brand->delete();
        return $app['twig']->render('brands.html.twig', array('brands' => Brand::getAll()));
    });

    $app->patch('/brands/{id}', function($id) use ($app) {
        $new_name = $_POST['new_brand_name'];
        $brand = Brand::find($id);
        $brand->update($new_name);
        $stores = $brand->getStores();
        $non_stores = $brand->getNonStores();
        return $app['twig']->render('brand.html.twig', array('brand' => $brand, 'stores' => $stores, 'nonstores' => $non_stores));
    });

    $app->post('/brands/{id}/add_store', function($id) use ($app) {
        $brand = Brand::find($id);
        $brand->addStore($_POST['store_id']);
        $stores = $brand->getStores();
        $non_stores = $brand->getNonStores();
        return $app['twig']->render('brand.html.twig', array('brand' => $brand, 'stores' => $stores, 'nonstores' => $non_stores));
    });

    return $app;
?>
