<x-layouts.app :popular-manuals="$popularManuals">

    <x-slot:introduction_text>
        <div class="homepage-hero">
            <div class="homepage-hero__icon">📖</div>
            <div>
                <h2>Download your manual</h2>
                <p>Find your brand and access the user manual for your product.</p>
            </div>
        </div>
    </x-slot:introduction_text>

    <p class="welcome-name">Welkom, {{ $name }}</p>

    <div class="brands-section">
        <h2>Brands</h2>
        <p>Select a brand from the list below to view available manuals.</p>
    </div>

    @php
        $alpha = range('A', 'Z');
        $brandGroups = $brands->sortBy('name')->groupBy(fn ($brand) => strtoupper(substr($brand->name, 0, 1)));
    @endphp

    <div class="brand-grid row">
        @foreach ($alpha as $letter)
            @if ($brandGroups->has($letter))
                <div class="brand-column col-12 col-md-6 col-lg-3">
                    <h3>{{ $letter }}</h3>
                    <ul>
                        @foreach ($brandGroups[$letter]->sortBy('name') as $brand)
                            <li>
                                <a href="/{{ $brand->id }}/{{ $brand->getNameUrlEncodedAttribute() }}/">{{ $brand->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        @endforeach
    </div>

</x-layouts.app>
