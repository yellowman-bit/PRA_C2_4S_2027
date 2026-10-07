<!DOCTYPE html>
<html lang="en">
@props(['popularManuals' => collect()])
<head>
    <x-head/>
</head>
<body>

<x-navbar/>

<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
            <x-header/>

            <ul class="breadcrumb">
                <li><a href="/" title="{{ __('misc.home_alt') }}"
                       alt="{{ __('misc.home_alt') }}">{{ __('misc.home') }}</a></li>
                {{ $breadcrumb ?? '' }}
            </ul>

            @if ( isset($_GET['q']) )
                <x-search_results/>
            @else
                @if ($popularManuals->isNotEmpty())
                    <section class="popular-manuals">
                        <h2>{{ __('misc.popular_manuals') }}</h2>
                        <ul>
                            @foreach ($popularManuals as $manual)
                                <li>{{ $manual->brand->name }}:: {{ $manual->name }}</li>
                            @endforeach
                        </ul>
                    </section>
                @endif

                {{ $slot }}
            @endif

            <ul class="breadcrumb">
                <li>
					<a href="/" title="{{ __('misc.home_alt') }}" alt="{{ __('misc.home_alt') }}">{{ __('misc.home') }}</a>
				</li>
                {{ $breadcrumb ?? '' }}
            </ul>

        </div>

    </div>


</div>

    <x-footer/>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>//window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
<script src="{{ asset('/js/app.js') }}"></script>

</body>
</html>
