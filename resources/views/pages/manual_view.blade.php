<x-layouts.app>

    <x-slot:head>
        <meta name="robots" content="index, nofollow">
    </x-slot:head>

    <x-slot:breadcrumb>
        <li><a href="/{{ $brand->id }}/{{ $brand->getNameUrlEncodedAttribute() }}/" alt="Manuals for '{{$brand->name}}'" title="Manuals for '{{$brand->name}}'">{{ $brand->name }}</a></li>
        <li><a href="/{{ $brand->id }}/{{ $brand->getNameUrlEncodedAttribute() }}/" alt="Manuals for '{{$brand->name}} {{ $type->name }}'" title="Manuals for '{{$brand->name}} {{ $type->name }}'">{{ $type->name }}</a></li>
        <li><a href="/{{ $brand->id }}/{{ $brand->getNameUrlEncodedAttribute() }}/{{ $manual->id }}/" alt="View manual for '{{$brand->name}} '" title="View manual for '{{$brand->name}} {{ $type->name }}'">View</a></li>
    </x-slot:breadcrumb>

    <h1>{{ $brand->name }} - {{ $type->name }}</h1>

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
