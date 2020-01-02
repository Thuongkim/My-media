<div class="table-responsive">
    <table class="table" id="gitUsers-table">
        <thead>
            <tr>
                <th>Git User</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($gitUsers as $gitUser)
            <tr>
                <td>{{ $gitUser->git_user }}</td>
                <td>
                    {!! Form::open(['route' => ['gitUsers.destroy', $gitUser->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('gitUsers.edit', [$gitUser->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
