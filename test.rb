#!/usr/local/bin/ruby

f = File.open("/usr/local/www/dhcp/count.txt", "r")
		a = f.gets.to_i
		if a < 10
			puts "0#{a}"
		else
			puts a
		end
f.close
ff = File.open("/usr/local/www/dhcp/count.txt", "w")
		ff.write(a += 1)
ff.close
