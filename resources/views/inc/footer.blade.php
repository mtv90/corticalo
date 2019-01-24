<footer class="container-fluid bg-footer text-center">
        <ul class="list-unstyled list-inline"> 
            <li><a href="{{ url('/kontakt') }}">Kontakt</a></li>
            <li><a href="{{ url('/impressum') }}">Impressum</a></li>
            <li><a href="{{ url('/datenschutz') }}">Datenschutz</a></li>
        </ul>
        <p>&copy; 2018 <b>corticalo</b></p> <hr>
        <div class="row justify-content-center">
            <small class="mr-2">Folge uns: </small>
            {{-- Social Media Buttons sind nur symbolisch eingebunden, da keine Profile hinterlegt sind --}}
            <small class="mr-1"><p title="Facebook"><i class="fa fa-facebook-square socialmedia"></i></p></small>
            <small class="mr-1"><p title="Linkedin"><i class="fa fa-linkedin-square socialmedia"></i></p></small>
            <small class="mr-1"><p title="Xing"><i class="fa fa-xing-square socialmedia"></i></p></small>
        </div>
</footer>
