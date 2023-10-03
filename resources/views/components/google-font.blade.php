@foreach($fonts as $name=> $link)
    @if($font === 'all' || $name === $font)
        <link rel="preload" href="{{$link}}" as="style">
        <link href="{{$link}}" rel="stylesheet"/>
    @endif
@endforeach
