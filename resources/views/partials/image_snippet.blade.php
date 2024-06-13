@if (Str::startsWith($photo->image, 'https://'))
    <img width="100" src="{{ $photo->image }}" alt="something wrong">
@else
    <img width="100" src="{{ asset('storage/' . $photo->image) }}" alt="something wrong">
@endif
