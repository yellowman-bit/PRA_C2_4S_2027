<x-layouts.app>

    <x-slot:head>
        <meta name="robots" content="index, nofollow">
    </x-slot:head>

    <x-slot:breadcrumb>
        <li><a href="/{{ $brand->id }}/{{ $brand->getNameUrlEncodedAttribute() }}/" alt="Manuals for '{{$brand->name}}'" title="Manuals for '{{$brand->name}}'">{{ $brand->name }}</a></li>
    </x-slot:breadcrumb>


    <h1>{{ $brand->name }}</h1>

    <p>{{ __('introduction_texts.type_list', ['brand'=>$brand->name]) }}</p>

    <div class="manual-list">
        @foreach ($manuals as $manual)
            @if ($manual->locally_available)
                <a class="manual-button" href="/{{ $brand->id }}/{{ $brand->getNameUrlEncodedAttribute() }}/{{ $manual->id }}/" title="{{ $manual->name }}">
                    <span>{{ $manual->name }}</span>
                    <small>{{ $manual->filesize_human_readable }}</small>
                </a>
            @else
                <a class="manual-button" href="{{ $manual->url }}" target="_blank" rel="noopener noreferrer" title="{{ $manual->name }}">
                    <span>{{ $manual->name }}</span>
                </a>
            @endif
        @endforeach
    </div>

</x-layouts.app>
