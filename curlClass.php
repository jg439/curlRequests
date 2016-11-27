<?php
//To complete this assignment,
// you need to create a class that can make get and post requests using curl,
// which also includes error handling

    class curl{
    public $page;

    function httpGetException($object)
    {
      $ch = curl_init();

    curl_setopt($ch,CURLOPT_URL,$object);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

        $output=curl_exec($ch);

        if($output === false)
        {
            echo "Error Number:".curl_errno($ch)."<br>";
            echo "Error String:".curl_error($ch);
        }
        curl_close($ch);
        return $output;
    }

    function httpPost($url,$params)
    {
      $postData = '';
      //create name value pairs seperated by &
      foreach($params as $k => $v)
      {
        $postData .= $k . '='.$v.'&';
      }
      $postData = rtrim($postData, '&');

      $ch = curl_init();

      curl_setopt($ch,CURLOPT_URL,$url);
      curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
      curl_setopt($ch,CURLOPT_HEADER, false);
      curl_setopt($ch, CURLOPT_POST, count($postData));
      curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

      $output=curl_exec($ch);

      if($output === false)
      {
          echo "Error Number:".curl_errno($ch)."<br>";
          echo "Error String:".curl_error($ch);
      }

      curl_close($ch);
      return $output;
    }

  }


$page = new curl;
$url = "http://hayageek.com/examples/php/curl-examples/post.php";

$page->httpGetException($url);


$page2 = new curl;
$params = array(
   "name" => "Julia Garcia",
   "age" => "20",
   "location" => "USA"
);

echo $page2->httpPost($url,$params);



?>
