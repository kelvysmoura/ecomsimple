
<main class="uk-container-expand">
    <section class="uk-padding-small" id="new_promotion">
        <div class="uk-card uk-box-shadow-small uk-card-body uk-padding-small break-word">
            <div class="uk-card-title">Nova Promoção</div>
            <div class="uk-margin-small-top es-preview uk-text-bold"></div>
            <hr class="uk-margin-small">
            <div class="uk-alert cursor-pointer" uk-alert></div>
            <form action="<?=$action_new_promotion?>" method="POST" class="uk-padding-small">
                <div class="uk-child-width-1-4@m uk-grid-small" uk-grid>
                    <div class="uk-width-1-2@s">
                        <label for="product">Produtos</label> 
                        <select class="uk-select uk-form-small" name="product" id="product">
                            <option value="">Selecione um produto</option>
                            <?=$product_option?>
                        </select>
                    </div>
                    <div class="uk-width-1-2@s">
                        <label for="price">Preço promocional</label> 
                        <input class="uk-input uk-form-small" type="text" name="price" id="price" data-mask="0.000,00" data-mask-reverse="true" placeholder="ex: 000,00" required>
                    </div>
                    <div class="">
                        <label for="date_start">Data de inicio</label> 
                        <input class="uk-input uk-form-small" type="text" name="date_start" id="date_start" data-mask="00/00/0000"  placeholder="dia/mes/ano" value="<?=date('d/m/Y')?>" required>
                    </div>
                     <div class="">
                        <label for="hour_start">Hora de inicio</label> 
                        <input class="uk-input uk-form-small" type="text" name="hour_start" id="hour_start" data-mask="00:00"  placeholder="Hr:min" value="<?=date('H:i')?>" required>
                    </div>
                    <div class="">
                        <label for="date_end">Data final</label> 
                        <input class="uk-input uk-form-small" type="text" name="date_end" id="date_end" data-mask="00/00/0000"  placeholder="dia/mes/ano" required>
                    </div>
                     <div class="">
                        <label for="hour_end">Hora final</label> 
                        <input class="uk-input uk-form-small" type="text" name="hour_end" id="hour_end" data-mask="00:00" placeholder="Hr:min" required>
                    </div>
                    
                    <div class="uk-width-1-1 uk-text-center">
                        <input class="uk-margin-medium-top uk-button uk-button-secondary" type="submit" value="Criar Promoção">
                    </div>
                </div>
            </form>
        </div>
    </section>
</main>
