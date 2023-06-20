<nav aria-label="..." class="float-right">
    <ul class="pagination">
        @if ($paginator->onFirstPage())
        <li class="page-item disabled">
            <a class="page-link disabled"  tabindex="-1">Précedent</a>
        </li>
        @else
        <li class="page-item">
            <a class="page-link" href="{{ $paginator->previousPageUrl() }}" tabindex="-1">Précedent</a>
        </li>
        @endif

        @foreach ($elements as $element)

        @if (is_string($element))
            <li class="page-item disabled"><a class="page-link disabled">{{ $element }}</a></li>
        @endif

     

        

        @if (is_array($element))
        @foreach ($element as $page => $url)
            @if ($page == $paginator->currentPage())
            <li class="page-item active">
                <a class="page-link" href="#">{{ $page }}<span class="sr-only"></span></a>
            </li>
            @else
            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
            @endif
        @endforeach
        @endif
        @endforeach

        @if ($paginator->hasMorePages())
        <li class="page-item">
            <a class="page-link" href="{{ $paginator->nextPageUrl() }}">Suivant</a>
        </li>
        @else
        <li class="page-item disabled">
            <a class="page-link disabled">Suivant</a>
        </li>
        @endif
    </ul>
</nav>