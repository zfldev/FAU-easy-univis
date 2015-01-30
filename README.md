# FAU-easy-univis
Wordpress Shortcode for up-to-date Links to UnivIS entrys

Erstellt einen Wordpress-Shortcode [univis] welcher Links zu UnivIs-Einträgen der FAU immer auf dem aktuellen Stand hält.

## Wie geht das?
Dazu einfach den Teil im Link zum UnivIs-Eintrag hinter „sem=“ mit dem shortcode [univis] ersetzen.

## Beispiel
http://univis.uni-erlangen.de/form?__s=2&dsc=anew/tlecture&tdir=philos/ipii/laewst/allgem&anonymous=1&ref=tlecture&sem=2014w&__e=[univis]

## Was steckt dahinter?
Every univis Link of univis.fau.de is ending with an number which represent the todays day. For exampl the 10 of September 2013 is = 958, if this number is becoming older than 5 days an error message will appear
This function is calculating the univis-day before today, it shout be used in a link like this.


