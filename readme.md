(1)create Database with name kindhub
(2)Download and install composer. after that go to the advanced system settings and set Environment Variables for composer
(3)Go to the inside project folder and open Terminal and Run following command to composer update
   "composer update"
 (4)Go to the inside project folder and open Terminal and Run following command
    "npm install"
(5)set DB_DATABASE,DB_USERNAME,DB_PASSWORD fields in .env file
(6)Run "php artisan key:generate" command
(7)Run following command to get Database table to Your Database
   "php artisan migrate"
(8)now you can create the user and login into system
