
Vagrant.configure(2) do |config|

  # Specify the base box
  config.vm.box = "ubuntu/trusty64"

  # Setup port forwarding
  config.vm.network "forwarded_port", guest: 80, host: 8080, auto_correct: true

  # Setup network
  config.vm.network "private_network", ip: "192.168.33.11"

  # Setup synced folder
    config.vm.synced_folder "./", "/var/www/html/app", group: "www-data", owner: "vagrant", :mount_options => ['dmode=775', 'fmode=775']
    config.vm.synced_folder "vagrant/apache2/", "/etc/apache2/sites-enabled", group: "root", owner: "vagrant", :mount_options => ['dmode=775', 'fmode=775']


  # CUSTOMIZATION
   config.vm.provider "virtualbox" do |vb|

     vb.name = "devspace"
  
     # Customize the amount of memory on the VM:
     vb.memory = "1024"
     vb.cpus = 1
   end


  # PROVISION
  # config.vm.provision :shell, path: “vagrant/bootstrap.sh"
   # Shell provisioning
    config.vm.provision "shell" do |s|
      s.path = "vagrant/bootstrap.sh"
    end
  
end
