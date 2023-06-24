# <img src="https://image.noelshack.com/fichiers/2023/25/2/1687261539-cloudhome.png" height="300" />
<p float="left">
    <img src="https://img.shields.io/static/v1?label=License&message=MIT&color=blue">
    <img src="https://img.shields.io/static/v1?label=Version&message=1.7.2&color=blue">
</p>

## Introduction

CloudHome is a cloud storage service for your home. It allows you to store files on your own server and access them from anywhere. It is similar to Dropbox, but it is self-hosted and open source.

## Features

* **Easy to use**: CloudHome is designed to be easy to use. It has a simple web interface and a command line client.

* **Secure**: CloudHome uses strong encryption to protect your files. It also uses HTTPS to protect your data in transit.

* **Private**: CloudHome is self-hosted. Your files are stored on your own server, not on a third-party server.

* **Open source**: CloudHome is open source software. You can read the source code and modify it if you want.

## Installation

CloudHome is written in PhP and uses MySQL as its database. It can be installed on any web server that supports Docker. It has been tested on Linux and Windows.

### Requirements

* Visual Studio Code
* Docker
* MySQL
* PHP

### Installation steps

1. Download the latest release from the [releases page](https://github.com/xTOUKAM/CloudHome)
2. Unzip the downloaded file
3. After your download open the folder in Visual Studio Code and run the command `docker-compose up`
4. In your MySQL database import the `panel.sql` file
5. Open the `index.php` file in your web browser
6. It's done! Create your account and start using CloudHome

If you want to get the administrator role, open your database, go to the panel and pass the value of your account from `0` to `1` in the `cli_admin column`

## License

CloudHome is licensed under the [MIT Licence](./LICENCE).

## Contact

If you have any questions or suggestions, send me an email at [My Email](mailto:houllegatte.tom@gmail.com).

## Donate

If you like this project, consider making a donation. Your donation will be used to make a better application.

* [Donate with PayPal](https://paypal.me/senoravalley?country.x=FR&locale.x=fr_FR)

## Credits

* [Line Icons](https://lineicons.com/)
* [PHPMailer](https://github.com/PHPMailer/PHPMailer)

## Author

* [Tom Houllegatte](https://github.com/xTOUKAM)

## Contributors

* [Enzo Djabali](https://github.com/enzodjabali)


