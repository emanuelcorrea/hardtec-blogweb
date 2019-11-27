<?php
require_once('Crud.php');

class Post extends Crud
{
    
    //todo Insere um novo post no banco 
    public function insert($data)
    {
        $this->openConnection();
        
        try {
            $imgname = $data['imgname'];
            $imgtype = $data['imgtype'];
            $imgtemp = $data['imgtemp'];
            
            $this->setQuery( 
                "INSERT INTO postagem (id_usuario, titulo, conteudo, slug, data, imgname, imgtype) 
                VALUES (:id_usuario, :titulo, :conteudo, :slug, NOW(), :imgname, :imgtype)"
            );
            
            $this->stmt = $this->conn->prepare($this->getQuery());
            
            if ($this->stmt->execute(array(
                ":id_usuario" => 1,
                ":titulo" => $data['titulo'],
                ":conteudo" => $data['conteudo'],
                ":slug" => $this->createSlug($data['titulo']),
                ":imgname" => $imgname,
                ":imgtype" => $imgtype
            ))) {
                $ultimoid = $this->lastId()['id_postagem'];

                $diretorio = '../assets/img/post/'.$ultimoid.'/';

                mkdir($diretorio, 0755);

                $nomedoarquivo = $ultimoid.$imgtype;

                move_uploaded_file($imgtemp, $diretorio.$nomedoarquivo);
                
                $this->insertCategories($data['categoria']);
            };

            if ($this->stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $ex) {
            echo "Erro no insert: " . $ex->getMessage();
            exit;
        } finally {
            header("Location: " . DIRPAGE); 
        }
    }

    //todo Deleta um post no banco
    public function delete($id_postagem)
    {
        try {
            $this->setQuery(
                "DELETE FROM postagem WHERE id_postagem = $id_postagem"
            );

            return $this->executeUpdate();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            exit;
        }
    }

    //todo Atualiza um post no banco
    public function update($data)
    {

    }

    //todo Busca todos os posts no banco
    public function select()
    {
        try {
            $this->setQuery(
                "SELECT * FROM postagem INNER JOIN usuario ON postagem.id_usuario = usuario.id_usuario ORDER BY id_postagem DESC"
            );

           return $this->executeQuery();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            exit;
        }
    }

    //todo Busca um post por ID
    public function selectBySlug($slug)
    {
        try {
            $this->setQuery(
                "SELECT * FROM postagem INNER JOIN usuario ON postagem.id_usuario = usuario.id_usuario WHERE postagem.slug = '$slug' "
            );

            return $this->executeQuery();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            exit;
        }
    }

    //todo Insere as categorias de um post no banco
    public function insertCategories($categorias)
    {
        try {
            $id_postagem = $this->lastId()['id_postagem'];

            $sql = "INSERT INTO item_categoria (id_categoria, id_postagem) VALUES ";
    
            foreach($categorias as $key => $value) {
                $sql .= "($value, $id_postagem), ";
            }
            
            $this->setQuery(
                substr_replace($sql, '', -2)
            );

            $this->stmt = $this->conn->prepare($this->getQuery());
            $this->stmt->execute();

            if ($this->stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } finally {
            $this->conn = null;
        }
    }

    //todo Busca todas as categorias do banco
    public function selectAllCategories()
    {
        try {
            $this->setQuery(
                "SELECT * FROM categoria"
            );

            return $this->executeQuery();
        } catch (PDOException $ex) {
            echo "Erro ao buscar categorias: " . $ex->getMessage();
            exit;
        } finally {
            $this->conn = null;
        }
    }

    //todo Pega todas as informações de uma categoria pelo ID
    public function selectCategory($id_categoria)
    {
        try {
            $this->setQuery(
                "SELECT item_categoria.*, categoria.nome as nomeCategoria 
                FROM item_categoria INNER JOIN categoria ON categoria.id_categoria = item_categoria.id_categoria 
                WHERE id_postagem = {$id_categoria}"
            );

            return $this->executeQuery();
        } catch (PDOException $ex) {
            echo "Erro ao selecionar categoria: " . $ex->getMessage();
            exit;
        }
    }

    //todo Pega um ID do último post
    public function lastId()
    {
        try {
            $this->setQuery(
                "SELECT id_postagem FROM postagem ORDER BY id_postagem DESC"
            );

            $this->stmt = $this->conn->prepare($this->getQuery());
            $this->stmt->execute();

            if ($this->stmt->rowCount() > 0) {
                return $this->stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        } catch (PDOException $ex){
            echo "Error: " . $ex->getMessage();
            exit;
        }
    }

    //todo Cria o slug a partir do título do post
    public static function createSlug($titulo)
    {
        $replace = [
            '&lt;' => '', '&gt;' => '', '&#039;' => '', '&amp;' => '',
            '&quot;' => '', 'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä'=> 'Ae',
            '&Auml;' => 'A', 'Å' => 'A', 'Ā' => 'A', 'Ą' => 'A', 'Ă' => 'A', 'Æ' => 'Ae',
            'Ç' => 'C', 'Ć' => 'C', 'Č' => 'C', 'Ĉ' => 'C', 'Ċ' => 'C', 'Ď' => 'D', 'Đ' => 'D',
            'Ð' => 'D', 'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ē' => 'E',
            'Ę' => 'E', 'Ě' => 'E', 'Ĕ' => 'E', 'Ė' => 'E', 'Ĝ' => 'G', 'Ğ' => 'G',
            'Ġ' => 'G', 'Ģ' => 'G', 'Ĥ' => 'H', 'Ħ' => 'H', 'Ì' => 'I', 'Í' => 'I',
            'Î' => 'I', 'Ï' => 'I', 'Ī' => 'I', 'Ĩ' => 'I', 'Ĭ' => 'I', 'Į' => 'I',
            'İ' => 'I', 'Ĳ' => 'IJ', 'Ĵ' => 'J', 'Ķ' => 'K', 'Ł' => 'K', 'Ľ' => 'K',
            'Ĺ' => 'K', 'Ļ' => 'K', 'Ŀ' => 'K', 'Ñ' => 'N', 'Ń' => 'N', 'Ň' => 'N',
            'Ņ' => 'N', 'Ŋ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O',
            'Ö' => 'Oe', '&Ouml;' => 'Oe', 'Ø' => 'O', 'Ō' => 'O', 'Ő' => 'O', 'Ŏ' => 'O',
            'Œ' => 'OE', 'Ŕ' => 'R', 'Ř' => 'R', 'Ŗ' => 'R', 'Ś' => 'S', 'Š' => 'S',
            'Ş' => 'S', 'Ŝ' => 'S', 'Ș' => 'S', 'Ť' => 'T', 'Ţ' => 'T', 'Ŧ' => 'T',
            'Ț' => 'T', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'Ue', 'Ū' => 'U',
            '&Uuml;' => 'Ue', 'Ů' => 'U', 'Ű' => 'U', 'Ŭ' => 'U', 'Ũ' => 'U', 'Ų' => 'U',
            'Ŵ' => 'W', 'Ý' => 'Y', 'Ŷ' => 'Y', 'Ÿ' => 'Y', 'Ź' => 'Z', 'Ž' => 'Z',
            'Ż' => 'Z', 'Þ' => 'T', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a',
            'ä' => 'ae', '&auml;' => 'ae', 'å' => 'a', 'ā' => 'a', 'ą' => 'a', 'ă' => 'a',
            'æ' => 'ae', 'ç' => 'c', 'ć' => 'c', 'č' => 'c', 'ĉ' => 'c', 'ċ' => 'c',
            'ď' => 'd', 'đ' => 'd', 'ð' => 'd', 'è' => 'e', 'é' => 'e', 'ê' => 'e',
            'ë' => 'e', 'ē' => 'e', 'ę' => 'e', 'ě' => 'e', 'ĕ' => 'e', 'ė' => 'e',
            'ƒ' => 'f', 'ĝ' => 'g', 'ğ' => 'g', 'ġ' => 'g', 'ģ' => 'g', 'ĥ' => 'h',
            'ħ' => 'h', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'ī' => 'i',
            'ĩ' => 'i', 'ĭ' => 'i', 'į' => 'i', 'ı' => 'i', 'ĳ' => 'ij', 'ĵ' => 'j',
            'ķ' => 'k', 'ĸ' => 'k', 'ł' => 'l', 'ľ' => 'l', 'ĺ' => 'l', 'ļ' => 'l',
            'ŀ' => 'l', 'ñ' => 'n', 'ń' => 'n', 'ň' => 'n', 'ņ' => 'n', 'ŉ' => 'n',
            'ŋ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'oe',
            '&ouml;' => 'oe', 'ø' => 'o', 'ō' => 'o', 'ő' => 'o', 'ŏ' => 'o', 'œ' => 'oe',
            'ŕ' => 'r', 'ř' => 'r', 'ŗ' => 'r', 'š' => 's', 'ù' => 'u', 'ú' => 'u',
            'û' => 'u', 'ü' => 'ue', 'ū' => 'u', '&uuml;' => 'ue', 'ů' => 'u', 'ű' => 'u',
            'ŭ' => 'u', 'ũ' => 'u', 'ų' => 'u', 'ŵ' => 'w', 'ý' => 'y', 'ÿ' => 'y',
            'ŷ' => 'y', 'ž' => 'z', 'ż' => 'z', 'ź' => 'z', 'þ' => 't', 'ß' => 'ss',
            'ſ' => 'ss', 'ый' => 'iy', 'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G',
            'Д' => 'D', 'Е' => 'E', 'Ё' => 'YO', 'Ж' => 'ZH', 'З' => 'Z', 'И' => 'I',
            'Й' => 'Y', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
            'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F',
            'Х' => 'H', 'Ц' => 'C', 'Ч' => 'CH', 'Ш' => 'SH', 'Щ' => 'SCH', 'Ъ' => '',
            'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'YU', 'Я' => 'YA', 'а' => 'a',
            'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo',
            'ж' => 'zh', 'з' => 'z', 'и' => 'i', 'й' => 'y', 'к' => 'k', 'л' => 'l',
            'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's',
            'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c', 'ч' => 'ch',
            'ш' => 'sh', 'щ' => 'sch', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e',
            'ю' => 'yu', 'я' => 'ya'
        ];
    
        // make a human readable string
        $titulo = strtr($titulo, $replace);
    
        // replace non letter or digits by -
        $titulo = preg_replace('~[^\\pL\d.]+~u', '-', $titulo);
    
        // trim
        $titulo = trim($titulo, '-');
    
        // remove unwanted characters
        $titulo = preg_replace('~[^-\w.]+~', '', $titulo);
    
        $slug = strtolower($titulo);
    
        return $slug;
    }
}