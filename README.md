# Getting a vacation recommendation

This script allows you to get a vacation recommendation using boredapi.com and send it either to the console or to a file.

## Instructions

1. First, bow the repository.
2. Go to the project directory.
3. Run the script:

php recommendation.php participants type sender

1. Participants - number of participants (from 0 to 8).
2. Type - type of rest according to the API documentation.
3. Sender - the method of sending the message ("file" or "console").

Proven parameters that will accurately display the information, and not an error in the form of "Failed to fetch activity" => php recommendation.php 5 music file
