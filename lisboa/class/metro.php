<?php 

/* Get token using a POST request */

$clientId = 'UtennItiv7pxeLJUPVhrOnyqxFga';
$clientSecret = 'mJjvGOJeSp8ylfZgSNiWGg8Gw9Qa';
$tenantId = 'xxxx';
$urlAccessToken = "https://login.windows.net/$tenantId/oauth2/token";
$resource = 'https://api.metrolisboa.pt:8243/token';
$group = 'xxx';
$report ='xxx';

$ch = curl_init();

//curl_setopt($ch, CURLOPT_URL, $resource);

curl_setopt($ch, CURLOPT_POST, FALSE);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//'resource' => $resource,
'client_id' => $clientId,
'client_secret' => $clientSecret,
'grant_type' => 'client_credentials',
'Authorization: Basic VXRlbm5JdGl2N3B4ZUxKVVBWaHJPbnlxeEZnYTptSmp2R09KZVNwOHlsZlpnU05pV0dnOEd3OVFh',
"Content-Type: application/x-www-form-urlencoded" => $resource,
));

$data = curl_exec($ch);
var_dump($data);

curl_close($ch);

$data_obj = json_decode($data);
$access_token = $data_obj->{"access_token"};
$headers = array(
"Content-Type: application/json",
"Authorization: Bearer $access_token"
);


$url = "https://api.metrolisboa.pt:8243/estadoServicoML/1.0.1/tempoEspera/Estacao/todos";

$post_params = array(
'accessLevel' => 'View'
);

$payload = json_encode($post_params);

$ch2 = curl_init( $url );
curl_setopt( $ch2, CURLINFO_HEADER_OUT, true);
curl_setopt( $ch2, CURLOPT_POSTFIELDS, $payload);
curl_setopt( $ch2, CURLOPT_HTTPHEADER, $headers );
curl_setopt( $ch2, CURLOPT_RETURNTRANSFER, true);
curl_setopt( $ch2, CURLOPT_FAILONERROR, true);
$response = curl_exec($ch2);

if (curl_errno($ch2)) {
    $error_msg = curl_error($ch2);
}
echo $response;
curl_close($ch2);

if (isset($error_msg)) {
    echo $error_msg;
}

?>