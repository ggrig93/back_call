<form action="{{route('new.request')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="title">Tile</label>
        <input type="text" class="form-control" name="title" id="title"/>
        @if ($errors->has('title'))
            <span class="text-danger">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
        @endif
    </div>

    <div class="custom-file">
        <label class="custom-file-label" for="image">Choose file</label>
        <input type="file" class="custom-file-input" id="image" name="image">
        @if ($errors->has('image'))
            <span class="text-danger">
                    <strong>{{ $errors->first('image') }}</strong>
                </span>
        @endif
    </div>

    <div class="form-group mt-3">
        <label for="body">Body</label>
        <textarea class="form-control" name="body" id="body" cols="30" rows="10"></textarea>
        @if ($errors->has('body'))
            <span class="text-danger">
                    <strong>{{ $errors->first('body') }}</strong>
                </span>
        @endif
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>

</form>
