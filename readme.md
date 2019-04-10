# Le petit Foudie Project

### lepetitfoudie.com

lepetitfoudie.com is a Single Page Application (SPA) for amateur home cooks to store their recipes and explore other's.

As of now the functionalities include:

-   Authentification
-   Create/Read/Update/Delete recipes
-   Filter recipes by categories

Future additions include:

-   Search
-   Scores
-   Leaderboard
-   Sharing
-   Improved authentification
-   Loading screens and other feedbacks from the backend

### Technologies

-   Laravel

The project is organized with laravel 5.8 folder structure.

As of Laravel's functionalities, they are used mainly for the backend, in order to query the database with API routes (/routes/api.php) and controllers (/app/Http/Controllers).
The database is a MySQL database (/database.sql)

https://laravel.com/docs/5.8/

-   Vue.js

The frontend javascript framework used in this project is Vue.js. Axios is used to call APIs in the backend.
This is usually the prefered frontend framework for Laravel developers as it is available out of the box.
Using Vue.js introduced difficulties with authentification since it is an SPA, so JSON Web Tokens (JWTs) are used for user auth.

https://vuejs.org/

-   Element UI

Element UI is a UI component library for javascript frontend frameworks.

https://element.eleme.io/#/en-US
