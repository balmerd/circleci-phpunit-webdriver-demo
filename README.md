# circle-ci-phpunit-webdriver-demo
Minimum code needed to run Selenium WebDriver tests using PHPUnit with CircleCI 2.0.

https://circleci.com/gh/balmerd/circleci-phpunit-webdriver-demo

## Steps for local testing

* Download Selenium server
```
curl -O http://selenium-release.storage.googleapis.com/3.5/selenium-server-standalone-3.5.3.jar
```

* Download chromedriver
```
https://sites.google.com/a/chromium.org/chromedriver/downloads
```

* Download Composer (PHP package manager)
```
https://getcomposer.org/download
```

* Install phpunit and facebook/webdriver using Composer (from composer.json)
```
php composer.phar install
```

* Run Selenium server
```
java -jar selenium-server-standalone-3.5.3.jar -port 4444
```

* Update tests/WebDriverTest.php to change $host from:
```
http://selenium-server:4444/wd/hub
```
to:
```
http://localhost:4444/wd/hub
```

* Run unit tests
```
vendor/bin/phpunit --testdox
```

## Debugging

* Validate your .circleci/config.yml file
```
https://circleci.com/docs/2.0/local-cli/#validate-a-build-config
```
