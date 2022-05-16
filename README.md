# Activity Book

> Activity Book is activity tracking addon that tracks all changes made by the users of Control Panel. 

> This addon stores the activity log to the database configured next to the project. Which makes it perfect solution to the Kubernetes/Docker architecture.

## Features

This addon does:

- Stores user changes to Control Panel
- Saves the data to Database using Eloquent Driver
- Has beautiful UI to display the changes
- Supports search functionality 

## How to Install

You can search for this addon in the `Tools > Addons` section of the Statamic control panel and click **install**, or run the following command from your project root:

``` bash
composer require markkravchuk/statamic-activity-book
```

Add ```ACTIVITY_BOOK_ENABLED=true``` in your ```.env``` file.

## How to Use

After the Addon is installed, please run 
``` bash
php artisan vendor:publish --tag="activity-book-config"
```

This command would generate the configuration file in ```/config/activity-logger.php```

And the migration file would be added to ```database/migration/``` folder, where the administrator can run the actual 
migration to create corresponding Database remote log storage place.

Please run the last command to run the migration

``` bash
php artisan migrate
```