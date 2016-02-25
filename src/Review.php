<?php
    class Review
    {
        private $reviewer_name;
        private $review_score;
        private $review_content;
        private $restaurant_id;
        private $id;

        function __construct($reviewer_name, $review_score, $review_content, $restaurant_id, $id = null)
        {
            $this->reviewer_name = $reviewer_name;
            $this->review_score = $review_score;
            $this->review_content = $review_content;
            $this->restaurant_id = $restaurant_id;
            $this->id = $id;
        }

        // function setRestName($new_reviewer_name)
        // {
        //     $this->reviewer_name = $new_reviewer_name;
        // }
        //
        // function setLocation($new_review_score)
        // {
        //     $this->review_score = $new_review_score;
        // }
        //
        // function setPriceRange($new_review_content)
        // {
        //     $this->review_content = $new_review_content;
        // }
        //
        // //is this doing what we want it to do?
        // function setCuisineId($new_restaurant_id)
        // {
        //     $this->restaurant_id = $new_restaurant_id;
        // }
        //
        // function getRestName()
        // {
        //     return $this->reviewer_name;
        // }
        //
        // function getLocation()
        // {
        //     return $this->review_score;
        // }
        //
        // function getPriceRange() {
        //     return $this->review_content;
        // }
        //
        // function getId() {
        //     return $this->id;
        // }
        //
        // function getCuisineId() {
        //     return $this->restaurant_id;
        // }
        //
        //
        // function save() //saves to database CHOMP
        // {
        //     $GLOBALS['DB']->exec("INSERT INTO restaurant (reviewer_name, review_score, review_content, restaurant_id) VALUES ('{$this->getRestName()}', '{$this->getLocation()}', '{$this->getPriceRange()}', {$this->getCuisineId()});");
        //     $this->id = $GLOBALS['DB']->lastInsertId();
        // }
        //
        // static function getAll()
        // {
        //     $returned_restaurants = $GLOBALS['DB']->query("SELECT * FROM restaurant;");
        //     $restaurants = [];
        //
        //     foreach ($returned_restaurants as $restaurant) {
        //         $reviewer_name = $restaurant['reviewer_name'];
        //         $id = $restaurant['id']; //?
        //         $review_score = $restaurant['review_score'];
        //         $review_content = $restaurant['review_content'];
        //         $restaurant_id = $restaurant['restaurant_id'];
        //         $new_restaurant = new Review($reviewer_name, $id, $review_score, $review_content, $restaurant_id);
        //         array_push($restaurants, $new_restaurant);
        //     }
        //     return $restaurants;
        // }
        //
        // function updateRestName($new_reviewer_name)
        // {
        //     $GLOBALS['DB']->exec("UPDATE restaurant SET reviewer_name = '{$new_reviewer_name}' WHERE id = {$this->getId()};");
        //     $this->setRestName($new_reviewer_name);
        // }
        //
        // function updatePriceRange($new_review_content)
        // {
        //     $GLOBALS['DB']->exec("UPDATE restaurant SET review_content = '{$new_review_content}' WHERE id = {$this->getId()};");
        //     $this->setPriceRange($new_review_content);
        // }
        //
        // function updateLocation($new_review_score)
        // {
        //     $GLOBALS['DB']->exec("UPDATE restaurant SET review_score = '{$new_review_score}' WHERE id = {$this->getId()};");
        //     $this->setLocation($new_review_score);
        // }
        //
        // static function find($search_id)
        // {
        //     $found_restaurant = null;
        //     $restaurants = Review::getAll();
        //
        //     foreach ($restaurants as $restaurant) {
        //         if ($restaurant->getId() == $search_id) {
        //             $found_restaurant = $restaurant;
        //         }
        //     }
        //     return $found_restaurant;
        // }
        //
        // static function deleteAll(){
        //     $GLOBALS['DB']->exec("DELETE FROM restaurant");
        // }
        //
        // function deleteOneReview()
        // {
        //     $GLOBALS['DB']->exec("DELETE FROM restaurant WHERE id = {$this->getId()};");
        // }
    }

?>
