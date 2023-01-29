<?php

class Bills
{
    // class to handle bills related actions

  public function getBills(
    $user_id, // user id of the user
    $bill_id // bill id of the bill
    )
  {
    // function to retrieve a specific bill based on the bill id
    // and user id

    return callAPI(
      BILLPLZ_API_URL . 'v3/bills/' . $bill_id, // concatenate the billplz api url and bill id to form the endpoint
      'GET',
    [
      'email' => $_SESSION['user']['email'], // pass the user email from session
      'bill_id' => $bill_id, // pass the bill id

    ],
    [
      'Content-Type: application/json', // set the content type as json
      'Authorization: Basic ' . base64_encode(BILLPLZ_API_KEY . ':') // pass the api key in the authorization header
    ]
    );
  }
}