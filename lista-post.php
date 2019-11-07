<?php
    //Informar o content type do arquivo
    header("Content-type: text/json");

    //Definir o Time Zone
    date_default_timezone_set('America/Sao_Paulo');

    //Config do Host de Hospedagem
    //nome do servidor, usuario, senha, nome do banco
    // $mysqli = new mysqli('profthiago.com','proft578_hardtec','soufeliz123','proft578_hardtec');
    $mysqli = new mysqli('localhost','root','','db_blog');

    //Cria a consulta
    $sql = "SELECT u.nome, GROUP_CONCAT(c.nome) as nome_cat, postagem.*
    FROM postagem 
    INNER JOIN usuario u ON postagem.id_usuario = u.id_usuario
    INNER JOIN item_categoria i ON  i.id_postagem = postagem.id_postagem 
    INNER JOIN categoria c ON c.id_categoria = i.id_categoria
    
    WHERE postagem.id_postagem = i.id_postagem
    
    GROUP BY id_postagem";
    
    
    //Executa a consulta
    $resposta = $mysqli->query($sql);

    $post = array();
    $listaAux = array();

    while($linha = mysqli_fetch_array($resposta))
    {
        foreach($linha as $key => $conteudo)
        {
            if(!is_numeric($key)){
                $listaAux[$key] = $conteudo;
            }
        }
        array_push($post, $listaAux);
    }

    echo json_encode(array("posts"=>$post));
    
    $mysqli->close();    


?>