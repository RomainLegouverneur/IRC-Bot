# PHP IRC-BOT (WildPHP)

### Standard Commands

* !say [#channel] [message] - Says message in the specified IRC channel.
* !say [username] [message] - Says message in the specified IRC user.
* !join [#channel] - Joins the specified channel.
* !part [#channel] - Parts the specified channel.
* !timeout [seconds] - Bot leaves for the specified number of seconds.
* !restart - Quits and restarts the script.
* !quit - Quits and stops the script.

### Entended Commands

* !ip - Returns IP of a user.
* !weather [location] - Returns weather data for location.
* !poke [#channel] [username] - Pokes the specified IRC user.
* !joke - Returns random joke. Fetched from [ICNDb.com](http://www.icndb.com/).
* !imdb [movie title] - Searches for movie and returns it's information.
* !php [text code] - Write and execute php code.
* !commands - Return all active commands

### Listeners

* Joins - Greets users when they join the channel.
* Youtube - Write description of youtube's video when they share a video 
 

### Config

Copy configuration file and customize its content.

    cp config.php config.local.php

Copy Upstart script to folder and make appropriate changes.

    sudo cp bin/phpbot404.conf /etc/init/

### Run

Run as PHP

    php phpbot404.php

or Upstart service

    start phpbot404

Restart

    restart phpbot404

Stop

    stop phpbot404


Just 4 Fun.
