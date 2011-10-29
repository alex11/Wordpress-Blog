=== 2 Click Social Media Buttons ===
Contributors: ppfeufer
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=DC2AEJD2J66RE
Tags: twitter, facebook, googleplus, button, flattr
Requires at least: 3.0.1
Tested up to: WordPress 3.3-beta2
Stable tag: 0.13

Fügt die Buttons für Facebook-Like (Empfehlen), Twitter, Flattr und Googleplus dem deutschen Datenschutz entsprechend in euer WordPress ein.

== Description ==

Fügt die Buttons für Facebook-Like (Empfehlen), Twitter, Flattr und Googleplus dem deutschen Datenschutz entsprechend in euer WordPress ein.
Dies wird leider durch immer verwirrendere Datenschutzbestimmungen notwendig. Das Plugin ist eine WordPress-Adaption der Lösung von heise.de wie in ihrem Artikel [2 Klicks für mehr Datenschutz](http://www.heise.de/ct/artikel/2-Klicks-fuer-mehr-Datenschutz-1333879.html "2 Klicks für mehr Datenschutz auf heise online") beschrieben.
Bisher werden die Buttons einfach in den Einzelartikeln und -seiten unter dem Artikel eingebunden. Einige Einstellungsmöglichkeiten sind noch in Planung.

**Features**

* Einfache Installation.
* Einstellungen speicherbar.
* Dein Twittername als @-reply im Tweettext.
* Position der Buttons wählbar (vor oder nach dem Artikel).
* Wählbar welcher Button angezeigt werden soll.
* Wählbar ob es dem Besucher möglich sein soll, die Buttons permanent anzeigen zu lassen.
* Anzeige auf den Artikelseiten (default, nicht änderbar).
* Optionale Anzeige aif CMS-Seiten.
* Optionale Anzeige in der Artikelübersicht (noch beta).

== Installation ==

Nutze dafür einfach dein Dashboard

**Installation via Wordpress**

1. Gehe ins Menü 'Plugins' -> 'Install' und suche nach '2 Click Social Media Buttons'
1. Klicke hier auf 'install'

**Manuelle Installation**

1. Lade das Verzeichnis `2-click-socialmedia-buttons` in Dein `/wp-content/plugins/`-Verzeichnis Deines WordPres.
1. Aktiviere das Plugin.

== Screenshots ==

1. Buttons unter dem Text.
2. Hinweis bei Mouseover.
3. Einstellungsmenü der Buttons.

== Changelog ==
= 0.13 =
* (28. 10. 2011)
* Fix: Funktion zum Einbinden der Buttons überarbeitet. (schlanker, kürzer und schneller)
* Fix: Schreibfehler auf der Einstellungsseite berichtigt.
* Workaround für Themes, welche auf dem Weg vom Content zum Footer die Post-ID verlieren eingebaut.
* Code ein wenig aufgeräumt.

= 0.12 =
* (27. 10. 2011)
* Neu: Sprachunterstützung hinzugefügt (Englisch und Deutsch).
* Neu: Direkte Eingabe der Infotexte. Also der Texte, die bei Mouseover angezeigt werden.

= 0.11-r2 =
* (27. 10. 2011)
* Update: JavaScript

= 0.11-r1 =
* (27. 10. 2011)
* Versionbump

= 0.11 =
* (26. 20. 2011)
* Fix: CSS - äußeren Bildabstand der Listenelemente auf 0 gesetzt. Dies gab sonst einige Probleme in einigen Themes. (margin:0 !important;)
* Neu: Flattr ist nun ebenfalls dabei :-)

= 0.10 =
* (22. 10. 2011)
* Fix: Falls es kein Excerpt gibt, wird nun explizit einer generiert, damit es auch etwas Text bei Google+ und Faebook anzuzeigen gibt.

= 0.9 =
* (21. 10. 2011)
* Fix: Sonderzeichen in der Überschrift führen nicht mehr dazu, dass die Buttons nicht geladen werden.
* Fix: CSS - inneren Bildabstand der Listenelemente auf 0 gesetzt. Dies gab sonst einige Probleme in einigen Themes. (padding:0 !important;)
* JavaScript aufgeräumt.

