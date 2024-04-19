<?php

// Class to get advice from boredapi.com
class BoredAPI
{
    private $baseUrl = "http://www.boredapi.com/api/activity";

    // Method for giving advice
    public function getActivity($participants, $type)
    {
        $url = $this->baseUrl . "?participants=$participants&type=$type";
        $response = file_get_contents($url);
        return json_decode($response, true);
    }
}

// Class to send a message to
class MessageSender
{
    // Method for displaying a message in the console
    public function sendToConsole($message)
    {
        echo $message . "\n";
    }

    // Method for writing a message to a file
    public function sendToFile($message)
    {
        $timestamp = time(); 
        $formattedTime = date("H.i.s-d_m_Y", $timestamp); 
        $filename = "recommendation($formattedTime).txt";

        // Check for a directory and create it if it does not exist
        $dir = dirname($filename);
        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }

        file_put_contents($filename, $message);
    }

}

// The main logic of the script
if (isset($argv[1]) && isset($argv[2]) && isset($argv[3])) {
    $participants = intval($argv[1]);
    $type = $argv[2];
    $sender = $argv[3];

    if ($participants >= 0 && $participants <= 8 && in_array($type, ["education", "recreational", "social", "diy", "charity", "cooking", "relaxation", "music", "busywork"]) && in_array($sender, ["file", "console"])) {
        $api = new BoredAPI();
        $activity = $api->getActivity($participants, $type);

        if (isset($activity['activity'])) {
            $message = "Recommended activity: " . $activity['activity'];

            $messageSender = new MessageSender();
            if ($sender === "console") {
                $messageSender->sendToConsole($message);
            } else {
                $messageSender->sendToFile($message);
            }
        } else {
            echo "Failed to fetch activity\n";
        }
    } else {
        echo "Invalid input parameters\n";
    }
} else {
    echo "Usage: php recommendation.php <participants> <type> <sender>\n";
}