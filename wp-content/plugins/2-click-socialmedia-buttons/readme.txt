=== 2 Click Social Media Buttons ===
Contributors: ppfeufer
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=DC2AEJD2J66RE
Tags: twitter, facebook, googleplus, button, flattr, social, privacy, xing
Requires at least: 3.0.1
Tested up to: 3.3
Stable tag: 0.29

Fügt die Buttons für Facebook-Like (Empfehlen), Twitter, Flattr, Xing und Googleplus dem deutschen Datenschutz entsprechend in euer WordPress ein.

== Description ==

Fügt die Buttons für Facebook-Like (Empfehlen), Twitter, Flattr, Xing und Googleplus dem deutschen Datenschutz entsprechend in euer WordPress ein.
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
* Optionale Anzeige auf CMS-Seiten.

== Installation ==

Nutze dafür einfach dein Dashboard

**Installation via Wordpress**

1. Gehe ins Menü 'Plugins' -> 'Install' und suche nach '2 Click Social Media Buttons'
1. Klicke hier auf 'install'

**Manuelle Installation**

1. Lade das Verzeichnis `2-click-socialmedia-buttons` in Dein `/wp-content/plugins/`-Verzeichnis Deines WordPress.
1. Aktiviere das Plugin.

== Screenshots ==

1. Buttons unter dem Text.
2. Hinweis bei Mouseover.
3. Einstellungsmenü der Buttons.

== Changelog ==

= 0.29 =
* (21. Februar 2012)
* CSS Fix: Sollte durch das Theme für das Listenelement ein overflow definiert haben, werden hier für das Plugin nicht wirksam. Somit wird der hover angezeigt.

= 0.28 =
* (15. Februar 2012)
* CSS-Patch: Die einzelnen Elemente können nun keinen Rahmen mehr bekommen. Dies war wohl bei der Zusammenarbeit mit einigen andern Plugins der Fall.
* JS-Patch: Zwei Kommas aus dem JavaScript entfernt, damit auch "ältere" Internetexplorer verstehen was sie tun sollen ... (Ich kanns selbst kaum glauben, dass ich das hier hin schreibe.)

= 0.27.1 =
* (11. Februar 2012)
* Patch: Verloren gegangene Optionen sind nun wieder da, sorry :-)

= 0.27 =
* (11. Februar 2012)
* CSS: Clearfix (wie er in WordPress 3.4 verwendet wird) hinzugefügt. Somit wird das Floating nach den Buttons automatisch wieder aufgehoben und nachfolgende Elemente schieben nicht nicht daneben. Danke an <a href="http://blog.ppfeufer.de/wordpress-plugin-2-click-social-media-buttons/comment-page-6/#comment-28028">jzdm</a> für den Hinweis.
* Alten auskommentierten Code rausgeworfen.
* Verwendung von $_REQUEST statt $_POST (ist etwas sicherer).

= 0.26 =
* (09. Februar 2012)
* Nicht genutzte Konstante entfernt.
* Xing Dummybild ins CSS aufgenommen.

= 0.25 =
* (06. Februar 2012)
* Auf Wunsch eines <a href="http://picomol.de/">Einzelnen</a> via <a href="http://twitter.com/#!/picomol/statuses/166157390272663552">Twitter</a> nun auch mit Einstellungen für die Archivtypen :-)

= 0.24.1 =
* (05. Februar 2012)
* bump

= 0.24 =
* (05. Februar 2012)
* Gewünschte neue Optionen zur Anzeige der Buttons auf Suchergebnisseiten, Kategoriearchiven und Tagarchvien eingebaut. Hinweis: Nicht jedes Theme unterstützt diese Optionen.
* Übesetzung aktualisiert.

= 0.23.1 =
* (29. Januar 2012)
* Dummybild für Xing nachgereicht, sorry ....

= 0.23 =
* (29. Januar 2012)
* Neu: Xing zu den Buttons hinzugefügt
* Fix: JavaScript per return holen, nicht per echo. Ich hoffe das behebt noch ein paar kleinere Sorgen.

