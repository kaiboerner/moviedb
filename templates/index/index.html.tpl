{extends "_base.html.tpl"}

{block "body"}
    {$pageHref = "?page="}

    {capture "page_navigation"}
        <nav aria-label="page navigation">
            <ul class="pagination">
                {if !empty($count)}
                    <li class="page-item"><span class="page-link"><i class="fas fa-list"></i> {$count} Filme</span></li>
                    <li class="page-item"><span class="page-link">&nbsp;</span></li>
                {/if}
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
                {if $isLoggedIn}
                    <li class="page-item"><span class="page-link">&nbsp;</span></li>
                    <li class="page-item"><a class="page-link" href="?controller=movie&action=new"><i class="fas fa-plus"></i> Neuen Film eintragen</a></li>
                {/if}
            </ul>
        </nav>
    {/capture}

    <div class="card">
        <div class="card-header"> 
            {$smarty.capture.page_navigation}
        </div>
        <div class="card-body">
            <ul class="list-group">
                {foreach $movies as $movie}
                    {$edit = $isLoggedIn  && $movie->isEditAllowed($currentUser)}
                    {$delete = $isLoggedIn  && $movie->isDeleteAllowed($currentUser)}

                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">{$movie->getTitle()}</div>
                            <div>Regisseur: {$movie->getRegisseur()}</div>
                            <div>veröffentlicht: {$movie->getPublication()|date_format:'%a., %d. %B %Y'}</div>
                        </div>
                        <div>
                            <div><small>{$movie->getCreated()|date_format:'%a., %d.%m.%Y %H:%M'} ({$movie->getCreatedBy()})</small></div>
                            {if $edit || $delete}
                                <div class="btn-group">
                                    {if $edit}
                                        <a class="btn btn-secondary" href="?controller=movie&action=edit&id={$movie->getId()}" title="Bearbeiten"><i class="fas fa-edit"></i></a>
                                    {/if}
                                    {if $delete}
                                        <a class="btn btn-danger" href="?controller=movie&action=delete&id={$movie->getId()}" onclick="return confirm('Wollen Sie den Film wirklich löschen?');" title="Löschen"><i class="fas fa-trash"></i></a>
                                    {/if}
                                </div>
                            {/if}
                        </div>
                    </li>
                {foreachelse}
                    <li class="list-group-item disabled">
                        <i class="fas fa-sad-tear"></i> Das Filmarchiv ist noch leer
                    </li> 
                {/foreach}
            </ul>
        </div>
        <div class="card-footer">
            {$smarty.capture.page_navigation}
        </div>
    </div>
{/block}
