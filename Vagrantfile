# Maquina virtual de Streama y API

Vagrant.configure("2") do |config|
  config.vm.define :firewall do |firewall|
	firewall.vm.box = "bento/centos-7.8"
	firewall.vm.network "public_network", bridge:"Realtek PCIe GBE Family Controller"
	firewall.vm.network :private_network, ip: "192.168.50.3"
	firewall.vm.provision "shell", path: "script_firewall.sh"
	firewall.vm.hostname = "firewall"
  end
  config.vm.define :servidorStreama do |servidorStreama|
    servidorStreama.vm.box = "bento/centos-7.8"
    servidorStreama.vm.network :private_network, ip: "192.168.50.4"
    servidorStreama.vm.provision "file", source: "apirest_mysql.py", destination: "/home/vagrant/apirest_mysql.py"
    servidorStreama.vm.provision "file", source: "init.sql", destination: "/home/vagrant/init.sql"
    servidorStreama.vm.provision "shell", path: "script_streama.sh"
    servidorStreama.vm.hostname = "servidorStreama"
  end
end
