# Prime Auto Care Loyaltye Management App

Membership Management ApplicationProgrammes

### Installation
Clone the repo from git
```
    git@github.com:arifulhb/pacapp.git
```


Boot the Vagrant machine from the `pacapp` root directory.
```
    vagrant up
```
Once the vagrant is booted, add this line in your hostfile.

Host file for mac is in `/etc/hosts`

```
192.168.33.11   pacapp.local
```

#### Prepare Database

Login to your database based on given info bellow. create a database with `pacapp_dev` name. Import the database schema.  Contact developer for database schema.

#### Access the site in browser.

http://pacapp.local

# Vagrant Information

DevSpace Vagrant is a simple __Ubuntu Trusty64__ vagrant configuration for LAMP stack developers which also includes many related modern development tools.


## Overview
This vagrant use [ubuntu/trusty64](https://atlas.hashicorp.com/ubuntu/boxes/trusty64) from [Atlas Vagrant Box](https://atlas.hashicorp.com/boxes/search?utm_source=vagrantcloud.com&vagrantcloud=1).
  On your 'vagrant up' command, this vagrantfile will automatically download the box. Vagrant folder here contain a `bootstrap.sh` file which provision the vagrant box.
  
  You need to place your projects in `projects` directory. This directory is synced with `/var/www/html` directory in the virtual machine. 
  This project folder also contain a `config` folder which is used during the provisioning. 

This vagrant box is configured to use '1024mb' of RAM and 1 Cpu. You can change ths configuration from Vagrantfile.
 
### Included packages

- Ubuntu Trusty64 (64-Bit)
- Apache 2
- PHP _v5.6.7_ with mysql, mcrypt, memcached, memcache, sqlite, xmlrpc, geoip gd, php5-fpm, php5-common
- MySQL _v5.5.41_
- Git _v1.9.1_
- Node _v0.10.38_
- Composer _v1.0.0-alpha9_
- NPM _v1.4.28_

#### Included Dependencies
The following dependencies are installed using apt-get as they are required to install and build other modules:

- cURL
- python-software-properties
- build-essential
- libev-dev
 

### Requirements
You must have [Vagrant](http://vagrantup.com) and [VirtualBox](https://www.virtualbox.org) installed in your pc.


## Default Credentials
These are credentials setup by default.
 
#### SSH
- Username: vagrant
- Password: vagrant
- Port: 22

#### MySQL Credentials
- Username: root
- Password: root
- Host: localhost
- Port: 3306
 
#### Disclaimer
This vagrantfile and provision is only tested in Mac.