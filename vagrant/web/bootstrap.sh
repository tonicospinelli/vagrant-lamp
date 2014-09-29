#!/bin/bash
#
set -x
sudo apt-get update
mkdir -p /etc/puppet/modules

hostname $1
if [[ ! 'grep '$1' /etc/hosts' ]];then
    echo "\n127.0.0.1\t$1\n" >> /etc/hosts
fi

puppet module install example42/puppi --version 2.1.7 --force
puppet module install example42/apache --version 2.1.4 --force
puppet module install puppetlabs/stdlib --version 4.1.0 --force
puppet module install puppetlabs/apt --version 1.4.0 --force
puppet module install example42/php --version 2.0.18 --force
puppet module install puppetlabs/mysql --version 2.2.3 --force
puppet module install willdurand/composer --version 0.0.6 --force
puppet module install maestrodev/wget --version 1.2.3 --force
