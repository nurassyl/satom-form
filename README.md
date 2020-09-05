# Satom form


### Requirements:

- PHP v7.3
  - PHP extensions:
    - mbstring
    - dom (for unittest)
- GraphViz (for generating phpdoc)

---

Test

```bash
./vendor/bin/phpunit --testdox tests
```


Generate docs

```bash
./vendor/bin/phpdoc -d ./forms/ -t ./docs/api
./vendor/bin/phpdoc -d ./validators/ -t ./docs/api
```
