# school-project

#### l problems li kano 3ndkom

1. prob f namesapce fl controller (machi Api ==>API)
2. fichier .htacces manquait bach apache i router vers Symfony
3. Login prob => problem f routes

# mohim u can use this one to generete ur password (used for login)

docker compose exec app php bin/console security:hash-password

# so aprés dir password et le hash diro f commande bellow

docker compose exec app php bin/console doctrine:query:sql 'INSERT INTO user (email, roles, password) VALUES ("saberamine000@gmail.com", "[\"ROLE_USER\"]", "hna diri hash start jps form $")'
