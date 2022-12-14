{extends "_base.html.tpl"}

{block "body"}
    <pre>
        count: {$count}
        listSize: {$listSize}
        pages: {$pages}
        page: {$page}
        movies: {$movies}
    </pre>
    {$pageHref = "?page="}

    <nav aria-label="page navigation">
        <ul class="pagination">
            {if $page > 1}
            <li class="page-item"><a class="page-link" href="{$pageHref}1"><i class="fas fa-fast-backward"></i></a></li>
            {/if}
            {if $page > 2}
                <li class="page-item"><a class="page-link" href="{$pageHref}{$page - 1}"><i class="fas fa-backward"></i></a></li>
            {/if}
            {for $p = $page - 4 to $page - 1}
                {if $p >= 1 && $p <= $pages}
                    <li class="page-item"><a class="page-link" href="{$pageHref}{$p}">{$p}</a></li>
                {/if}
            {/for}
            <li class="page-item active"><a class="page-link" href="{$pageHref}{$page}">{$page}</a></li>
            {for $p = $page + 1 to $page + 4}
                {if $p <= $pages}
                    <li class="page-item"><a class="page-link" href="{$pageHref}{$p}">{$p}</a></li>
                {/if}
            {/for}
            {if $page < $pages - 1}
                <li class="page-item"><a class="page-link" href="{$pageHref}{$page + 1}"><i class="fas fa-forward"></i></a></li>
            {/if}
            {if $page < $pages}
                <li class="page-item"><a class="page-link" href="{$pageHref}{$pages}"><i class="fas fa-fast-forward"></i></a></li>
            {/if}
            {if !empty($count)}
                <li class="page-item"><span class="page-link section-list">{$count} Filme</span></li>
            {/if}
        </ul>
    </nav>
{/block}
