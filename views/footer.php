        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
        <script>
            window.onscroll = function() {
                var scroll = window.pageYOffset;

                if (scroll > 250) {
                    document.querySelector(".logo-content img").style.width = "80px";
                    document.querySelector(".logo-content").style.top = "0px";
                    document.querySelector(".container-menu").style.maxWidth = "920px";
                }

                if (scroll < 250) {
                    document.querySelector(".container-menu").style.maxWidth = "1280px";
                    document.querySelector(".logo-content").style.top = "10px";
                    document.querySelector(".logo-content img").style.width = "90px";
                }
            }

            var indice_slide_auto = 0;
            trocarSlides();
                
            function trocarSlides() {
                var i_auto;
                var slides_auto = document.getElementsByClassName("meus-slides-auto");
                var ponto_indicador_auto = document.getElementsByClassName("ponto-indicador-slide");
                for (i_auto = 0; i_auto < slides_auto.length; i_auto++) {
                    slides_auto[i_auto].style.display = "none";  
                }
                indice_slide_auto++;
                if (indice_slide_auto > slides_auto.length) {indice_slide_auto = 1}    
                for (i_auto = 0; i_auto < ponto_indicador_auto.length; i_auto++) {
                    ponto_indicador_auto[i_auto].className = ponto_indicador_auto[i_auto].className.replace(" ativo", "");
                }
                slides_auto[indice_slide_auto-1].style.display = "block";  
                setTimeout(trocarSlides, 5000);
            }
        </script>
        <script>
            $(document).ready(function() {
                $('.js-example-basic-multiple').select2({});
            });
        </script>
    </body>
</html>