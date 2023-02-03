<form method="post" action="send_notification.php">
    Title<input type="text" name="title">
    Message<input type="text" name="message">
    <!--Icon path<input type="text" name="icon">-->
    Token<input type="text" name="token">
    <input type="submit" value="Send notification">
</form>

<?php
function sendNotification()
{
    $url ="https://fcm.googleapis.com/fcm/send";

    $fields=array(
        "to"=>$_REQUEST['token'],
        "notification"=>array(
            "body"=>$_REQUEST['message'],
            "title"=>$_REQUEST['title'],
            "icon"=>$_REQUEST['icon'],
            "click_action"=>"https://shinerweb.com"
        )
    );

    $headers=array(
        'Authorization: key=AAAAoKRddas:APA91bELGZ1TH2-tBuDRf7fPAu1D9MfCMgbJCMxb1pTTLSGWJ_HiEUJBXUwC0FvnofE-ceCdmcASolztZWzLsRZXSbZVIyKMqM3Yx6RYTRPFLbDl9nLX0OcmHmxu0HDkp00-Y92mXqL3',
        'Content-Type:application/json'
    );

    $ch=curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    $result=curl_exec($ch);
    print_r($result);
    curl_close($ch);
}
sendNotification();