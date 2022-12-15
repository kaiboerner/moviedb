{extends "_base.html.tpl"}

{block "body"}
    <form action="" method="post">
        <div class="card">
            <div class="card-header"> 
                <i class="fas fa-plus"></i> Neuen Film eintragen
            </div>
            <div class="card-body">
                {include 'movie/_form.html.tpl'}
            </div>
            <div class="card-footer">
                <button class="btn btn-primary" type="submit"><i class="fas fa-plus"></i> Neuen Film eintragen</button>
            </div>
        </div>
    </form>
{/block}
