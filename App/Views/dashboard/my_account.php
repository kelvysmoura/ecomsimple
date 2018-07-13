<main class="uk-container-expand">
    <section class="uk-padding-small" id="my_account">
        <div class="uk-card uk-box-shadow-small uk-card-body uk-padding-small">
            <h3 class="uk-card-title">Minha conta</h3>
            <hr>
            <div class="uk-alert eb-cursor-pointer" uk-alert></div>
            <form action="<?=$action_my_account?>" method="post" class="uk-grid-small uk-width-1-2@s uk-align-center" uk-grid>
                <div>
                    <label for="first_name">Nome</label>
                    <input type="text" class="uk-input uk-form-medium" name="first_name" id="first_name" value="<?=$user->first_name?>">
                </div>
                <div>
                    <label for="last_name">Sobrenome</label>
                    <input type="text" class="uk-input uk-form-medium" name="last_name" id="last_name" value="<?=$user->last_name?>">
                </div>
                <div>
                    <label for="email">Email</label>
                    <input type="text" class="uk-input uk-form-medium" name="email" id="email" value="<?=$user->email?>">
                </div>
                <div>
                    <input type="submit" class="uk-button uk-button-secondary uk-width-1-1" value="Salvar alterações">
                </div>
            </form>
        </div>
    </section>
</main>
