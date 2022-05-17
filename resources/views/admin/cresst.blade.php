
<form action="{{ route('admin.test.store') }}" method="POST">
    @csrf
    <input type="text" name="name">
    <button type="submit">Submit</button>
    @foreach ($data as $da )
    <a href="{{ route('admin.test.edit', $da ->id) }}">{{ $da ->name }}</a>
    @endforeach

</form>
