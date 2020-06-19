<div class="row float-right">
    <div class="mb-3">
        <button id="toggle-seen" class="btn btn-dark">Toggle Seen</button>
    </div>
</div>

<table class="table table-striped" id="all-requests">
    <thead>
    <tr>
        <th scope="col"><input id="select-all" type="checkbox"/></th>
        <th scope="col">#</th>
        <th scope="col">Title</th>
        <th scope="col">Body</th>
        <th scope="col">User Name</th>
        <th scope="col">User Email</th>
        <th scope="col">Image</th>
        <th scope="col">Created</th>
    </tr>
    </thead>
    <tbody>
    @foreach($requests as $request)
        <tr>
            <td><input @if(in_array($request->status->id ,[1,2])) checked @endif type="checkbox" name="requests[]"
                       value="{{$request->id}}"/></td>
            <th scope="row">{{$request->id}}</th>
            <td>{{$request->title}}</td>
            <td>{{$request->body}}</td>
            <td>{{$request->user->name}}</td>
            <td>{{$request->user->email}}</td>
            <td>{{$request->created_at->diffForHumans()}}</td>
            <td>
                <a href="{{asset('storage/'.$request->image_path)}}" target="_blank">Show</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

