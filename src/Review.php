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

        function getReviewerName()
        {
            return $this->reviewer_name;
        }

        function getReviewScore()
        {
            return $this->review_score;
        }

        function getReviewContent() {
            return $this->review_content;
        }

        function getId() {
            return $this->id;
        }

        function getRestaurantId() {
            return $this->restaurant_id;
        }


        function save() //saves to database CHOMP
        {
            $GLOBALS['DB']->exec("INSERT INTO review (reviewer_name, review_score, review_content, restaurant_id) VALUES ('{$this->getReviewerName()}', '{$this->getReviewScore()}', '{$this->getReviewContent()}', {$this->getRestaurantId()});");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }
        //
        static function getAll()
        {
            $returned_reviews = $GLOBALS['DB']->query("SELECT * FROM review;");
            $reviews = [];

            foreach ($returned_reviews as $review) {
                $reviewer_name = $review['reviewer_name'];
                $id = $review['id']; //?
                $review_score = $review['review_score'];
                $review_content = $review['review_content'];
                $restaurant_id = $review['restaurant_id'];
                $new_review = new Review($reviewer_name, $review_score, $review_content, $restaurant_id, $id);
                array_push($reviews, $new_review);
            }
            return $reviews;
        }
        //
        // function updateRestName($new_reviewer_name)
        // {
        //     $GLOBALS['DB']->exec("UPDATE review SET reviewer_name = '{$new_reviewer_name}' WHERE id = {$this->getId()};");
        //     $this->setRestName($new_reviewer_name);
        // }
        //
        // function updatePriceRange($new_review_content)
        // {
        //     $GLOBALS['DB']->exec("UPDATE review SET review_content = '{$new_review_content}' WHERE id = {$this->getId()};");
        //     $this->setPriceRange($new_review_content);
        // }
        //
        // function updateLocation($new_review_score)
        // {
        //     $GLOBALS['DB']->exec("UPDATE review SET review_score = '{$new_review_score}' WHERE id = {$this->getId()};");
        //     $this->setLocation($new_review_score);
        // }
        //
        // static function find($search_id)
        // {
        //     $found_review = null;
        //     $reviews = Review::getAll();
        //
        //     foreach ($reviews as $review) {
        //         if ($review->getId() == $search_id) {
        //             $found_review = $review;
        //         }
        //     }
        //     return $found_review;
        // }
        //
        static function deleteAll(){
            $GLOBALS['DB']->exec("DELETE FROM review");
        }
        //
        // function deleteOneReview()
        // {
        //     $GLOBALS['DB']->exec("DELETE FROM review WHERE id = {$this->getId()};");
        // }
    }

?>
