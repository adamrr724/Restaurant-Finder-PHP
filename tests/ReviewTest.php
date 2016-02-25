<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Restaurant.php";
    require_once "src/Cuisine.php";
    require_once "src/Review.php";

    $server = 'mysql:host=localhost;dbname=chomp_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    class ReviewTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Cuisine::deleteAll();
            Restaurant::deleteAll();
            Review::deleteAll();
        }

        function test_getReviewerName()
        {
            $reviewer_name = "Adam";
            $id = 1;
            $review_score = 4;
            $review_content = "This place was great!";
            $restaurant_id = 1;

            $test_review = new Review($reviewer_name, $review_score, $review_content, $restaurant_id, $id);

            //Act
            $result = $test_review->getReviewerName();

            //Assert
            $this->assertEquals($reviewer_name, $result);
        }

        function test_save()
        {
            //Arrange
            $reviewer_name = "Adam";
            $id = 1;
            $review_score = 4;
            $review_content = "This place was great!";
            $restaurant_id = 1;

            $test_review = new Review($reviewer_name, $review_score, $review_content, $restaurant_id, $id);

            $test_review->save();

            //Act
            $result = Review::getAll();

            //Assert
            $this->assertEquals($test_review, $result[0]);
        }


        function test_getAll()
        {
            //Arrange
            $id = null;
            $reviewer_name = "Adam";
            $review_score = 4;
            $review_content = "This place was great!";
            $restaurant_id = 1;

            $test_review = new Review($reviewer_name, $review_score, $review_content, $restaurant_id, $id);

            $test_review->save();

            $reviewer_name2 = "Pete";
            $review_score2 = 3;
            $review_content2 = "SO EXPENSIVE";
            $restaurant_id = 1;

            $test_review2 = new Review($reviewer_name2, $review_score2, $review_content2, $restaurant_id, $id);

            $test_review2->save();

            //Act
            $result = Review::getAll();

            //Assert
            $this->assertEquals([$test_review, $test_review2], $result);
        }

        function test_find()
        {
            //Arrange
            $id = null;
            $reviewer_name = "Adam";
            $review_score = 4;
            $review_content = "This place was great!";
            $restaurant_id = 1;

            $test_review = new Review($reviewer_name, $review_score, $review_content, $restaurant_id, $id);

            $test_review->save();

            $reviewer_name2 = "Pete";
            $review_score2 = 3;
            $review_content2 = "SO EXPENSIVE";
            $restaurant_id = 1;

            $test_review2 = new Review($reviewer_name2, $review_score2, $review_content2, $restaurant_id, $id);

            $test_review2->save();

            //Act
            $result = Review::find($test_review2->getId());

            //Assert
            $this->assertEquals($test_review2, $result);

        }
    }

?>
