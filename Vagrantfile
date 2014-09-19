#!/bin/ruby

project_name = File.basename(Dir.getwd);

public_directory = "./public"

if !File.directory?(public_directory)
  public_directory = "./web"
end

Vagrant.configure("2") do |config|
  config.vm.define :web do | web |
    web.vm.box = "precise64"
    web.vm.box_url = "http://files.vagrantup.com/precise64.box"

    web.vm.network :private_network, ip: "33.33.33.100"
    web.ssh.forward_agent = true

    web.vm.hostname = project_name

    web.vm.provider :virtualbox do |v|
      v.customize ["modifyvm", :id, "--natdnshostresolver1", "on"]
      v.customize ["modifyvm", :id, "--memory", 512]
      v.customize ["modifyvm", :id, "--name", project_name]
    end

    nfs_setting = RUBY_PLATFORM =~ /darwin/ || RUBY_PLATFORM =~ /linux/
    web.vm.synced_folder "./", "/vagrant", id: "vagrant-root" , :nfs => nfs_setting

    web.vm.provision :shell do |shell|
      shell.path = "vagrant/web/bootstrap.sh"
      shell.args = [project_name]
    end

    web.vm.provision :puppet do |puppet|
      puppet.manifests_path = "vagrant/web/manifests"
      puppet.options = ['--verbose']
      puppet.facter = {
        "public_directory" => "/var/www/" + project_name + "/" + File.basename(public_directory)
      }
    end

  end
end
