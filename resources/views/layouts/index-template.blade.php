<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('images/newLogoFarbenBlau2.png') }}">
    <title>@yield('title')</title>
    <meta name="description" content="corticalo ist eine Clinical-Trial-Plattform, um klinische Studien online zu planen bzw. zu organisieren und durchzuführen. Die verschiedenen Akteure, wie Klinische Forschungszentren für innovative Therapien oder Medikamente, Pharma, Krankenhäuser oder Ärzte, können mithilfe des klinischen Studienmanagementsystems Studien und e CRF's (Case Report Forms) erstellen. Der große Voreil von corticalo ergibt sich durch die Konsistenz- und Vollständigkeitsprüfung bei der Studienvorbereitung (Wahl des passenden Studiendesigns, Zeit-/Ressourcenplanung, Erstellung von elektronischen Prüfbögen inklusive Festlegen von Eingabetypen, Wertebereichen und Einheiten, Verwaltung von teilnehmenden Patienten) und bei der Studiendurchführung (Konsistenz-/Vollständigkeitsprüfung bei der Beantwortung der eCRF's).  " />
    <meta name="keywords" content="clinical trial software, klinisches Studienmanagementsystem, elektronischer Prüfbogen, eCRF, klinische Studien planen, effizient klinische Studien durchführen, Case Report Form, Studiendesign" />
 
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
</head>
<body>
    
    @include('inc.navigationNew')
    
    @yield('content')
    
    @include('inc.footer')
    

        <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/myScript.js') }}" defer></script>
    <script src="{{ asset('js/menu.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('js/particles.js') }}"></script>
</body>
</html>