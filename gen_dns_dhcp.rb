#!/usr/local/bin/ruby
require 'mysql'
begin
	con = Mysql.new 'localhost', 'admin', 'qwerty', 'dhcpd'
	write = con.query("SELECT * FROM ipv4")

	file_config_dhcp = "/usr/local/etc/dhcpd.conf"
	file_dhcp = File.open(file_config_dhcp, 'w') 
	file_dhcp.puts('option domain-name "bkk.throughwave.com";') 
	file_dhcp.puts('option domain-name-servers 192.168.178.10;')
	file_dhcp.puts('lease-file-name "/var/db/dhcpd/dhcpd.leases";')
	file_dhcp.puts('')
	file_dhcp.puts('default-lease-time 36000;')
	file_dhcp.puts('max-lease-time 43200;')
	file_dhcp.puts('')
	file_dhcp.puts('subnet 192.168.0.0 netmask 255.255.254.0 {')
	file_dhcp.puts('	range 192.168.0.2 192.168.0.254;')
	file_dhcp.puts('}')
	file_dhcp.puts('')
	file_dhcp.close
	
	write.each_hash do |rows|

		file_config_dns = "/usr/local/etc/namedb/dynamic/#{rows["zone"]}"
	
		file_dns = File.open(file_config_dns, 'w')
	
		file_dns.puts('$TTL 3600       ; 1 hour')
		file_dns.puts("#{rows["zone"]}.     IN SOA  ns1.#{rows["zone"]}. admin.#{rows["zone"]}. (")
		now = Time.now.strftime("%Y%m%d")
		count = File.open("/usr/local/www/dhcp/count.txt", "r")
			a = count.gets.to_i
			file_dns.puts("				#{now}"+sprintf('%02d',count)+" ; serial") 
		count.close
		count_up = File.open("/usr/local/www/dhcp/count.txt", "w")
			count_up.write(a += 1)
		count_up.close
		file_dns.puts('				10800      ; refresh (3 hours)')
		file_dns.puts('				3600       ; retry (1 hour)')
		file_dns.puts('				604800     ; expire (1 week)')
		file_dns.puts('				300        ; minimum (5 minutes)')
		file_dns.puts('				)')
		file_dns.puts("                     NS      ns1.#{rows["zone"]}.")
		file_dns.puts("$ORIGIN #{rows["zone"]}.")
		file_dns.puts('admin				A       192.168.0.1')
		file_dns.puts('ns1				A       192.168.0.1')
		file_dns.puts('localhost			A       127.0.0.1')
	file_dns.close
	end

	write1 = con.query("SELECT * FROM ipv4")

	write1.each_hash do |row1|
		file_config_dhcp1 = "/usr/local/etc/dhcpd.conf"
		file_config_dns1 = "/usr/local/etc/namedb/dynamic/#{row1["zone"]}"

		file_dhcp1 = File.open(file_config_dhcp1, 'a+') 
		file_dns1 = File.open(file_config_dns1, 'a+') 

		file_dhcp1.puts('host '+ row1["name"] +' {')
		file_dhcp1.puts('hardware ethernet '+ row1["hw"]+';')
		file_dhcp1.puts('fixed-address '+row1["name"]+'.'+ row1["zone"]+';')
		file_dhcp1.puts('}')

		file_dns1.puts(row1["name"]+'				A	' +row1["ip"])

		file_dns1.close
		file_dhcp1.close
	end      

rescue Mysql::Error => e
    puts e.errno
    puts e.error
ensure
    con.close if con
end