= 0.22 =
* (28. Januar 2012)
* Fix: CSS für responsitive Layouts angepasst. (Danke an <a href="http://kkoepke.de">Kai Köpke</a>)
* Fix: CSS für den Infobutton. Margin mit "!important" versehen, damit es nicht überschrieben wird. (Danke an <a href="http://michas-blog.diewebservisten.de/">Michael</a> für den Hinweis)
* Fix: Padding der Dummy-Buttons.
* Fix: Das Problem, dass die Buttons bei einigen mehrfach unter einem Artikel eingebunden wurden, ist nun hoffentlich behoben.
* Dummybilder wurden von <a href="http://kkoepke.de">Kai</a> überarbeitet und haben nun keinen weißen Hintergrund mehr und sind somit einhetlicher.
* Die dauerhaften Einstellungen können nun nur noch im Einzelartikel geändert werden und wirken sich nur noch auf die Anzeige im Einzelartikel aus. Im Loop ist die Permaoption deaktiviert, da sie dort zu fehleranfällig ist.
* JavaScript "minified"

= 0.21.1 =
* (09. Dezember 2011)
* Fix: Artikeltitel im Tweettext in der Artikelübersicht wird nun korrekt erkannt und nicht mehr der erste Titel der Übersicht genommen.
* Neu: Link zu den Einstellungen in der Pluginübersicht eingefügt. So muss man nach der Installation nicht so lange suchen.

= 0.21 =
* (06. Dezember 2011)
* Fix: Buchstabendreher im HTML und CSS behoben.
* Fix: RSS-Feeds und TRackbacks werden nicht mit den Buttons versorgt. Danke für den Hinweis an <a href="http://campino2k.de">Chris</a>.

= 0.20 =
* (27. November 2011)
* Das Einbinden auf der Übersichtsseite funktioniert nun endlich :-)

= 0.19.1 =
* (26. November 2011)
* Fix: Schreibfehler in Variablenwert behoben. Danke an [Torsten](http://blog.blechkopp.net/) für den Hinweis.

= 0.19 =
* (16. November 2011)
* Neu: Option für ein Standardartikelbild eingefügt. Diese wird wirksam, wenn im Artikel oder der Seite kein Artikelbild (Post Thumbnail) oder sonstiges Bild gefunden wurde, welches für Facebook und/oder Google+ verwendet werden könnte.
* Fix: Teilen bei Google+ ist nun wieder möglich.

= 0.18.1 =
* (15. November 2011)
* Update: Übersetzung (Sorry, dass diese extra kommt)

= 0.18 =
* (15. November 2011)
* Neu: Template-Tag zum direkten Einbau ins Theme. Der Template-Tag berücksichtigt alle Einstellungen, die unter "Anzeige" getätigt wurden. Dafür nutze einfach `if(function_exists('get_twoclick_buttons')) {get_twoclick_buttons(get_the_ID());}` innerhalb des Themes. Beachte jedoch, dass dies nur bei Einzelartikeln und/oder -seiten funktioniert, nicht innerhalb des Loops.

= 0.17 =
* (14. November 2011)
* Dummybilder für Facebook werden nun richtig angezeigt. Je nach Auswahl entweder "Gefällt mir"/"Like" oder "Empfehlen"/"Recommend". Danke an [Kai Köpke](http://kkoepke.de) für die Bearbeitung der Grafiken.

= 0.16 =
* (10. November 2011)
* Fix: Optionen im Link werden nun an die Buttons übergeben.

= 0.15 =
* (09. November 2011)
* Ready for WordPress 3.3

= 0.14 =
* (02. November 2011)
* Neu: Optionen für Twitter erweitert.
* Neu: Auswahl des Facebook-Buttons (Empfehlen/Like).
* Update: Deutsche Übersetzung überarbeitet.

= 0.13 =
* (28. Oktober 2011)
* Fix: Funktion zum Einbinden der Buttons überarbeitet. (schlanker, kürzer und schneller)
* Fix: Schreibfehler auf der Einstellungsseite berichtigt.
* Workaround für Themes, welche auf dem Weg vom Content zum Footer die Post-ID verlieren eingebaut.
* Code ein wenig aufgeräumt.

= 0.12 =
* (27. Oktober 2011)
* Neu: Sprachunterstützung hinzugefügt (Englisch und Deutsch).
* Neu: Direkte Eingabe der Infotexte. Also der Texte, die bei Mouseover angezeigt werden.

= 0.11-r2 =
* (27. Oktober 2011)
* Update: JavaScript

= 0.11-r1 =
* (27. Oktober 2011)
* Versionbump

= 0.11 =
* (26. Oktober 2011)
* Fix: CSS - äußeren Bildabstand der Listenelemente auf 0 gesetzt. Dies gab sonst einige Probleme in einigen Themes. (margin:0 !important;)
* Neu: Flattr ist nun ebenfalls dabei :-)

= 0.10 =
* (22. 10. 2011)
* Fix: Falls es kein Excerpt gibt, wird nun explizit einer generiert, damit es auch etwas Text bei Google+ und Faebook anzuzeigen gibt.

= 0.9 =
* (21. Oktober 2011)
* Fix: Sonderzeichen in der Überschrift führen nicht mehr dazu, dass die Buttons nicht geladen werden.
* Fix: CSS - inneren Bildabstand der Listenelemente auf 0 gesetzt. Dies gab sonst einige Probleme in einigen Themes. (padding:0 !important;)
* JavaScript aufgeräumt.

= 0.8.2 =
* (10. Oktober 2001)
* Fix: og:type auf article gesetzt.

= 0.8.1 =
* (08. Oktober 2011)
* JavaScript berichtigt.

= 0.8.0 =
* (08. Oktober 2011)
* APP-ID für Facebook nicht meht notwendig - entfernt

= 0.7.2 =
* (16. September 2011)
* Fix: Liststyle erneut angepasst, wurde noch von einigen Themes überschrieben.
* Fix: Z-Index angepasst damit die Buttons nicht mehr über der Lightbox liegen.
* Fix: Verschiebung der Buttonleiste in einigen Themes behoben.

= 0.7.1 =
* (15. September 2011)
* Fix: Funktion twoclick_facebook_opengraph_tags() - Abfrage ob das Theme Post Thumbnails unterstützt. Einige Themes tun das einfach nicht.

= 0.7 =
* (15. September 2011)
* Fix: CSS - Aufzählungszeichen entfernt. Einige Themes wollen diese da reinfummeln. Sieht doof aus :-)
* Fix: Hintergrund für die Buttons unterdrückt. Einige Themes wollen da was einbinden, sieht auch doof aus :-)
* Fix: CSS - Checkboxen in den Cookie-Einstellungen repariert.
* Neu: Facebook Admin-ID in den Einstellungen (Wird benötigt, um einige Probleme mit dem Like zu umgehen).
* Neu: Artikelbild oder das erste im Artikel eingebundene Bild wird nun für Facebook hergenommen.
* Neu: Opengraph-Tags werden nun eingebunden.

