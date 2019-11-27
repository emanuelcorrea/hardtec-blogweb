<?php



    //Informar o content type do arquivo
    header("Content-type: text/json");

    //Definir o Time Zone
    date_default_timezone_set('America/Sao_Paulo');

    //Config do Host de Hospedagem
    //nome do servidor, usuario, senha, nome do banco
    $mysqli = new mysqli('profthiago.com','proft578_hardtec','soufeliz123','proft578_hardtec');

    if(isset($_GET['id_cat']))
    {
        $id_cat = $_GET['id_cat'];
        //Cria a consulta
        $where = "AND c.id_categoria = " . $id_cat;
    }

    //Cria a consulta
    $sql = "SELECT u.nome, GROUP_CONCAT(c.nome) as nome_cat, postagem.*
    FROM postagem 
    INNER JOIN usuario u ON postagem.id_usuario = u.id_usuario
    INNER JOIN item_categoria i ON  i.id_postagem = postagem.id_postagem 
    INNER JOIN categoria c ON c.id_categoria = i.id_categoria
    
    WHERE postagem.id_postagem = i.id_postagem $where
              
    GROUP BY id_postagem DESC";
   
    //echo $sql;

    $sql_cat = "SELECT * FROM categoria ORDER BY nome ASC";

    $sql_aluno = "SELECT * FROM aluno ORDER BY nome ASC";

    //Executa a consulta
    $resposta = $mysqli->query($sql);
    $resposta_cat = $mysqli->query($sql_cat);
    $resposta_aluno = $mysqli->query($sql_aluno);


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

    $cat = array();
    $listaAux2 = array();

    while($linha = mysqli_fetch_array($resposta_cat))
    {
        foreach($linha as $key => $conteudo)
        {
            if(!is_numeric($key)){
                $listaAux2[$key] = $conteudo;
            }
        }
        array_push($cat, $listaAux2);
    }

    // Auxiliar para o array do aluno
    $aluno = array();
    $listaAux3 = array();

    while($linha = mysqli_fetch_array($resposta_aluno))
    {
        foreach($linha as $key => $conteudo)
        {
            if(!is_numeric($key)){
                $listaAux3[$key] = $conteudo;
            }
        }
        array_push($aluno, $listaAux3);
    }



    echo json_encode(array("posts"=>$post, "categorias"=>$cat, "alunos"=>$aluno));
    
    
    $mysqli->close();    


?>