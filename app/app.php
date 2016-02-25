<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Restaurant.php";
    require_once __DIR__."/../src/Cuisine.php";
    require_once __DIR__."/../src/Review.php";

    // session_start();

    $app = new Silex\Application();

    $server = 'mysql:host=localhost;dbname=chomp';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path'=>__DIR__."/../views"
    ));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig',
        array(
            'cuisines' => Cuisine::getAll()
        ));
    });

    $app->get("/cuisines/{id}", function($id) use ($app) {
        $cuisine = Cuisine::find($id);
        return $app['twig']->render('cuisine.html.twig', array(
            'cuisine' => $cuisine,
            'restaurants' => $cuisine->getRestaurants()
        ));
    });

    $app->get("/cuisines/{id}/edit", function($id) use ($app) {
    $new_cuisine = Cuisine::find($id);
    return $app['twig']->render('cuisine_edit.html.twig', array('cuisine' => $new_cuisine));
    });

    $app->patch("/cuisines/{id}", function($id) use ($app) {
    $name = $_POST['name'];
    $cuisine = Cuisine::find($id);
    $cuisine->update($name);
    return $app['twig']->render('cuisine.html.twig', array('cuisine' => $cuisine, 'restaurants' => $cuisine->getRestaurants()));
    });

    $app->post("/cuisines", function() use ($app) {
        $new_cuisine = new Cuisine($_POST['name']);
        $new_cuisine->save();
        return $app['twig']->render('index.html.twig', array(
            'cuisines' => Cuisine::getAll()
        ));
    });

    $app->post("/restaurants", function() use ($app) {
        $rest_name = $_POST['rest_name'];
        $location = $_POST['location'];
        $price_range = $_POST['price_range'];
        $cuisine_id = $_POST['cuisine_id'];
        $new_restaurant = new Restaurant($rest_name, $id = null, $location, $price_range, $cuisine_id);
        $new_restaurant->save();
        $cuisine = Cuisine::find($cuisine_id);
        return $app['twig']->render('cuisine.html.twig', array(
            'cuisine' => $cuisine,
            'restaurants' => $cuisine->getRestaurants()
        ));
    });

    $app->get("/restaurants/{id}/edit", function($id) use ($app) {
        $restaurant = Restaurant::find($id);
        return $app['twig']->render('restaurant_edit.html.twig', array('restaurant' => $restaurant));
    });

    $app->patch("/restaurants/{id}/rest_name", function($id) use ($app) {
        $new_rest_name = $_POST['rest_name'];
        $restaurant = Restaurant::find($id);
        $restaurant->updateRestName($new_rest_name);
        $cuisine_id = $restaurant->getCuisineId();
        $cuisine = Cuisine::find($cuisine_id);
        return $app['twig']->render('cuisine.html.twig', array('cuisine' => $cuisine, 'restaurants' => $cuisine->getRestaurants()));
    });

    $app->patch("/restaurants/{id}/location", function($id) use ($app) {
        $new_location = $_POST['location'];
        $restaurant = Restaurant::find($id);
        $restaurant->updateLocation($new_location);
        $cuisine_id = $restaurant->getCuisineId();
        $cuisine = Cuisine::find($cuisine_id);
        return $app['twig']->render('cuisine.html.twig', array('cuisine' => $cuisine, 'restaurants' => $cuisine->getRestaurants()));
    });

    $app->patch("/restaurants/{id}/price_range", function($id) use ($app) {
        $new_price_range = $_POST['price_range'];
        $restaurant = Restaurant::find($id);
        $restaurant->updatePriceRange($new_price_range);
        $cuisine_id = $restaurant->getCuisineId();
        $cuisine = Cuisine::find($cuisine_id);
        return $app['twig']->render('cuisine.html.twig', array('cuisine' => $cuisine, 'restaurants' => $cuisine->getRestaurants()));
    });

    $app->get("/restaurants/{id}/review", function($id) use ($app) {
        $restaurant = Restaurant::find($id);
        return $app['twig']->render('restaurant_review.html.twig', array('restaurant' => $restaurant));
    });

    $app->post("/restaurants/{id}/review", function($id) use ($app) {
        $reviewer_name = $_POST['reviewer_name'];
        $review_score = $_POST['review_score'];
        $review_content = $_POST['review_content'];
        $restaurant = Restaurant::find($id);
        $restaurant_id = $restaurant->getId();
        $new_review = new Review ($reviewer_name, $review_score, $review_content, $restaurant_id, $id = null);
        $new_review->save();

        return $app['twig']->render('restaurant_review.html.twig', array('restaurant' => $restaurant, 'reviews' => $restaurant->getReviews()));
    });

    $app->delete("/cuisines/{id}", function($id) use ($app) {
        $cuisine = Cuisine::find($id);
        $cuisine->delete();
        return $app['twig']->render('index.html.twig', array('cuisines' => Cuisine::getAll()));
        });

    $app->delete("/restaurants/{id}/delete", function($id) use ($app) {
        $restaurant = Restaurant::find($id);
        $cuisine_id = $restaurant->getCuisineId();
        $cuisine = Cuisine::find($cuisine_id);
        $restaurant->deleteOneRestaurant();
        return $app['twig']->render('cuisine.html.twig', array('cuisine' => $cuisine, 'restaurants' => $cuisine->getRestaurants()));
    });

    return $app;
 ?>
