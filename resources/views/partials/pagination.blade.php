@if ($paginator->getLastPage() > 1)
 
<ul class="ui pagination menu uk-pagination">
	<li><a href="{{ $paginator->getUrl(1) }}" class="item{{ ($paginator->getCurrentPage() == 1) ? ' uk-disabled' : '' }}">{{ icon('left_arrow') }} Previous</a></li>
	@for ($i = 1; $i < $paginator->getLastPage(); $i++)
		<li><a href="{{ $paginator->getUrl($i) }}" class="item{{ ($paginator->getCurrentPage() == $i) ? ' uk-active' : '' }}">{{ $i }}</a></li>
	@endfor
	<li><a href="{{ $paginator->getUrl($paginator->getCurrentPage()+1) }}" class="item{{ ($paginator->getCurrentPage() == $paginator->getLastPage()) ? ' uk-disabled' : '' }}"> Next {{ icon('right_arrow') }}</a></li>
</ul>
 
@endif