# loggable


Loggable is a Laravel 5 package which helps users to keep simple log of their model CRUD operations. .

## Installation

``` bash
$ composer require tectiv3/loggable
```

* Add the service provider to the providers array in app.php
``` bash
tectiv3\Loggable\ServiceProvider::class

//Then do vendor:publish from the artisan command to copy the migration file and run migrate command
php artisan vendor:publish --provider="tectiv3\Loggable\ServiceProvider"
php artisan migrate
```

## Usage

``` php
//use Loggable in any of your models whose CRUD logs you want to keep
use tectiv3\Loggable\Loggable;
class DemoModel extends \Eloquent {
    use Loggable;
}

//for all logs loop through \tectiv3\Loggable\Log::all() or filter it however you like

//for model specific logs you can call $model->logs to get model specific logs

//then inside the loop you can access the user with ->user property

foreach($model->logs as $log){
    echo $log->entity . ' || ' . $log->action;
    echo '<br>';
    echo 'By :'.$log->user->name.' at '.$log->created_at;
}
```

## Credits

- [tectiv3](https://github.com/tectiv3)
- [themightysapien](https://github.com/themightysapien)

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
