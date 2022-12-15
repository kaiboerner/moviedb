
{capture "messages"}
    {messages}
{/capture}
{if !empty($smarty.capture.messages)}
    <div class="container-fluid">
        {$smarty.capture.messages}
    </div>
{/if}