= 0.6.1 =
* (08. September 2011)
* Fix: Plugin URI in den Kopfdaten.
.
= 0.6 =
* (08. September 2011)
* Neu: Anzeige auch für die Artikelübersicht.
* Neu: Auswahl welche Buttons angezeigt werden sollen.
* Neu: Auswahl welcher Button permanent aktiviert werden darf.

<strong>Wichtig:</strong> Bitte werft nach dem Update einen Blick in die Einstellungen, da die Buttons per default ausgeblendet sind.

= 0.5.1 =
* (07. September 2011)
* Fix: readme.txt

= 0.5 =
* (07. September 2011)
* Fix: Rahmen für Bilder im CSS entfernt.
* Fix: Optionsname für Google+ im Javascript richtig gestellt.
* Fix: Methode um den Pfad der Bilder und des CSS zu ermitteln überarbeitet.
* Neu: Option um die Buttons auf den CMS Seiten ein und ausblenden zu können.
* Neu: Option um zu wählen ob die Buttons über oder unter dem Artikel erscheinen sollen.
* Neu: Möglichkeit der Einbindung über einen Shortcode direkt in den Artikel. Dies ist jedoch noch mit Vorsicht zu genießen. Hinweis dazu auf der Einstellungsseite beachten.

= 0.4 =
* (06. September 2011)
* Neu: Einstellungsseite (Zu finden unter "Einstellungen" -> "2-Klick-Buttons").
* Fix: jQuery wird nun geladen (hoffe ich).
* Fix: Benötigte Option für Facebook App-ID ins das JavaScript eingebunden
* jQuery angepasst.

= 0.3 =
* (05. September 2011)
* Fix: CSS angepasst um ungewolltes Padding zu verhindern.

= 0.2 =
* (05. September 2011)
* Fix: Falsch aufgerufenen Hook entfernt.

= 0.1 =
* (04. September 2011)
* Initial Release

== Frequently Asked Questions ==

Bisher keine.

Falls Du jedoch eine Frage hast, dann stell diese unter [http://blog.ppfeufer.de/wordpress-plugin-2-click-social-media-buttons/](http://blog.ppfeufer.de/wordpress-plugin-2-click-social-media-buttons/) in den Kommentaren. Aber bitte schau vorher einmal grob durch die Kommentare, ob es dieses Anliegen schon gab.

== Upgrade Notice ==

Hier ist nichts zu beachten.
