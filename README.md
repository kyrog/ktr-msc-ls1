###clone project with the command line:

git clone git@github.com:kyrog/ktr-msc-ls1.git

then :

- cd /ktr-msc-ls1
- composer install

### create the database (mysql)

- php bin/console doctrine:database:create

to create tables in the bd use command line :

- php bin/console doctrine:migrations:migrate


### run the server 

php bin/console server:run 

then go to the URL (specified in the console) :

- http://127.0.0.1:8000