## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```bash
php composer.phar require --prefer-dist hex-abyss/duplicate "*"
```

or add

```json
"hex-abyss/duplicate": "*"
```

to the require section of your `composer.json` file.

## Usage

```php
while(true){
    //some code
    if (\hexAbyss\Duplicate::isStopProcess())
        break;
}
```

```php
while(true){
    //some code
    \hexAbyss\Duplicate::isExit();
}
```

```php
//file: index.php
while(true){
    //some code
    if (\hexAbyss\Duplicate::isStopProcess())
        break;
}

//file: info.php
\hexAbyss\Duplicate::getInstance('keyInfo');
while(true){
    //some code
    if (\hexAbyss\Duplicate::isStopProcess())
        break;
}
```

## License

The source code for the site is licensed under the MIT license, which you can find in
the MIT-LICENSE.md file.
