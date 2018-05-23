# Gamstop
Package for Gamstop API for checking user's self-exclusion for online gambling.

## Installation
You can install the package through Composer.
```
composer require yaro/gamstop
```

## Usage
### Laravel:
Just put in your `services` config file 
```php
'gamstop' => [
    'key' => env('GAMSTOP_API_KEY'),
],
```
For Laravel <5.5 add in your `app` config
```php
'providers' => [
    Yaro\Gamstop\ServiceProvider::class,
    //...
];
'aliases' => [
    'Gamstop' => Yaro\Gamstop\Facade::class,
    //...
];
```


And use like:
```php
Gamstop::checkParams($firstName, $lastName, $dateOfBirth, $email, $postcode, $xTraceId);
```
or implement ```GamstopCheckableInterface``` interface in your model to pass the model.
```php
$user = User::first();
$isUserAllowedToPlay = Gamstop::check($user)->isAllowed();
```

### Other:
```php
$gamstop = new \Yaro\Gamstop\Gamstop\Api($apiKey);
$response = $gamstop->checkParams($firstName, $lastName, $dateOfBirth, $email, $postcode, $xTraceId);
var_dump($response->isBlocked());
```

You should catch all exceptions
```php
try {
    $response = Gamstop::check($user);
    // ...
} catch (\Yaro\Gamstop\ExceptionsMissingParametersException $e) {
    // if missing parameters
} catch (\Yaro\Gamstop\ExceptionsApiKeyInvalidException $e) {
    // if API key invalid or IP address not in range
} catch (\Yaro\Gamstop\ExceptionsNonPostCallException $e) {
    // for non-POST calls
} catch (\Yaro\Gamstop\ExceptionsRateLimitedException $e) {
    // if rate limited
} catch (\Yaro\Gamstop\NetworkingErrorException $e) {
    // in case of networking error (connection timeout, DNS errors, etc.)
}
```
catching this exception will catch any exception that can be thrown:
```php
try {
    $response = Gamstop::check($user);
    // ...
} catch (\Yaro\Gamstop\GamstopBaseException $e) {
  
}
```

## License
The MIT License (MIT). Please see [LICENSE](https://github.com/Cherry-Pie/Gamstop/blob/master/LICENSE) for more information.
