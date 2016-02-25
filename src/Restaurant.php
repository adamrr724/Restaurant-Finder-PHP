<?php
    class Restaurant
    {
        private $rest_name;
        private $id;
        private $location;
        private $price_range;
        private $cuisine_id;

        function __construct($rest_name, $id = null, $location, $price_range, $cuisine_id)
        {
            $this->rest_name = $rest_name;
            $this->id = $id;
            $this->location = $location;
            $this->price_range = $price_range;
            $this->cuisine_id = $cuisine_id;
        }

        function setRestName($new_rest_name)
        {
            $this->rest_name = $new_rest_name;
        }

        function setLocation($new_location)
        {
            $this->location = $new_location;
        }

        function setPriceRange($new_price_range)
        {
            $this->price_range = $new_price_range;
        }

        //is this doing what we want it to do?
        function setCuisineId($new_cuisine_id)
        {
            $this->cuisine_id = $new_cuisine_id;
        }

        function getRestName()
        {
            return $this->rest_name;
        }

        function getLocation()
        {
            return $this->location;
        }

        function getPriceRange() {
            return $this->price_range;
        }

        function getId() {
            return $this->id;
        }

        function getCuisineId() {
            return $this->cuisine_id;
        }


        function save() //saves to database CHOMP
        {
            $GLOBALS['DB']->exec("INSERT INTO restaurant (rest_name, location, price_range, cuisine_id) VALUES ('{$this->getRestName()}', '{$this->getLocation()}', '{$this->getPriceRange()}', {$this->getCuisineId()});");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_restaurants = $GLOBALS['DB']->query("SELECT * FROM restaurant;");
            $restaurants = [];

            foreach ($returned_restaurants as $restaurant) {
                $rest_name = $restaurant['rest_name'];
                $id = $restaurant['id']; //?
                $location = $restaurant['location'];
                $price_range = $restaurant['price_range'];
                $cuisine_id = $restaurant['cuisine_id'];
                $new_restaurant = new Restaurant($rest_name, $id, $location, $price_range, $cuisine_id);
                array_push($restaurants, $new_restaurant);
            }
            return $restaurants;
        }

        function updateRestName($new_rest_name)
        {
            $GLOBALS['DB']->exec("UPDATE restaurant SET rest_name = '{$new_rest_name}' WHERE id = {$this->getId()};");
            $this->setRestName($new_rest_name);
        }

        function updatePriceRange($new_price_range)
        {
            $GLOBALS['DB']->exec("UPDATE restaurant SET price_range = '{$new_price_range}' WHERE id = {$this->getId()};");
            $this->setPriceRange($new_price_range);
        }

        function updateLocation($new_location)
        {
            $GLOBALS['DB']->exec("UPDATE restaurant SET location = '{$new_location}' WHERE id = {$this->getId()};");
            $this->setLocation($new_location);
        }

        static function find($search_id)
        {
            $found_restaurant = null;
            $restaurants = Restaurant::getAll();

            foreach ($restaurants as $restaurant) {
                if ($restaurant->getId() == $search_id) {
                    $found_restaurant = $restaurant;
                }
            }
            return $found_restaurant;
        }

        function getReviews() {
            $reviews = [];
            $returned_reviews = $GLOBALS['DB']->query("SELECT * FROM review WHERE restaurant_id = {$this->getId()};");

            foreach($returned_reviews as $review)
            {
                $reviewer_name = $review['reviewer_name'];
                $id = $review['id'];
                $review_score = $review['review_score'];
                $review_content = $review['review_content'];
                $restaurant_id = $review['restaurant_id'];
                $new_review =  new Review($reviewer_name, $review_score, $review_content, $restaurant_id, $id);
                array_push($reviews, $new_review);
            }
            return $reviews;
        }

        static function deleteAll(){
            $GLOBALS['DB']->exec("DELETE FROM restaurant");
            $GLOBALS['DB']->exec("DELETE FROM review WHERE restaurant_id = {$this->getId()};");
        }

        function deleteOneRestaurant()
        {
            $GLOBALS['DB']->exec("DELETE FROM restaurant WHERE id = {$this->getId()};");
            $GLOBALS['DB']->exec("DELETE FROM review WHERE restaurant_id = {$this->getId()};");
        }
    }

?>
