    <header class="uk-container-expand ">
		<div>
			<nav class="uk-navbar-container uk-box-shadow-small" uk-navbar>
				<a class="uk-navbar-item uk-logo" href="<?=$menu['home']?>">Dashboard</a>
				<div class="uk-navbar-right">
					<div class="uk-visible@m">
						<a href="<?=$menu['home']?>" class="uk-button uk-button-default uk-button-small uk-margin-small-right">
							Inicio
						</a>
						<a href="<?=$menu['new_product']?>" class="uk-button uk-button-default uk-button-small uk-margin-small-right">
							Criar produto
						</a>
						<a href="<?=$menu['new_promotion']?>" class="uk-button uk-button-default uk-button-small uk-margin-small-right">
							Criar promoção
						</a>
						<a href="<?=$menu['view_product']?>" class="uk-button uk-button-default uk-button-small uk-margin-small-right">
							Ver Produtos
						</a>
						<a href="<?=$menu['my_account']?>" class="uk-button uk-button-default uk-button-small uk-margin-small-right">
							MINHA CONTA
						</a>
						<a href="<?=$menu['logout']?>" class="uk-button uk-button-default uk-button-small uk-margin-small-right">
							SAIR
						</a>
					</div>

					<div class="uk-navbar-left uk-hidden@m">
						<button class="uk-button uk-button-default uk-button-small fs-11 uk-margin-small-right">
							<i uk-icon="icon: menu; ratio: 1.5"></i>
						</button>
						<div class="" uk-dropdown="mode: click" style="padding: 10px;">
							<ul class="uk-nav uk-dropdown-nav" uk-margin>
								<li><a class="uk-button uk-button-default uk-button-small uk-text-small" href="<?=$menu['home']?>">Inicio</a></li>
								<li><a class="uk-button uk-button-default uk-button-small uk-text-small" href="<?=$menu['new_product']?>">Criar Produto</a></li>
								<li><a class="uk-button uk-button-default uk-button-small uk-text-small" href="<?=$menu['new_promotion']?>">Criar Promoção</a></li>
								<li><a class="uk-button uk-button-default uk-button-small uk-text-small" href="<?=$menu['my_account']?>">Minha conta</a></li>
								<li><a class="uk-button uk-button-default uk-button-small uk-text-small" href="<?=$menu['logout']?>">Sair</a></li>
							</ul>
						</div>

					</div>
				</div>
			</nav>
		</div>
	</header>