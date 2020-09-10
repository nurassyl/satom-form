# SatomForm


### Requirements:

- PHP v7.3
  - PHP extensions:
    - mbstring
    - dom (for unittest), in development mode
- GraphViz (for generating phpdoc), in development mode

---

Test

```bash
./vendor/bin/phpunit --testdox tests
```


Generate docs

```bash
./vendor/bin/phpdoc -f ./Form.php -d ./validators/ -t ./docs/api
```
