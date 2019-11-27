<div class="row">
    @foreach($status as $row)
        <div class="col-md-6">
            <div class="radio {{$row->class}}">
                <input type="radio" name="radio" id="{{$row->id}}" value="{{$row->id}}"
                        @if($row->checked == 1)
                            checked="checked"
                       @endif
                >
                <label for="{{$row->id}}">
                    {{$row->status}}
                </label>
            </div>
        </div>
    @endforeach
</div>