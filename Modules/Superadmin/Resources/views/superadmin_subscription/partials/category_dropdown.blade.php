@if(!empty($packages))
    <option>Select package</option>
    @foreach($packages as $key => $value)
        <option value="{{$key}}">{{$value}}</option>
    @endforeach
@endif