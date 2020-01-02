<div class="table-responsive">
    <table class="table" id="avatars-table">
        <thead>
            <tr>
                <th style="text-align: center; vertical-align: middle;">Image</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($avatars as $avatar)
            <tr>
                <td style="text-align: center; vertical-align: middle;">
                    <img src="{{ asset($avatar->image) }}" height="50px" style="max-width: 100px;">
                </td>
                <td>
                    {!! Form::open(['route' => ['avatars.destroy', $avatar->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('avatars.edit', [$avatar->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
