#!/usr/local/bin/ruby
require "erb"
require "mysql"
class Dhcp_header
        def initialize domain_name, domain_name_server, default, max, ip_address, netmask, range_subnet
                @domain_name = domain_name
                @domain_name_server = domain_name_server
                @default = default
                @max = max
                @ip_address = ip_address
                @netmask = netmask
                @range_subnet = range_subnet
        end
        def render path
                content = File.read(File.expand_path(path))
                t = ERB.new(content,nil,'%<>-')
                t.result(binding)
        end
end
class Dns_header
	def initialize zone, date_now, count_serial, refresh, retry1, expire, minimum
		@zone = zone
		@date_now = date_now
		@count_serial = count_serial
		@refresh = refresh
		@retry1 = retry1
		@expire = expire
		@minimum = minimum
	end
	def render path
		content = File.read(File.expand_path(path))
		t = ERB.new(content,nil,'%<>-')
		t.result(binding)
	end
end

	domain_name1 = "bkk.throughwave.com"
	insert_dhcp = Dhcp_header.new(domain_name1,"192.168.178.10","36000","36000","192.168.0.0","255.255.254.0","192.168.0.4 192.168.1.254")

	con = Mysql.new 'localhost', 'admin', 'qwerty', 'dhcpd'
	zone_union = con.query("SELECT zone FROM ipv4 UNION SELECT zone FROM ipv4")
	file_config_dhcp = "/usr/local/etc/dhcpd.conf"
	file_dhcp = File.open(file_config_dhcp, 'w') 
	file_dhcp.puts insert_dhcp.render("template_dhcp.erb")
	file_dhcp.close

	count = File.open("/usr/local/www/dhcp/count.txt", "r")
	count_serial = count.gets.to_i
	count_serial1 = sprintf('%02d',count_serial)
	date_now = Time.now.strftime("%Y%m%d")
	zone_union.each_hash do |rows|
		file_config_dns = "/usr/local/etc/namedb/dynamic/#{rows['zone']}"
		zone1 = rows['zone']
		file_dns = File.open(file_config_dns, 'w')
		insert_dns_head = Dns_header.new(zone1, date_now, count_serial1, "10800", "3600", "604800", "300")
		file_dns.puts insert_dns_head.render("template_dns.erb")
		$data_dns = con.query("SELECT * FROM ipv4 WHERE ipv4.`zone` = '#{rows["zone"]}'")
		file_dns.close
	end
	count1 = File.open("/usr/local/www/dhcp/count.txt", "w")
	count1.write(count_serial += 1)
	count.close
	count1.close

	
