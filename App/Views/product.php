<?php 
$home = Core\Helper::main_url();
if($product){
    $product_img = Core\Helper::main_url("assets/img/{$product->img}");
    $price = Core\Helper::money_br($product->price);
    $promotion_price = Core\Helper::money_br($product->promotion_price);
    $promotion = ($product->promotion_active && strtotime($product->promotion_start) <= time() && strtotime($product->promotion_end) >= time());
    $frete_price = $promotion ? $promotion_price : $price;
}
?>
<main class="uk-container-expand">
    <section class="uk-padding-small" id="product">
<?php if(!$product): ?>
        <h2 class="uk-text-center">Este produto não existe em nossa loja</h2>
        <div class="uk-text-center">
            <a class="uk-text-lead uk-button uk-button-text bleez-color uk-light" href="<?=$home?>">
                Ver outros produtos
            </a>
        </div>
<?php else: ?>
        <h2>
            <a class="uk-text-lead uk-button uk-text-lowercase uk-button-text" href="<?=$home?>" class="uk-button uk-button-text">
                <span uk-icon="icon: arrow-left"></span>Ver mais produto
            </a>
        </h2>
        <div class="uk-grid-small uk-margin-large uk-child-width-1-2@s" uk-grid>
            <div class="uk-padding-small uk-text-center">
                <img data-src="<?=$product_img?>" width="350" height="350" alt="" uk-img>
            </div>
            <div class="uk-padding-small">
                <h2 class="uk-title product_title"><?=$product->name?></h2>
                <p class="fs-12 uk-margin-medium product_description"><?=$product->description?></p>
                <div class="uk-margin-medium">
                    <?php if($promotion): ?>
                        <span class="fs-11 uk-display-block text-cancel">R$ <?=$price?></span>
                        <span class="fs-18 uk-display-block bleez-color">
                            R$ <?=$promotion_price?>
                        </span>
                    <?php else: ?>
                        <span class="fs-18 uk-display-block bleez-color">
                            R$ <?=$price?>
                        </span>
                    <?php endif; ?>
                </div>
                <form action="<?=$action_api_frete?>" method="post" id="calc_frete" class="uk-grid-small" uk-grid>
                    <div class="uk-width-2-3@m">
                        <input class="uk-input uk-form-medium" value="61936130" name="frete" type="text" data-mask="00000-000">
                        <input type="hidden" name="product_price" value="<?=$frete_price?>">
                    </div>
                    <div class="uk-width-1-3@m">
                        <input class="uk-button uk-align-left@m uk-align-center uk-button-default" type="submit" value="Calcular Frete">
                    </div>
                </form>
                <div class="uk-div uk-margin-top uk-text-center" id="frete_info"></div>
                <button class="uk-button uk-button-primary uk-button-medium uk-width-1-1 uk-margin-top fs-12" id="buy" href="#product_modal" uk-toggle disabled>Comprar</button>

                <div id="product_modal" uk-modal>
                    <div class="uk-modal-dialog">
                        <button class="uk-modal-close-default" type="button" uk-close></button>
                        <div class="uk-modal-header">
                            <h2 class="uk-modal-title">Finalizar comprar</h2>
                        </div>
                        <div class="uk-modal-body uk-padding-small">
                            <div class="uk-alert eb-cursor-pointer" uk-alert></div>
                            <form action="<?=$action_finishi_buy?>" method="post" class="uk-grid-small uk-child-width-1-1" id="finish_buy" uk-grid>
                                <div>
                                    <label>Nome</label>
                                    <input class="uk-input uk-form-medium" type="text" name="cli_name" required>
                                </div>
                                <div>
                                    <label>Email</label>
                                    <input class="uk-input uk-form-medium" type="email" name="cli_email" required>
                                </div>
                                <div>
                                    <input type="hidden" name="frete_type" value="">
                                    <input type="hidden" name="frete_price" value="">
                                    <input type="hidden" name="frete_time" value="">
                                    <input type="hidden" name="product_price" value="<?=$price?>">
                                    <input type="hidden" name="product_name" value="<?=$product->name?>">
                                    <input type="hidden" name="product_img" value="<?=$product->img?>">
                                </div>
                                    <div>
                                    <input class="uk-input uk-form-medium uk-button uk-button-secondary" type="submit" value="Finalizar">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php endif; ?>
    </section>
</main>
