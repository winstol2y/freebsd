#!/usr/local/bin/ruby

require 'mysql'

begin
	con = Mysql.new 'localhost', 'admin', 'qwerty', 'dhcpd'
	write = con.query("SELECT * FROM ipv4")
	
	now = Time.now
	now1 = now.strftime("%Y%m%d")

	con.query("DELETE FROM ipv4 WHERE `expire` < curdate()")

	file = File.open('/usr/local/etc/dhcpd.conf', 'w') 
	file.puts('option domain-name "bkk.throughwave.com";') 
	file.puts('option domain-name-servers 192.168.178.10;')
	file.puts('lease-file-name "/var/db/dhcpd/dhcpd.leases";')
	file.puts('')
	file.puts('default-lease-time 36000;')
	file.puts('max-lease-time 43200;')
	file.puts('')
	file.puts('subnet 192.168.0.0 netmask 255.255.254.0 {')
	file.puts('	range 192.168.0.2 192.168.0.254;')
	file.puts('}')
	file.puts('')

	write.each_hash do |row|
		file.puts('host '+ row["name"] +' {')
		file.puts('hardware ethernet '+ row["hw"]+';')
		file.puts('fixed-address '+ row["name"]+'.'+row["zone"]+';')
		file.puts('}')
		file.puts('')
	end      
	file.close
	

	write = con.query("SELECT * FROM ipv4")	

	files = File.open('/usr/local/etc/namedb/dynamic/throughwave1.com', 'w')
	files.puts('$TTL 3600       ; 1 hour')
	files.puts('throughwave1.com.     IN SOA  ns1.throughwave1.com. admin.throughwave1.com. (')
	
	count = File.open("/usr/local/www/dhcp/count.txt", "r+")
		count.puts('0')
                a = count.gets.to_i
                if a < 10
			files.puts("                             #{now1}0#{a} ; serial")
                else
			files.puts("                             #{now1}#{a} ; serial")
                end
	count.close
	ff = File.open("/usr/local/www/dhcp/count.txt", "w")
	                ff.write(a += 1)
	ff.close

	files.puts('                             10800      ; refresh (3 hours)')
	files.puts('                             3600       ; retry (1 hour)')
	files.puts('                             604800     ; expire (1 week)')
	files.puts('                             300        ; minimum (5 minutes)')
	files.puts('                             )')
	files.puts('                     NS      ns1.throughwave1.com.')
	files.puts('')
	files.puts('$ORIGIN throughwave1.com.')
	files.puts('admin				A       192.168.0.1')
	files.puts('ns1				A       192.168.0.1')
	files.puts('localhost			A       127.0.0.1')
	
	write.each_hash do |rows|
	        files.puts(rows["name"]+'				A	' +rows["ip"])
	end

	files.close
	

rescue Mysql::Error => e
    puts e.errno
    puts e.error
    
ensure
    con.close if con
end
