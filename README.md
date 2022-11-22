Description

The "Knowledge" repository is a project intended to review all the knowledge acquired as well as to practice while continuing to deepen one's knowledge.

Steps
1. Clone the repo from Github.
2. Run composer install.
3. Create config/db.php from config/db.php.dist file and add your DB parameters. Don't delete the .dist file, it must be kept.
	define('APP_DB_HOST', 'your_db_host');
	define('APP_DB_NAME', 'your_db_name');
	define('APP_DB_USER', 'your_db_user_wich_is_not_root');
	define('APP_DB_PASSWORD', 'your_db_password');

4. Import database.sql in your SQL server, you can do it manually or use the migration.php script which will import a database.sql file.
5. Run the internal PHP webserver with php -S localhost:8000 -t public/. The option -t with public as parameter means your localhost will target the /public folder.
6. Go to localhost:8000 with your favorite browser.
7. From this starter kit, create your own web application.

Windows Users
If you develop on Windows, you should edit you git configuration to change your end of line rules with this command :
git config --global core.autocrlf true


