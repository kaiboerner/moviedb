{extends "_base.html.tpl"}

{block "body"}
    <form action="?controller=security&action=login" method="post">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title"><i class="fa-solid fa-sign-in"></i> Login</h1>
            </div>

            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">
                        Name
                        <input class="form-control" name="login[name]">
                    </label>
                </div>
                <div class="mb-3">
                    <label class="form-label">
                        Kennwort
                        <input class="form-control" name="login[password]" type="password">
                    </label>
                </div>
            </div>

            <div class="card-footer">
                <button class="btn btn-primary" type="submit"><i class="fa-solid fa-sign-in"></i> Login</button>
            </div>
        </div>
    </form>
{/block}