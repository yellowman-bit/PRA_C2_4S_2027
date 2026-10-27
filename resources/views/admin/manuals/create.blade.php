<x-layouts.app>
    <x-slot:breadcrumb>
        <li><a href="{{ route('admin.manuals.create') }}">Handleiding toevoegen</a></li>
    </x-slot:breadcrumb>

    <h1>Handleiding toevoegen</h1>

    @if (session('status'))
        <div class="alert alert-success" role="status">{{ session('status') }}</div>
    @endif

    @if ($brands->isEmpty())
        <div class="alert alert-warning" role="alert">
            Er zijn nog geen merken beschikbaar. Voeg eerst een merk toe voordat je een handleiding opslaat.
        </div>
    @endif

    <form method="POST" action="{{ route('admin.manuals.store') }}">
        @csrf

        <div class="form-group">
            <label for="brand_id">Merk</label>
            <select class="form-control @error('brand_id') is-invalid @enderror" id="brand_id" name="brand_id" required>
                <option value="">Selecteer een merk</option>
                @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}" @selected(old('brand_id') == $brand->id)>{{ $brand->name }}</option>
                @endforeach
            </select>
            @error('brand_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="type_id">Bestaand type (optioneel)</label>
            <select class="form-control @error('type_id') is-invalid @enderror" id="type_id" name="type_id">
                <option value="">Selecteer een bestaand type</option>
                @foreach ($types as $type)
                    <option value="{{ $type->id }}" @selected(old('type_id') == $type->id)>{{ $type->name }}</option>
                @endforeach
            </select>
            @error('type_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="new_type">Of voeg een nieuw type toe</label>
            <input class="form-control @error('new_type') is-invalid @enderror" id="new_type" name="new_type" value="{{ old('new_type') }}" maxlength="255">
            <small class="form-text text-muted">Kies een bestaand type of vul hier een nieuw type in.</small>
            @error('new_type')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="name">Modelnaam</label>
            <input class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="filesize">Bestandsgrootte (bytes)</label>
            <input class="form-control @error('filesize') is-invalid @enderror" id="filesize" name="filesize" type="number" min="0" value="{{ old('filesize', 0) }}" required>
            @error('filesize')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="originUrl">Link naar de handleiding</label>
            <input class="form-control @error('originUrl') is-invalid @enderror" id="originUrl" name="originUrl" type="url" value="{{ old('originUrl') }}" required>
            @error('originUrl')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="filename">Bestandsnaam (optioneel)</label>
            <input class="form-control @error('filename') is-invalid @enderror" id="filename" name="filename" value="{{ old('filename') }}">
            @error('filename')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="downloadedServer">Downloadserver (optioneel)</label>
            <input class="form-control @error('downloadedServer') is-invalid @enderror" id="downloadedServer" name="downloadedServer" value="{{ old('downloadedServer') }}">
            @error('downloadedServer')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button class="btn btn-primary" type="submit" @disabled($brands->isEmpty())>Handleiding opslaan</button>
    </form>
</x-layouts.app>
