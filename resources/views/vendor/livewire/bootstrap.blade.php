<style>
    .custom-pagination {
        display: flex;
        list-style-type: none;
        padding: 0;
        justify-content: center;
        align-items: center;
    }

    .custom-pagination li {
        margin: 0 5px;
    }

    .custom-pagination li.disabled {
        pointer-events: none;
    }

    .custom-pagination li span, .custom-pagination li button {
        display: block;
        padding: 8px 12px;
        border-radius: 5px;
        border: 1px solid #ddd;
        background-color: white;
        color: black;
        transition: background-color 0.3s ease;
    }

    .custom-pagination li button:hover {
        background-color: #f2f2f2;
    }

    .custom-pagination li.active span {
        background-color: #fdd7d7;
        color: #f34e00;
        border-color: #f44336;
    }

    .custom-pagination li.active span:hover {
        background-color: #fdb6b1;
        cursor: pointer;
    }

</style>

@php
    if (! isset($scrollTo)) {
        $scrollTo = 'body';
    }

    $scrollIntoViewJsSnippet = ($scrollTo !== false)
        ? <<<JS
           (\$el.closest('{$scrollTo}') || document.querySelector('{$scrollTo}')).scrollIntoView()
        JS
        : '';
@endphp

<div>
    @if ($paginator->hasPages())
        <nav>
            <ul class="custom-pagination">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                        <span>&lsaquo;</span>
                    </li>
                @else
                    <li>
                        <button type="button" dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}" wire:click="previousPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled" aria-label="@lang('pagination.previous')">&lsaquo;</button>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="active" wire:key="paginator-{{ $paginator->getPageName() }}-page-{{ $page }}" aria-current="page"><span>{{ $page }}</span></li>
                            @else
                                <li wire:key="paginator-{{ $paginator->getPageName() }}-page-{{ $page }}"><button type="button" wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}">{{ $page }}</button></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li>
                        <button type="button" dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}" wire:click="nextPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled" aria-label="@lang('pagination.next')">&rsaquo;</button>
                    </li>
                @else
                    <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                        <span>&rsaquo;</span>
                    </li>
                @endif
            </ul>
        </nav>
    @endif
</div>
