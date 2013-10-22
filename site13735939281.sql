-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2.1
-- http://www.phpmyadmin.net
--
-- Servidor: 186.202.152.73
-- Tempo de Geração: 01/10/2013 às 11:40:29
-- Versão do Servidor: 5.1.70
-- Versão do PHP: 5.3.3-7+squeeze15

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `site13735939281`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `molduras`
--

CREATE TABLE IF NOT EXISTS `molduras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `moldura` varchar(255) NOT NULL,
  `projeto_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Extraindo dados da tabela `molduras`
--

INSERT INTO `molduras` (`id`, `moldura`, `projeto_id`) VALUES
(1, 'c81cec7c8eb5927a2acf94dcb96b98f9.jpg', 17),
(2, 'eae2f8fa98bb80c57301a501abf26d33.jpg', 12),
(3, '587224fcc2f0928a1d51a7059a47bc87.jpg', 12),
(4, '44e11c8863584d7b8098d37cf9ee6d52.png', 13),
(5, 'e45ca38bb396e26e11fb7c4ef7d9a8dd.png', 14),
(6, '83a7b702e815cc452db4d8ebe54397a9.png', 15),
(7, '557e6a03572a530266e9b30bc74db819.png', 16),
(8, '00e78c2c27d2e3328210ddcaad45b4f2.png', 17),
(9, '50abe02146aded9623fe3352c6973216.png', 18),
(10, '692c8915b373de266b8fe87f0c7a803e.png', 19),
(11, 'ad823987224faf734c0ab9858c0c161c.png', 20);

-- --------------------------------------------------------

--
-- Estrutura da tabela `perguntas`
--

CREATE TABLE IF NOT EXISTS `perguntas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pergunta` text NOT NULL,
  `pesquisa_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Extraindo dados da tabela `perguntas`
--

INSERT INTO `perguntas` (`id`, `pergunta`, `pesquisa_id`) VALUES
(1, 'eeeeeeee', 2),
(3, 'fffffffffffff', 2),
(5, 'vfvfvfvfv', 2),
(6, 'jjjjjjjjj', 1),
(7, 'pergunta G', 3),
(8, 'How to many?', 4),
(9, 'Como ficou sabendo do aplicativo?', 5),
(10, 'onde conheceu?', 6),
(11, 'Qual seu nome?', 7),
(12, 'Qual seu time?', 7),
(13, 'teste?', 4),
(14, 'Como conheceu o Bem Viver?', 8),
(15, 'Quantos dormitórios você gostaria?', 8),
(16, 'Gostaria de receber informações sobre outros produtos?', 8),
(17, 'pergunta 1', 9),
(18, 'Em qual bairro você gostaria de morar?', 11),
(19, 'Em qual bairro você gostaria de morar?', 12),
(20, 'Quantos dormitórios você procura?', 12),
(21, 'O que você prefere em um empreendimento?', 12);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pesquisas`
--

