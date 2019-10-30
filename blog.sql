-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.1.31-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win32
-- HeidiSQL Versão:              10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Copiando estrutura para tabela db_blog.categoria
CREATE TABLE IF NOT EXISTS `categoria` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela db_blog.categoria: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` (`id_categoria`, `nome`) VALUES
	(1, 'Programação'),
	(2, 'Culinária'),
	(3, 'Boa'),
	(4, 'Noite');
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;

-- Copiando estrutura para tabela db_blog.item_categoria
CREATE TABLE IF NOT EXISTS `item_categoria` (
  `id_categoria` int(11) DEFAULT NULL,
  `id_postagem` int(11) DEFAULT NULL,
  KEY `id_categoria` (`id_categoria`),
  KEY `id_postagem` (`id_postagem`),
  CONSTRAINT `item_categoria_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`),
  CONSTRAINT `item_categoria_ibfk_2` FOREIGN KEY (`id_postagem`) REFERENCES `postagem` (`id_postagem`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela db_blog.item_categoria: ~7 rows (aproximadamente)
/*!40000 ALTER TABLE `item_categoria` DISABLE KEYS */;
INSERT INTO `item_categoria` (`id_categoria`, `id_postagem`) VALUES
	(4, 1),
	(1, 1),
	(3, 3),
	(2, 3),
	(2, 2),
	(2, 1),
	(2, 1);
/*!40000 ALTER TABLE `item_categoria` ENABLE KEYS */;

-- Copiando estrutura para tabela db_blog.postagem
CREATE TABLE IF NOT EXISTS `postagem` (
  `id_postagem` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  `data` datetime DEFAULT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `imagem_destaque` varchar(100) DEFAULT NULL,
  `video_destaque` varchar(100) DEFAULT NULL,
  `conteudo` text,
  `status` tinyint(1) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_postagem`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela db_blog.postagem: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `postagem` DISABLE KEYS */;
INSERT INTO `postagem` (`id_postagem`, `id_usuario`, `data`, `titulo`, `imagem_destaque`, `video_destaque`, `conteudo`, `status`, `slug`) VALUES
	(1, 1, '2019-08-22 11:11:49', 'Culinária programagótica', 'https://www.isteducation.com/wp-content/uploads/2018/11/6c978be2ac1f668bd668c4a46a9dbb2c-1.jpg', 'https://www.youtube.com/watch?v=o8ECr0eDEGo', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, 'culinaria-programagotica'),
	(2, NULL, NULL, '', NULL, NULL, NULL, 1, NULL),
	(3, 1, '2019-08-22 11:11:49', '', NULL, 'https://www.youtube.com/watch?v=uPLnb9QDY5Y', '<!-- #######  YAY, I AM THE SOURCE EDITOR! #########-->', 1, NULL);
/*!40000 ALTER TABLE `postagem` ENABLE KEYS */;

-- Copiando estrutura para tabela db_blog.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) DEFAULT NULL,
  `senha` varchar(32) DEFAULT NULL,
  `nome` varchar(10) DEFAULT NULL,
  `privilegio` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela db_blog.usuario: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`id_usuario`, `email`, `senha`, `nome`, `privilegio`, `status`) VALUES
	(1, 'manu@manu', '123', 'Emanuel', 1, 1);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
