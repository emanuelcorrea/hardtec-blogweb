<?php 
require_once('../header.php');
require_once('../models/Post.php');

if (!isset($_SESSION['logado'])) {
    header("Location: index.php");
}

$post = new Post();

if (isset($_POST['submit'])) {
    echo "<pre>";
    print_r($_POST['categoria']);

    print_r($_POST);
    echo "</pre>";

    $imgname = $_FILES['img']['name'];
    $imgtype = $_FILES['img']['type'];
    $imgtemp = $_FILES['img']['tmp_name'];

    if (substr($imgname, -4) == 'jpeg') {
        $type = substr($imgname, -5);
    } else {
        $type = substr($imgname, -4);
    }

    $dados = array(
        "titulo" => $_POST['titulo'],
        "categoria" => $_POST['categoria'],
        "conteudo" => $_POST['conteudo'],
        "imgname" => $imgname,
        "imgtype" => $type,
        "imgtemp" => $imgtemp,
        "id_usuario" => $_SESSION['conta']['id_usuario']
    );
    
    $post->insert($dados);
    
}

?>
    <script src="../ckeditor/ckeditor.js"></script>
    <main class="addpost-main container">
        <section class="addpost-content">
            <div class="form">
                <div class="addpost">
                    <div class="title">
                        <h2>Adicionar uma nova postagem</h2>
                    </div>
                    <form action="#" method="POST" autocomplete="off" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col">
                                <label for="titulo">Título</label>
                                <input type="text" name="titulo" id="titulo" placeholder="Digite o título da postagem">
                            </div>
                            <div class="col">
                                <label for="categoria">Categorias</label>
                                <select class="js-example-basic-multiple" name="categoria[]" multiple="multiple" name="categoria" id="categoria">
                                    <?php foreach ($post->selectAllCategories() as $category): ?>
                                        <option value="<?php echo $category->id_categoria; ?>"><?php echo $category->nome; ?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="conteudo">Conteúdo</label>
                                <textarea name="conteudo" id="conteudo" cols="300" rows="45"></textarea>
                                <script>
                                    CKEDITOR.replace( 'conteudo' );
                                </script>
                            </div>
                        </div>
                        <div class="row">
                        <label for="img" class="img">
                            Escolha uma imagem
                        </label>
                        <input type="file" name="img" id="img">
                        </div>
                        <div class="row">
                            <input type="submit" value="Enviar" name="submit">
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
<?php require_once('../footer.php'); ?>