CREATE TABLE IF NOT EXISTS `pesquisas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Extraindo dados da tabela `pesquisas`
--

INSERT INTO `pesquisas` (`id`, `login`, `senha`, `nome`) VALUES
(4, 'aaa', '202cb962ac59075b964b07152d234b70', 'Pesquisa de campo'),
(5, 'itwop', '9ffcafc10f862fef71f01f8e1bd546c2', 'Pesquisa Teste'),
(6, 'teste2013', '698dc19d489c4e4db73e28a713eab07b', 'teste 2013'),
(7, 'atsn', '202cb962ac59075b964b07152d234b70', 'Anderson'),
(8, 'bemviverpesquisa', 'b595e74084a8c904f1d05ef336644d39', 'Bem Viver'),
(9, 'teste', '698dc19d489c4e4db73e28a713eab07b', 'teste local'),
(12, 'colmeia', 'c48aa5a7b0ba521db886b9c3704929bf', 'Colmeia Fortaleza');

-- --------------------------------------------------------

--
-- Estrutura da tabela `projetos`
--

CREATE TABLE IF NOT EXISTS `projetos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `login` varchar(255) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `textofixo` int(11) DEFAULT '0',
  `texto` varchar(255) DEFAULT NULL,
  `fanpage` varchar(255) DEFAULT NULL,
  `fanpage_id` varchar(255) DEFAULT NULL,
  `votacao` int(11) DEFAULT NULL,
  `link_votacao` varchar(255) DEFAULT NULL,
  `pesquisa_id` bigint(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Extraindo dados da tabela `projetos`
--

INSERT INTO `projetos` (`id`, `nome`, `login`, `senha`, `textofixo`, `texto`, `fanpage`, `fanpage_id`, `votacao`, `link_votacao`, `pesquisa_id`) VALUES
(15, 'Itwo domonstração', 'itwo', 'ff83f4aeb8caee9b928ded904e7d3aa5', 1, 'Demonstração do Itwo', 'https://www.facebook.com/TwobDigital', '444057375621177', 0, '', 0),
(16, 'Bem Viver', 'bemviver', 'b595e74084a8c904f1d05ef336644d39', 0, '', 'https://www.facebook.com/bemviverresidencial', '566616116718679', 1, 'http://www.itwo.com.br/bemviver/gerencia/app.php', 0),
(19, 'Terramaris', 'terramaris', 'aa5b0554c522a073c360f976c0f42cb8', 1, 'Quem conhece o Terramaris  sai com um sorriso no rosto.', 'https://www.facebook.com/pages/Terramaris/551230571610458', '551230571610458', 0, '', 0),
(20, 'Premium', 'premium', 'a288195832f8717bca4671416014a464', 1, 'Todo mundo quer fazer parte do novo amanhã de Indaiatuba.', 'https://www.facebook.com/PremiumResidence', '421102654668624', 0, '', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `respostas`
--

CREATE TABLE IF NOT EXISTS `respostas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `resposta` text NOT NULL,
  `pergunta_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=56 ;

--
-- Extraindo dados da tabela `respostas`
--

INSERT INTO `respostas` (`id`, `resposta`, `pergunta_id`) VALUES
(1, 'zzzzzzzzzz', 5),
(2, 'ttttttttttttt', 5),
(3, 'tttttttttttttttttttttt', 5),
(4, 'yyyyyyyyy', 5),
(5, 'yyyyyyyyyttt', 5),
(6, 'yyyyyyyyyttt', 5),
(7, 'tttttttttttttttttttttthhh', 5),
(8, 'zzzzzzzzzzzzzzzzzzzzzzzzz', 6),
(9, 'uuuuuuuuuuuuuuu', 6),
(10, 'gggggg', 7),
(11, 'yyyyy', 7),
(12, 'Yes', 8),
(13, 'No', 8),
(14, 'Por email', 9),
(15, 'Por amigos', 9),
(16, 'pela web', 9),
(17, 'José', 11),
(18, 'Maria', 11),
(19, 'João', 11),
(20, 'Francisco', 11),
(21, 'Carlos', 11),
(22, 'Juvenal', 11),
(23, 'Corinthians', 12),
(24, 'Santos', 12),
(25, 'São Paulo', 12),
(26, 'Palmeiras', 12),
(27, 'Mídia', 14),
(28, 'Amigos', 14),
(29, 'Panfleto', 14),
(30, '1', 15),
(31, '2', 15),
(32, '3', 15),
(33, 'Sim', 16),
(34, 'Não', 16),
(35, 'Centro', 0),
(36, 'Ponta da Praia', 0),
(37, 'Dunas', 0),
(38, 'Praia xpto', 0),
(39, 'Interior', 0),
(40, 'A', 18),
(41, 'C', 18),
(42, 'D', 18),
(43, 'Ponta da Praia', 19),
(44, 'Centro', 19),
(45, 'Interior', 19),
(46, 'Dunas', 19),
(47, '1 Dormitório', 20),
(48, '2 Dormitórios', 20),
(49, '3 Dormotórios', 20),
(50, '4 Dormitórios', 20),
(51, '5 Dormitórios ou +', 20),
(52, 'Lazer completo', 21),
(53, 'Segurança', 21),
(54, 'Localização', 21),
(55, 'Preço', 21);

-- --------------------------------------------------------

--
-- Estrutura da tabela `sistema`
--

CREATE TABLE IF NOT EXISTS `sistema` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(50) NOT NULL,
  `senha` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `sistema`
--

INSERT INTO `sistema` (`id`, `login`, `senha`) VALUES
(1, 'admin', '123');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
