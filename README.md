# school-project

docker compose exec app php bin/console security:hash-password


docker compose exec app php bin/console doctrine:query:sql 'INSERT INTO user (email, roles, password) VALUES ("saberamine000@gmail.com", "[\"ROLE_USER\"]", "")'