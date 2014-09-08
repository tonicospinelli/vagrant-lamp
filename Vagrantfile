#!/bin/ruby

$projectName = File.basename(Dir.getwd);

Vagrant.configure("2") do |config|
  config.vm.define :web do | web |
    web.vm.box = "precise64"
    web.vm.box_url = "http://files.vagrantup.com/precise64.box"

    web.vm.network :private_network, ip: "33.33.33.100"
    web.ssh.forward_agent = true

    web.vm.hostname = $projectName

    web.vm.provider :virtualbox do |v|
      v.customize ["modifyvm", :id, "--natdnshostresolver1", "on"]
      v.customize ["modifyvm", :id, "--memory", 512]
      v.customize ["modifyvm", :id, "--name", $projectName]
    end

    nfs_setting = RUBY_PLATFORM =~ /darwin/ || RUBY_PLATFORM =~ /linux/
    web.vm.synced_folder "./", "/var/www/$projectName", id: "vagrant-root" , :nfs => nfs_setting

    web.vm.provision :shell do |shell|
      shell.path = "vagrant/web/bootstrap.sh"
      shell.args = [$projectName]
    end

    web.vm.provision :puppet do |puppet|
      puppet.manifests_path = "vagrant/web/manifests"
      puppet.options = ['--verbose']
    end

  end
end
