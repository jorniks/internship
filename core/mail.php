

<?
    function sendMail($senderName, $senderEmail, $mailSubject, $receiverEmail, $message) {
        $from = new SendGrid\Email($senderName, $senderEmail);
        $subject = $mailSubject;
        $to = new SendGrid\Email(null, $receiverEmail);
        $content = new SendGrid\Content("text/plain", $message);
        $mail = new SendGrid\Mail($from, $subject, $to, $content);

        $apiKey = 'YOUR_API_KEY';
        $sg = new \SendGrid($apiKey);

        if ($sg->client->mail()->send()->post($mail)) {
            return true;
        } else {
            return false;
        }
    }
?>