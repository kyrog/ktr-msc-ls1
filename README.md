###clone project with the command line:

git clone git@github.com:kyrog/ktr-msc-ls1.git

then :

- cd /ktr-msc-ls1
- composer install

### create the database (mysql)

- php bin/console doctrine:database:create

### run the server 

php bin/console server:run 

then go to the URL (specified in the console) :

- http://127.0.0.1:8000