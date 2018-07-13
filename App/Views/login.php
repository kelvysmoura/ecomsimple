<!-- body -->

	<main>
		<section>
            <div class="uk-width-1-1 uk-margin-xlarge-top uk-margin-small-bottom uk-text-center">
                <h2>Entrar no sistema administrativo</h2>
            </div>
<?php if(isset($_GET['msg'])): ?>
            <div class="uk-alert uk-alert-danger uk-align-center uk-width-1-2@s" uk-alert>
                 <a class="uk-alert-close" uk-close></a>
                <p><?=str_replace('-', ' ', $_GET['msg'])?></p>
            </div>
<?php endif; ?>
            <form action="<?=Core\Helper::main_url('auth')?>" method="post" class="uk-padding-small">
                <div class="uk-align-center uk-width-1-2@s uk-margin-bottom">
                    <label for="">Email</label> 
                    <input class="uk-input" type="text" name="email" id="s_email">
                </div>
                <div class="uk-align-center uk-width-1-2@s">
                    <label for="">Senha</label>
                    <input class="uk-input" type="password" name="password" id="s_password">
                </div>
                <div class="uk-text-center uk-child-width-1-2@s uk-margin">
                    <input class="uk-button uk-button-secondary" type="submit" value="Entrar">
                </div>
            </form>
		</section>
	</main>

<!-- /body -->
