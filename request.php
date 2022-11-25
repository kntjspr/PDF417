<?php
$query = htmlspecialchars($_GET["zip"]);

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://tools.usps.com/tools/app/ziplookup/cityByZip',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => ('zip=' . $query),
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/x-www-form-urlencoded',
    'Cookie: TLTSID=5dcd50f5a376160f8b0400e0ed96a2ca; NSC_uppmt-usvf-ofx=ffffffff3b2237bf45525d5f4f58455e445a4a4212d3'
  ),
));

$response = curl_exec($curl);

curl_close($curl);

$stageOne = preg_replace('/.+?(?=defaultCity":")/', '', $response);
$stageTwo = preg_replace('/defaultCity":"/', '', $stageOne);
    $arr = preg_match('/.+?(?=",")/', $stageTwo, $matches);

$arrStr = json_encode($matches);
echo trim($arrStr, '[""]'); // print trimmed string



?>
