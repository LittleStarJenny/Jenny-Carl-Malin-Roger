<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../config/conn.php';
  include_once '../classes/class.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connection();

  $review = new Reviews($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $review->revId = $data->revId;
  $review->reviewText = $data->reviewText;
  $review->reviewScore = $data->reviewScore;
  $review->reviewDate = $data->reviewDate;
  $review->reviewAuthor = $data->reviewAuthor;

  // Update author
  if($review->updateReview()) {
    echo json_encode(
      array('message' => 'Review Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'Review Not Updated')
    );
  }
