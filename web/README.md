# Reaching Hands: Web App

Welcome to the README.md for the web application. So here you can understand the structure of the app and the technologies leveraged.

## File Structure

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

```
ROOT
1. users                          #contains all the different users with respective functionalities
 1.1 accountant                   #contains all the functionalities for accountant type user
 1.2 admin                        #contains all the functionalities for admin type user
 1.3 font-awesome                 #directory for font-awesome assets
 1.4 volunteer                    #contains all the functionalities for volunteer type user
 1.5 warden                       #contains all the functionalities for warden type user
 1.6 config.php                   #the connections with the database
 1.7 index.php                    #forms the basic layout of the apps for other layers to build upon
 1.8 indexstyle.scss              #stylesheet meant for cross project (except the login)
 1.9 login.php                    #brings up the login layer as the first screen
 1.10 loginstyle.scss             #stylesheet meant for the login)
 1.11 validate.php                #maintains the routing for the different types of users
2. config.php                     #the connections with the database for the ROOT
3. index.php                      #the first page which loads up all the necessary documents
4. README.md
5. style.css                      #stylesheet meant for the ROOT
```

### Prerequisites

A healthy Wamp or Xampp server running, with services like - Apache, MySQL and PHP switched on.

## Built With

* [PHP](http://php.net/manual/en/intro-whatis.php)
* [SCSS](http://sass-lang.com/documentation/file.SCSS_FOR_SASS_USERS.html)
* [MySQL](https://www.mysql.com/)

## Authors

* **Karan Uppal** - *Initial work* - [freezethinker](https://github.com/freezethinker)

See also the list of [contributors](https://github.com/your/project/contributors) who participated in this project.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

## Acknowledgments

* Srinivas, CFG Team Mentor
* Ramesh, CFG Team Mentor
