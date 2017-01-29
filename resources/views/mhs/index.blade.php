@foreach ($image as $item)
            <li>{{ $item -> name }}</li>
            <li>{{ $item -> path }}</li>
@endforeach