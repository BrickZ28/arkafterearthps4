<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
@include('partials.head')
<body>
<div class="loader loader-bg">
    <div class="loader-inner line-scale">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
</div>

<!-- Top Navigation
    ================================================== -->
@include('partials.nav')

<!-- Carousel
    ================================================== -->
@include('partials.carousel')
<!-- /.carousel -->

<!-- Qucik Call to Action
    ================================================== -->

<section class="testimonial-sec" id="testimonials">
    <div class="container">
        <h2 class="text-xs-center">Tribes <small>See who is where</small> </h2>
        <div class="row">
            @foreach($users as $user)
                <div class="col-md-4 text-xs-center">
                    <div class="card"> <img class="card-img-top" src="img/client-01.jpg" alt="Card image cap">
                        <div class="card-block">
                            <h3>{{$user->tribeName_pvp}}<small>PVP Tribe</small></h3>
                            <p class="card-text"></p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>10
<!-- Marketing messaging and featurettes
    ================================================== -->
<!-- Wrap the rest of the page in another container to center all the content. -->



@include('partials.footer')

<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
@include('partials.scripts')
</body>
</html>
