<div class="mb-3">
    <label class="form-label" for="movie[title]"> Titel</label>
    <input class="form-control" id="movie[title]" name="movie[title]" value="{$movie->getTitle()}">
</div>
<div class="mb-3">
    <label class="form-label" for="movie[regisseur]">Regisseur</label>
    <input class="form-control" id="movie[regisseur]" name="movie[regisseur]" value="{$movie->getRegisseur()}">
</div>
<div class="mb-3">
    <label class="form-label" for="movie[publikation]">Publikation</label>
    <input class="form-control" id="movie[publikation]" name="movie[publication]" type="date" value="{$movie->getPublication()|default:$smarty.now|date_format:'%Y-%m-%d'}">
</div>
{if !empty($movie->getId())}
<div class="mb-3">
    <label class="form-label">Eingetragen</label>
    <span class="form-control">{$movie->getCreated()|date_format:'%a., %d. %B %Y'} ({$movie->getCreatedBy()})</span>
</div>
{/if}