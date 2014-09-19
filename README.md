Virtual Development Environment
==========================================

It gives a pratical and quickly up development environment. It will create a
environment based on current folder name.

The VM will provision a server with Apache + PHP 5.4 + MySQL

1. Install Vagrant and Virtual Box on your system
    see [vagrantup.com](http://docs.vagrantup.com/v2/getting-started/index.html)
	see [virtualbox.org](https://www.virtualbox.org/)

2. Clone this repo and rename target folder
	```bash
	git clone --branch=master git@github.com:tonicospinelli/vagrant-lamp.git my-path
	```

3. Change guest IP Address, if you want
	```ruby
	web.vm.network :private_network, ip: "33.33.33.100" # line 16
	```

4. Remember to include the hostname and ip address in local `/etc/hosts`:
	```bash
	sudo sh -c 'echo "\n33.33.33.100\t${PWD##*/}.dev ${PWD##*/}.test ${PWD##*/}.prod\n" >> /etc/hosts'
	```

5. Execute the command
	```bash
	vagrant up
	```

6. Go to browser and call [my-path.dev](http://my-path.dev/)