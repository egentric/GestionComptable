<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <titleSite Entreprise</title>

    <!-- icon-->
    <script src="https://kit.fontawesome.com/cb109f8570.js" crossorigin="anonymous"></script>

    <!-- Fonts-->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Kanit&family=Source+Sans+Pro:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700;1,900&display=swap"
        rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        {{-- <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet"> --}}
    <!-- styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    
        <link rel="stylesheet" href=" {{ asset('css/styles.css') }}">

</head>

<body>

    <!--HEADER 
============================================================================================ -->

    <header id="head" style=" background-image: linear-gradient(to bottom right, rgba(4, 12, 103, 0.437),

    rgba(250, 250, 250, 1)),
    @foreach($sites as $site)

url(/storage/uploads/{{$site->siteXlPicture}});
@endforeach
height: 70vh;
background-position: center;
background-size: cover;">
        <div class="container">

            <!--MENU
============================================================================================ -->
            <nav class="navbar navbar-expand-lg navbar-light fixed-top ">
                <div class="container-fluid">
                    <a class="navbar-brand fisherNav" href="#">Site Entreprise</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a class="nav-link  navColor" aria-current="page" href="#head">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link navColor" href="#AboutUs">A propos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link navColor" href="#Services">Prestations</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link navColor" href="#ContactUs">Contact</a>
                            </li>
                            
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 home_title">
                    @foreach($sites as $site)
                    <h1>{{$site->siteTitle}}</h1>
                    @endforeach
                </div>
            </div>
        </div>
    </header>

    <!--ABOUT US
============================================================================================ -->

    <section class="container" id="AboutUs">
        <div class="row">
            <div class="col-md-6 AboutUs">
                @foreach($sites as $site)

                <img class="imgAboutUs" alt="" src="/storage/uploads/{{$site->siteSmPicture}}">
            </div>
            <div class="col-md-6  AboutUs">
                <h2>A propos</h2>
                <p>{!! html_entity_decode($site->siteDescription) !!}</p>
             @endforeach  
            </div>
        </div>
    </section>

    <!--Services
============================================================================================ -->

    <section class="container" id="Services">
        <div class="row">
            <h2>Nos Prestations</h2>
        </div>
        <div class="row">
            @foreach($services as $service)

            <div class="col-md-4 service">
                <p class="center">
                    <img src="/storage/uploads/{{$service->servicePicture}}">
                </p>
                <h4>{{$service->serviceTitle}}</h4>
                <p>{!! html_entity_decode($service->serviceDescription) !!}
                </p>
            </div>
            @endforeach
            
        </div>
        
    </section>

    <!--CONTACT US
============================================================================================ -->
    <section class="container" id="ContactUs">
        <div class="row">
            <h2>Contactez nous</h2>
            <div class="col-md-6">
                <h4>Nantes</h4>
                <p>Zone des entreprises<br>
                    44000 Nantes<br>
                </p>
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d9118.029938537433!2d-1.569550787178623!3d47.20079938838735!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4805eea6eeca3a53%3A0x40bf9b95ab8afa1c!2sLe%20Hangar%20%C3%A0%20Bananes!5e0!3m2!1sfr!2sfr!4v1630491906614!5m2!1sfr!2sfr"
                    height="310" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
            <div class="col-md-6">
                <form method="POST" action="{{ route('contact') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="email" name="contactEmail" placeholder="email">
                    <input type="text" name="contactTopic" placeholder="Sujet">
                    <textarea name="contactDescription" rows="8" class="contact_message" placeholder="Votre Message"></textarea>
                    <button type="submit" class="btn btnContact shadow-sm">Envoyer</button>
                        </form>
            </div>

        </div>
    </section>

    <!--FOOTER
============================================================================================ -->
    <footer class="mt-2" style=" background-image: linear-gradient(to bottom right, rgba(4, 12, 103, 0.437),

    rgba(250, 250, 250, 1)),
    @foreach($sites as $site)

url(/storage/uploads/{{$site->siteXlPicture}});
@endforeach
min-height: 15vh;
background-position: center;
background-size: cover;">
        <section class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4>Site entreprise</h4>
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Animi quidem, esse, dolor libero
                        quaerat nemo, tempora vitae nulla a temporibus deserunt ullam architecto illo. Optio accusamus
                        nam neque. Itaque, quam.</p>
                </div>
            </div>
        </section>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"
        integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous">
    </script>

    <script src="{{ asset('JavaScript/app.js') }}"></script>

</body>

</html>