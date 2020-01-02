<?php $paginator = $paginator->appends(Request::except('page')); ?>
@if ($paginator->lastPage() > 1)
<div class="card-footer text-right">
    <nav class="d-inline-block">
        <ul class="pagination mb-0">
            @if ($paginator->currentPage() <= 1)
                <li class="page-item disabled"><a class="page-link"><i class="fa fa-chevron-left"></i></a></li>
            @else
                <li class="page-item"><a class="page-link" href="{!! $paginator->url($paginator->currentPage() - 1) !!}"><i class="fa fa-chevron-left"></i></a></li>
            @endif
            <?php $current = $paginator->currentPage(); $total = $paginator->lastPage(); ?>
            @if($current >= 4)
                <li class="page-item"><a class="page-link" href="{!! $paginator->url(1) !!}">1</a></li>
                <li class="page-item disabled"><a class="page-link" >...</a></li>
                @if( $total > $current )
                    <li class="page-item active"><a class="page-link" href="">{!! $current !!}</a></li>
                    <li class="page-item"><a class="page-link" href="{!! $paginator->url($current + 1) !!}">{!! $current + 1 !!}</a></li>
                @else
                    <li class="page-item"><a class="page-link" href="{!! $paginator->url($current - 1) !!}">{!! $current - 1 !!}</a></li>
                    <li class="page-item active"><a class="page-link" href="">{!! $current !!}</a></li>
                @endif
            @else
                @for ($page = 1; $page <= $paginator->lastPage() && $page < 5; $page++)
                    @if ($paginator->currentPage() == $page)
                        <li class="page-item active"><a class="page-link" href="">{!! $page !!}</a></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{!! $paginator->url($page) !!}">{!! $page !!}</a></li></a></li>
                    @endif
                @endfor
            @endif
            @if ($paginator->currentPage() >= $paginator->lastPage())
                <li class="page-item disabled"><a class="page-link"><i class="fa fa-chevron-right"></i></a></li>
            @else
                <li class="page-item"><a class="page-link" href="{!! $paginator->url($paginator->currentPage() + 1) !!}"><i class="fa fa-chevron-right"></i></a></li>
            @endif
        </ul>
    </nav>
</div>
@endif
