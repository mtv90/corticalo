<p align="center">
<img src="public/images/newLogo.png" alt="corticalo logo">
</p>


Der Service-Provider **corticalo** vom Projektteam **trial404** ist ein Prototyp für ein Studienmanagementsystem, mit dem Studiengruppen ihre Studien
organisieren sowie durchführen können. Kernstück bildet dabei der «electronic case report form» (elektronischer
Prüfbogen, kurz: eCRF).
Ziel des gesamten Projekts war es, dass der Studienleiter bzw. die Studiengruppe Fragen verschiedenen Typs
definieren und zu einem eCRF zusammenfassen kann. Dieser eCRF kann anschließend den Studienteilnehmern
bereitgestellt werden. Die erhobenen Daten werden am Ende zentral in einer Datenbank persistiert. Insgesamt
sollen die beteiligten Akteure einer klinischen Studie effizienter zusammenarbeiten können (Ermöglichung einer
ortsunabhängigen Kollaboration). Außerdem soll die Studiendauer effizienter genutzt werden, indem unnötige
Prozesse gestrichen werden sollen. Zum Beispiel soll es nicht mehr nötig sein, dass der CRF ausgedruckt und an
den Studienteilnehmer postalisch gesendet wird. Des Weiteren muss der Anwender den Prüfbogen nicht mehr
handschriftlich ausfüllen und wieder per Post zurückschicken. Zu guter Letzt erspart man den Mitarbeitern das
aufwändige manuelle Einpflegen der Daten in das Auswertungssystem. Alles in allem sollen alle Beteiligten einer
klinischen Studie enger miteinander verflochten sein und somit besser zusammenarbeiten können. Dieses Ziel
spiegelt auch der Name des Projekts, «corticalo» (englisch: corticalization, deutsch: Kortikalisierung =
Verschachtelung von Gehirnfunktionen), wieder.
Um das alles zu ermöglichen wurde eine plattformunabhängige Web-Applikation **[corticalo](https://corticalo.herokuapp.com/)**  erstellt.

# Vorgehensweise

Nach Analyse und Bewertung der Idee und den daraus resultierenden Nutzenversprechen, wurde analysiert, an welche Kundensegmente sich diese Nutzenversprechen richten. Daraus ergaben sich 3 große Kundensegmente: **Patienten**, **Ärzte** und **Studienleiter**. Zu diesen Segmenten wurden anschließend Personas erstellt, um ein besseres Verständnis zu erlangen. Diese Erkenntnisse wurden anschließend für Modellierung von spezifischen Geschäftsprozessen und die technische Implementierung verwendet. Auf eine genauere Beschreibung der Kundensegmente sowie deren Personas wird an dieser Stelle verzichtet. Genauere Informationen finden sie in unserer **Projektskizze Abgabe 1**.
Nachdem die Basis geschaffen wurde, ging es zur Konzeption. Hierbei wurden zunächst Moodboards erstellt, die in Style Tiles und anschließend in Wireframes resultierten. Details zum Design finden sie in **Abgabe 2**. Auf Grundlage der Wireframes wurde dann ein **Prototyp** erstellt, welcher ebenfalls in Abgabe 2 zu finden ist.
Das Design, insbesondere die Farben und die Navigationsleiste inkl. Menü, konnte vollständig in der Web Applikation realisiert werden. Allerdings wurde, im Vergleich zum Prototyp, auf der **[Startseite](https://corticalo.herokuapp.com/)** das Hintergrundbild durch Partikel ersetzt. Außerdem wurden die nachfolgenden Inhalte (über uns, Funktionen, Anwender, Referenzen wurden nicht umgesetzt, da keine vorhanden sind) auf der Startseite des Prototyps auf Unterseiten aufgeteilt, damit die Ladezeit der Startseite verringert wird. Auf den Unterseiten findet sich das Design des Prototyps wieder, vor allem das Hintergrundbild mit Jumbotron. Ebenfalls wurden die Inhalte ähnlich angeordnet (container mit 3 Spalten und Justify-Content-Center).

# Funktionalität

Der funktionale Umfang enthält grundlegend folgende Komponenten:

- Login mit verschiedenen Benutzerrollen: Patient/Besucher, Studienleiter, Arzt, Administrator
- Implementierung der Standardseiten: Login, Register, Index/Welcome (inkl. Unterseiten), Impressum, Datenschutz, Kontakt
- Social-Media wurde nur symbolisch eingebunden, es sind keine Profile hinterlegt
- **Hinweis:** Die Registrierung wurde geändert, um den Anforderungen zu entsprechen. Es soll möglich sein, dass sich ein User mit einer vordefinierten Rolle registrieren kann. Diese Rolle muss dafür dem RegisterController mitgegeben werden. Dazu wurde in **vendor/laravel/framework/src/Illuminate/Foundation/Auth/RegistersUsers.php** die Funktion **showRegistrationForm()** und die **[Register-View](https://corticalo.herokuapp.com/register)** um die Input-Felder Vorname, Nachname sowie die Select-Box Benutzerrolle erweitert
- 2-stufiger Eingabe-Prozess mit Formularen inkl. Validierung (session handling) für den Studienleiter (Studie anlegen und ggf. einem/mehreren CRFs zuordnen, CRF anlegen und einer/mehreren Studien zuordnen, Fragen erstellen und einem oder mehreren CRFs zuordnen). Die Erstellung der Studie beinhaltet einen 2-stufigen Prozess (Erstellformular-Erstellüberisicht-Persistierung), siehe **[Studie erstellen](https://corticalo.herokuapp.com/studies/create)**. Ein weiterer Prozess mit session handling findet man beim Benutzer mit der Rolle **Arzt**: Löschen einer Befragung. Dazu muss zunächst eine Befragung durchgeführt worden sein. Über die **[Befragungsübersicht](https://corticalo.herokuapp.com/answers)** gelangt man in die Detailansicht einer Befragung, sofern man die nötigen Rechte besitzt, ist eine Löschen-Schaltfläche sichtbar, die zum 2-stufigen Löschprozess führt.

## Use Cases

#### Patient/Besucher

**Als Besucher möchte ich von einer Willkommensseite begrüßt und über das Thema sowie den Service-Provider informiert werden können**

- Implementierung einer optisch ansprechenden **[Indexseite](https://corticalo.herokuapp.com/)**, von der man zu den Unterseiten (Funktionen, Anwender, über corticalo, User-Login, Impressum, Datenschutz, Kontakt) navigieren kann.

**Als Besucher möchte ich bei weiterführenden Fragen den Service-Provider kontaktieren können**

- Implementierung einer Kontaktseite (inkl. Verweis auf Datenschutz und Eingabeüberprüfung). Nach dem Klick auf die Schaltfläche *Senden* erscheint eine Meldung, dass diese erfolgreich versendet wurde (per session())

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for helping fund on-going Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell):

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[British Software Development](https://www.britishsoftware.co)**
- [Fragrantica](https://www.fragrantica.com)
- [SOFTonSOFA](https://softonsofa.com/)
- [User10](https://user10.com)
- [Soumettre.fr](https://soumettre.fr/)
- [CodeBrisk](https://codebrisk.com)
- [1Forge](https://1forge.com)
- [TECPRESSO](https://tecpresso.co.jp/)
- [Runtime Converter](http://runtimeconverter.com/)
- [WebL'Agence](https://weblagence.com/)
- [Invoice Ninja](https://www.invoiceninja.com)


