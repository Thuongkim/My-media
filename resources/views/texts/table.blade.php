<div class="table-responsive">
    <table class="table" id="texts-table">
        <thead>
            <tr>
                <th>Text</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($texts as $text)
            <tr>
                <td>{{ $text->text }}</td>
                <td>
                    {!! Form::open(['route' => ['texts.destroy', $text->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('texts.edit', [$text->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
