<main class="uk-container-expand uk-container-small">
    <section class="uk-padding-small">
        <h2 class="uk-text-center">Todos os produtos</h2>
        <div class="uk-grid-small uk-child-width-1-6@s uk-center " uk-grid >

        <?php foreach($products as $k => $product):?>
            <div>
                <div class="uk-card uk-card-hover uk-box-shadow-small uk-text-center uk-flex uk-flex-column uk-flex-wrap uk-flex-wrap-bottom">
                    <div class="cursor-pointer open-img-modal" href="#modal-img" uk-toggle data-product-id="<?=$product->id?>">
                        <div class="uk-card-media-top">
                            <img data-src="<?=Core\Helper::main_url('assets/img/'.$product->img)?>" width="100" height="100" alt="<?=$product->name?>" uk-img>
                        </div>
                        <div class="uk-card-body uk-padding-small">
                            <h2 class="fs-14"><?=$product->name?></h2>
                            <?php if($product->promotion_active && strtotime($product->promotion_start) <= time() && strtotime($product->promotion_end) >= time()):?>
                                <span class="uk-display-block fs-11 text-cancel">R$ <?=Core\Helper::money_br($product->price)?></span>
                                <span class="uk-display-block fs-12 bleez-color">R$ <?=Core\Helper::money_br($product->promotion_price)?></span>
                            <?php else: ?>
                                <span class="fs-12 bleez-color">R$ <?=Core\Helper::money_br($product->price)?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="uk-card-footer uk-position-bottom uk-position-small uk-position-relative uk-padding-remove uk-margin-small">
                       <a href="<?=Core\Helper::main_url('store/product/'.$product->id)?>" class="uk-button uk-button-text uk-text-bold">DETALHES</a>
                   </div>
                </div>
            </div>
    <?php endforeach; ?>
        </div>
        <div id="modal-img" class="uk-text-center" data-product-url="<?=Core\Helper::main_url('store/product/')?>" uk-modal>
            <div class="uk-modal-dialog uk-modal-body uk-padding-small uk-child-width-auto uk-width-large">
                <button class="uk-modal-close-default" type="button" uk-close></button>
                <a href="" class="fs-12 uk-button uk-button-text uk-text-bold">Ver detalhes</a>
                <hr class="uk-margin-small">
                <img data-src="" width="250" height="250" alt="" uk-img>
            </div>
        </div>
    </section>
</main>
