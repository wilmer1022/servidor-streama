#!/bin/bash

# Install vim and wget
sudo yum install deltarpm -y
sudo yum update -y -y
sudo yum upgrade
sudo yum install wget -y
sudo yum install vim -y

# Install streama
wget --no-cookies --no-check-certificate --header "Cookie:oraclelicense=accept-securebackup-cookie" "http://download.oracle.com/otn-pub/java/jdk/8u131-b11/d54c1d3a095b4ff2b6607d096fa80163/jdk-8u131-linux-x64.rpm"
sudo yum -y localinstall jdk-8u131-linux-x64.rpm
wget https://github.com/dularion/streama/releases/download/v1.1/streama-1.1.war
sudo mkdir /opt/streama
sudo mv streama-1.1.war /opt/streama/streama.war
sudo mkdir /opt/streama/media
sudo chmod 664 /opt/streama/media
sudo echo '[Unit]
Description=Streama Server
After=syslog.target
After=network.target
[Service]
User=root
Type=simple
ExecStart=/bin/java -jar /opt/streama/streama.war
Restart=always
StandardOutput=syslog
StandardError=syslog
SyslogIdentifier=Streama
[Install]
WantedBy=multi-user.target' >> /etc/systemd/system/streama.service

# Instal Flask
sudo yum install -y epel-release
sudo yum install python3-pip -y -y
pip3 install Flask

# Install httpd
sudo yum install httpd -y
sudo echo '<VirtualHost *:80>
    ServerName streama.servidorStreama.com
    ServerAdmin guarind@gmail.com
    DocumentRoot /var/www/html/index.html
    TransferLog /var/log/httpd/streama.yourdomain.com_access.log
    ErrorLog /var/log/httpd/streama.yourdomain.com_error.log
</VirtualHost>' >> /etc/httpd/conf.d/streama.servidorStreama.com.conf
sudo echo '<html>
	<head>
		<title></title>
	</head>
	<body>
		<h1>Page with streama</h1>
	</body>
</html>' >> /var/www/html/index.html

# Install MySQL
wget http://repo.mysql.com/mysql-community-release-el7-5.noarch.rpm
sudo rpm -ivh mysql-community-release-el7-5.noarch.rpm
sudo yum install mysql-server -y
sudo yum install mysql-devel -y
sudo yum install gcc -y
sudo yum install python3-devel -y
pip3 install flask-mysqldb
sudo systemctl start mysqld

# Create and fill Database
sudo mysql -h localhost -u root  < /home/vagrant/init.sql

# Run services
sudo setenforce 0
sudo systemctl start httpd
sudo systemctl start streama