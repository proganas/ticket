@if ($paginator->hasPages())
    <nav class="d-flex justify-items-center justify-content-between">
        <div class="d-flex justify-content-between flex-fill d-sm-none">
            <ul class="pagination">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item page-prev disabled">
                        <a class="page-link" href="javascript:void(0);" tabindex="-1">@lang('pagination.previous')</a>
                    </li>
                @else
                    <li class="page-item page-prev">
                        <a class="page-link" href="{{ $paginator->previousPageUrl() }}">@lang('pagination.previous')</a>
                    </li>
                @endif

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item page-next">
                        <a class="page-link" href="{{ $paginator->nextPageUrl() }}">@lang('pagination.next')</a>
                    </li>
                @else
                    <li class="page-item page-next disabled">
                        <a class="page-link" href="javascript:void(0);" tabindex="-1">@lang('pagination.next')</a>
                    </li>
                @endif
            </ul>
        </div>

        <div class="d-none flex-sm-fill d-sm-flex align-items-sm-center justify-content-sm-between">
            <div>
                <p class="small text-muted">
                    {!! __('Showing') !!}
                    <span class="fw-semibold">{{ $paginator->firstItem() }}</span>
                    {!! __('to') !!}
                    <span class="fw-semibold">{{ $paginator->lastItem() }}</span>
                    {!! __('of') !!}
                    <span class="fw-semibold">{{ $paginator->total() }}</span>
                    {!! __('results') !!}
                </p>
            </div>

            <div>
                <ul class="pagination">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <li class="page-item page-prev disabled">
                            <a class="page-link" href="javascript:void(0);"
                               tabindex="-1">@lang('pagination.previous')</a>
                        </li>
                    @else
                        <li class="page-item page-prev">
                            <a class="page-link"
                               href="{{ $paginator->previousPageUrl() }}">@lang('pagination.previous')</a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <li class="page-item disabled" aria-disabled="true"><span
                                    class="page-link">{{ $element }}</span></li>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li class="page-item active"><a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @else
                                    <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <li class="page-item page-next">
                            <a class="page-link" href="{{ $paginator->nextPageUrl() }}">@lang('pagination.next')</a>
                        </li>
                    @else
                        <li class="page-item page-next disabled">
                            <a class="page-link" href="javascript:void(0);" tabindex="-1">@lang('pagination.next')</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
@endif
