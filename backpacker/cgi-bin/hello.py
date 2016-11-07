#! /usr/bin/python 

import sys
sys.path.append('/bs4')
sys.path.append('/mechanize')




#print "Content-type: text/html\n\n"

from urllib2 import urlopen
from bs4 import BeautifulSoup
import mechanize

br = mechanize.Browser()
# Cookie Jar
#cj = cookielib.LWPCookieJar()
#br.set_cookiejar(cj)

# Browser options
br.set_handle_equiv(True)
#br.set_handle_gzip(True)
br.set_handle_redirect(True)
br.set_handle_referer(True)
br.set_handle_robots(False)

# Follows refresh 0 but not hangs on refresh > 0
br.set_handle_refresh(mechanize._http.HTTPRefreshProcessor(), max_time=1)

# Want debugging messages?
#br.set_debug_http(True)
#br.set_debug_redirects(True)
#br.set_debug_responses(True)

br.addheaders = [('User-agent', 'Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.9.0.1) Gecko/2008071615 Fedora/3.0.1-1.fc9 Firefox/3.0.1')]

url='http://www.yelp.com/search?find_desc=Restaurants&find_loc=london'

loc=sys.argv[1]
url='https://www.zagat.com/'+loc
r = br.open(url)
print loc
soup=BeautifulSoup(br.response().read())

divs=soup.findAll("h3")
for div in divs:
    addr=div.find("a")
    if addr!=None :
        print addr
 
  