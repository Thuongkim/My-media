<div class="row">
<div class="col-md-12">
    <span  style='float: right;'>
        {{-- {!! $images->appends( Request::except('page') )->render() !!} --}}
        {!! $images->links("pagination") !!}
    </span>
</div>
</div>
<?php $i = (($images->currentPage() - 1) * $images->perPage()) + 1; ?>
<div class="table-responsive">
    <table class="table" id="images-table">
        <tbody>
            <tr>
                <th style="text-align: center; vertical-align: middle;">#</th>
                <th style="text-align: center; vertical-align: middle;">Image</th>
                <th>Status</th>
                <th colspan="3">Action</th>
            </tr>
        </tbody>
        <tbody>
        @foreach($images as $image)
            <tr>
                <td style="text-align: center; vertical-align: middle;">{!! $i++ !!}</td>
                <td style="text-align: center; vertical-align: middle;">
                    <img src="{{ asset($image->image) }}" height="50px" style="max-width: 80px;">
                </td>
                <td>
                    @if($image->status == 0)
                    <span class="label label-danger"><span class='glyphicon glyphicon-remove'></span></span>
                    @elseif($image->status == 1)
                    <span class="label label-success"><span class='glyphicon glyphicon-ok'></span></span>
                    @endif
                </td>
                <td>
                    {!! Form::open(['route' => ['images.destroy', $image->id], 'method' => 'delete']) !!}
                    <div class='btn-group' style="text-align: center; vertical-align: middle;">
                        <a href="{{ route('images.edit', [$image->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
