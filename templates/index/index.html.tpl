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
{*
        for ($p = $page - 4; $p < $page; $p++) {
            if ($p >= 1 && $p <= $pages) {
                $args['page'] = $p;
                $href = $this->path($route, $args);
                $return .= '<li class="page-item"><a class="page-link" href="'.$href.'">'.$p.'</a></li>';
            }
        }
        $args['page'] = $page;
        $href = $this->path($route, $args);
        $return .= '<li class="page-item active"><a class="page-link" href="'.$href.'">'.$page.'</a></li>';
        for ($p = $page + 1; $p < $page + 5; $p++) {
            if ($p <= $pages) {
                $args['page'] = $p;
                $href = $this->path($route, $args);
                $return .= '<li class="page-item"><a class="page-link" href="'.$href.'">'.$p.'</a></li>';
            }
        }
        if ($page < $pages - 1) {
            $args['page'] = $page + 1;
            $href = $this->path($route, $args);
            $return .= '<li class="page-item"><a class="page-link" href="'.$href.'"><i class="fas fa-forward"></i></a></li>';
        }
        if ($page < $pages) {
            $args['page'] = $pages;
            $href = $this->path($route, $args);
            $return .= '<li class="page-item"><a class="page-link" href="'.$href.'"><i class="fas fa-fast-forward"></i></a></li>';
        }
        if (!empty($count)) {
            $return .= '<li class="page-item"><span class="page-link section-list">' . $count . '</span></li>';
        }
    }
*}
        </ul>
    </nav>
{/block}
