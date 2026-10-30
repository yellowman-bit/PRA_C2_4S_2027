<x-layouts.app>

    <x-slot:head>
        <meta name="robots" content="index, nofollow">
    </x-slot:head>

    <x-slot:breadcrumb>
        <li><a href="/{{ $brand->id }}/{{ $brand->getNameUrlEncodedAttribute() }}/" alt="Manuals for '{{$brand->name}}'" title="Manuals for '{{$brand->name}}'">{{ $brand->name }}</a></li>
        <li><a href="/{{ $brand->id }}/{{ $brand->getNameUrlEncodedAttribute() }}/{{ $manual->id }}/" alt="View manual for '{{$brand->name}} {{ $manual->name }}'" title="View manual for '{{$brand->name}} {{ $manual->name }}'">{{ $manual->name }}</a></li>
    </x-slot:breadcrumb>

    <h1>{{ $brand->name }} - {{ $manual->name }}</h1>

    <section class="manual-short-link" aria-labelledby="manual-short-link-title">
        <h2 id="manual-short-link-title">Korte link</h2>
        <input
            type="text"
            class="form-control"
            aria-label="Korte link voor deze handleiding"
            value="{{ url(route('manual.short', ['shortCode' => $manual->shortCode])) }}"
            readonly
            onclick="this.select()"
        >
    </section>

    <div class="manual-cta">
        <a class="manual-button manual-button--primary" href="{{ $manual->url }}" target="_blank" rel="noopener noreferrer" title="Download your manual here">
            Download handleiding
        </a>
    </div>

    @if ($manual->locally_available)
        <iframe src="{{ $manual->url }}" width="780" height="600" frameborder="0" marginheight="0" marginwidth="0">
            Iframes are not supported<br />
            <a href="{{ $manual->url }}" target="_blank" rel="noopener noreferrer" title="Download your manual here">Click here to download the manual</a>
        </iframe>
    @endif

</x-layouts.app>
