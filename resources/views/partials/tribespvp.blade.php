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

<div class="container tribebg">
<table class="table table-striped">
    <thead class="pvpbg">
    <tr>
        <th scope="col">#</th>
        <th scope="col">First</th>
        <th scope="col">Last</th>
        <th scope="col">Handle</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <th scope="row">1</th>
        <td>Mark</td>
        <td>Otto</td>
        <td>@mdo</td>
    </tr>
    <tr>
        <th scope="row">2</th>
        <td>Jacob</td>
        <td>Thornton</td>
        <td>@fat</td>
    </tr>
    <tr>
        <th scope="row">3</th>
        <td>Larry</td>
        <td>the Bird</td>
        <td>@twitter</td>
    </tr>
    </tbody>
</table>
</div>
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
