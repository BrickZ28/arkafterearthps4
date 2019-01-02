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
    @include('partials.callaction')

    @include('partials.rules')

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
