<div class="table-responsive">
    <table class="table" id="links-table">
        <thead>
            <tr>
                <th>Link</th>
                <th>Status</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($links as $link)
            <tr>
                <td>{!! substr($link->link,0,75).'...' !!}</td>
                <td>
                    @if($link->status == 0)
                    <span class="label label-danger"><span class='glyphicon glyphicon-remove'></span></span>
                    @elseif($link->status == 1)
                    <span class="label label-success"><span class='glyphicon glyphicon-ok'></span></span>
                    @endif
                </td>
                <td>
                    {!! Form::open(['route' => ['links.destroy', $link->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('links.edit', [$link->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
