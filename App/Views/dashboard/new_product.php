
<main class="uk-container-expand">
    <section class="uk-padding-small" id="new_product">
        <div class="uk-card uk-box-shadow-small uk-card-body uk-padding-small">
            <div class="uk-card-title">Novo Produto</div>
            <hr>
            <div class="uk-alert eb-cursor-pointer" uk-alert></div>
            <form action="<?=$action_new_product?>" method="POST" class="uk-padding-small" enctype="multipart/form-data">
                <div class="uk-child-width-1-1 uk-align-center  uk-grid-small" uk-grid>
                    <div>
                        <label for="name">Nome</label> 
                        <input class="uk-input uk-form-medium" type="text" name="name" id="name" placeholder="ex: Product 1" required>
                    </div>
                    <div class="">
                        <label for="price">Preço</label> 
                        <input class="uk-input uk-form-medium" type="text" name="price" id="price" data-mask="0.000,00" data-mask-reverse="true" placeholder="ex: 000,00" required>
                    </div>
                    <div class"">
                        <label for="description">Descrição</label> 
                        <textarea class="uk-textarea uk-form-medium" rows="5" name="description" id="description" placeholder="Uma descrição mais detalhada do seu produto" required></textarea>
                    </div>
                    <div uk-form-custom>
                        <br>
                        <label class="uk-button uk-button-default uk-width-1-1 break-word" tabindex="-1">
                            <i uk-icon="icon: image; ratio: 1.5"></i>
                            <span> imagem do produto</span>
                        </label>
                        <input type="file" name="img" required>
                    </div>
                    <div class="uk-width-1-1 uk-text-center">
                        <input class="uk-margin-medium-top uk-button uk-button-secondary" type="submit" value="Cadastrar Produto">
                    </div>
                </div>
            </form>
        </div>
    </section>
</main>
