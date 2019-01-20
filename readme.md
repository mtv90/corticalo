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

# Funktionalität

Der funktionale Umfang enthält grundlegend folgende Komponenten:

- Login mit verschiedenen Benutzerrollen
- Implementierung der Standardseiten: Login, Register, Index/Welcome, Impressum, Datenschutz
⋅⋅* Die Registrierung wurde geändert, um den Anforderungen zu entsprechen. Es soll möglich sein, dass sich ein User mit einer vordefinierten Rolle registrieren kann. Diese Rolle muss dafür dem RegisterController mitgegeben werden. Dazu wurde in **vendor/laravel/framework/src/Illuminate/Foundation/Auth/RegistersUsers.php** die Funktion **showRegistrationForm()** erweitert
- 2-stufiger Eingabe-Prozess mit Formularen inkl. Validierung (session handling)

## Use Cases

**Als User möchte ich von einer Willkommensseite begrüßt werden


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