= 0.8.2 =
* (10. 10. 2001)
* Fix: og:type auf article gesetzt.

= 0.8.1 =
* (08. 10. 2011)
* JavaScript berichtigt.

= 0.8.0 =
* (08. 10. 2011)
* APP-ID für Facebook nicht meht notwendig - entfernt

= 0.7.2 =
* (16. 09. 2011)
* Fix: Liststyle erneut angepasst, wurde noch von einigen Themes überschrieben.
* Fix: Z-Index angepasst damit die Buttons nicht mehr über der Lightbox liegen.
* Fix: Verschiebung der Buttonleiste in einigen Themes behoben.

= 0.7.1 =
* (15. 09. 2011)
* Fix: Funktion twoclick_facebook_opengraph_tags() - Abfrage ob das Theme Post Thumbnails unterstützt. Einige Themes tun das einfach nicht.

= 0.7 =
* (15. 09. 2011)
* Fix: CSS - Aufzählungszeichen entfernt. Einige Themes wollen diese da reinfummeln. Sieht doof aus :-)
* Fix: Hintergrund für die Buttons unterdrückt. Einige Themes wollen da was einbinden, sieht auch doof aus :-)
* Fix: CSS - Checkboxen in den Cookie-Einstellungen repariert.
* Neu: Facebook Admin-ID in den Einstellungen (Wird benötigt, um einige Probleme mit dem Like zu umgehen).
* Neu: Artikelbild oder das erste im Artikel eingebundene Bild wird nun für Facebook hergenommen.
* Neu: Opengraph-Tags werden nun eingebunden.

= 0.6.1 =
* (08. 09. 2011)
* Fix: Plugin URI in den Kopfdaten.
.
= 0.6 =
* (08. 09. 2011)
* Neu: Anzeige auch für die Artikelübersicht.
* Neu: Auswahl welche Buttons angezeigt werden sollen.
* Neu: Auswahl welcher Button permanent aktiviert werden darf.

<strong>Wichtig:</strong> Bitte werft nach dem Update einen Blick in die Einstellungen, da die Buttons per default ausgeblendet sind.

= 0.5.1 =
* (07. 09. 2011)
* Fix: readme.txt

= 0.5 =
* (07. 09. 2011)
* Fix: Rahmen für Bilder im CSS entfernt.
* Fix: Optionsname für Google+ im Javascript richtig gestellt.
* Fix: Methode um den Pfad der Bilder und des CSS zu ermitteln überarbeitet.
* Neu: Option um die Buttons auf den CMS Seiten ein und ausblenden zu können.
* Neu: Option um zu wählen ob die Buttons über oder unter dem Artikel erscheinen sollen.
* Neu: Möglichkeit der Einbindung über einen Shortcode direkt in den Artikel. Dies ist jedoch noch mit Vorsicht zu genießen. Hinweis dazu auf der Einstellungsseite beachten.

= 0.4 =
* (06. 09. 2011)
* Neu: Einstellungsseite (Zu finden unter "Einstellungen" -> "2-Klick-Buttons").
* Fix: jQuery wird nun geladen (hoffe ich).
* Fix: Benötigte Option für Facebook App-ID ins das JavaScript eingebunden
* jQuery angepasst.

= 0.3 =
* (05. 09. 2011)
* Fix: CSS angepasst um ungewolltes Padding zu verhindern.

= 0.2 =
* (05. 09. 2011)
* Fix: Falsch aufgerufenen Hook entfernt.

= 0.1 =
* (04. 09. 2011)
* Initial Release

== Frequently Asked Questions ==

Bisher keine.

Falls Du jedoch eine Frage hast, dann stell diese unter [http://blog.ppfeufer.de/wordpress-plugin-2-click-social-media-buttons/](http://blog.ppfeufer.de/wordpress-plugin-2-click-social-media-buttons/) in den Kommentaren. Aber bitte schau vorher einmal grob durch die Kommentare, ob es dieses Anliegen schon gab.

== Upgrade Notice ==

Hier ist nichts zu beachten.
