    <footer class="uk-light uk-width-1-1">
        <div class="uk-text-center bleez-bg-color uk-padding-">
            <span>Este site é um prática de desenvolvedor php para a empresa</span>
            <a href="https://bleez.com.br/" target="_blanc">
                <img class="" src="https://printerama.com.br/media/wysiwyg/optimized/bleez.png" alt="Agência digital bleez" width="42" height="16">
            </a>
        </div>
    </footer>
    <script src="<?=CDN_JQUERY?>"></script>
    <script src="<?=CDN_UIKIT_JS?>"></script>
    <script src="<?=CDN_UIKIT_ICON_JS?>"></script>
    <script src="<?=CDN_JQUERY_MASK?>"></script>
    <script src="<?=CDN_JQUERY_VALIDATE?>"></script>
    <?php 
        if(isset($js)){
            foreach($js as $v){
                echo "<script src='{$v}'></script> \n";
            }
        }
    ?>
</body>
</html>