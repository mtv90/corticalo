<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('images/newLogoFarbenBlau2.png') }}">
    <title>@yield('title')</title>
    <meta name="description" content="corticalo ist eine Clinical-Trial-Plattform, um klinische Studien online zu planen bzw. zu organisieren und durchzuführen. Die verschiedenen Akteure, wie Klinische Forschungszentren für innovative Therapien oder Medikamente, Pharma, Krankenhäuser oder Ärzte, können mithilfe des klinischen Studienmanagementsystems Studien und e CRF's (Case Report Forms) erstellen. Der große Voreil von corticalo ergibt sich durch die Konsistenz- und Vollständigkeitsprüfung bei der Studienvorbereitung (Wahl des passenden Studiendesigns, Zeit-/Ressourcenplanung, Erstellung von elektronischen Prüfbögen inklusive Festlegen von Eingabetypen, Wertebereichen und Einheiten, Verwaltung von teilnehmenden Patienten) und bei der Studiendurchführung (Konsistenz-/Vollständigkeitsprüfung bei der Beantwortung der eCRF's).  " />
    <meta name="keywords" content="clinical trial software, klinisches Studienmanagementsystem, elektronischer Prüfbogen, eCRF, klinische Studien planen, effizient klinische Studien durchführen, Case Report Form, Studiendesign" />
 
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    
</head>
<body>
@include('inc.navigationNew')
@yield('content')
@include('inc.footer')   

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>
<script src="{{ asset('js/menu.js') }}" defer></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

</body>