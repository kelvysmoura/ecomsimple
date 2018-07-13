<main class="uk-container-expand">
    <section class="uk-padding-small" id="view_product">
        <div class="uk-card uk-box-shadow-small uk-card-body uk-padding-small uk-width-1-1 uk-margin-large-bottom">
            <h3 class="uk-card-title">Dashboard</h3>
            <hr>
            <table class="uk-table uk-table-striped uk-table-small uk-table-middle">
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Preço</th>
                        <th>promocional</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
<?php foreach($products as $product): ?>
                    <tr>
                        <td><?=$product->name?></td>
                        <td><?=Core\Helper::money_br($product->price)?></td>
                        <td><?=Core\Helper::money_br($product->promotion_price)?></td>
                        <td uk-margin>
                            <button type="button" class="uk-button uk-button-small uk-button-danger" data-action="<?=$product_del_url.$product->id.'/'.$product->img?>">
                                <span uk-icon="icon: trash"></span>
                            </button>
                            <a class="uk-button uk-button-small uk-button-primary" href="<?=$product_link_url.'/'.$product->id?>" target="_blanc">
                                <span uk-icon="icon: forward"></span>
                            </a>
                        </td>
                    </tr>
<?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
</main>
