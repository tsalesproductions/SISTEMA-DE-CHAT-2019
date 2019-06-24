-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 29-Maio-2019 às 23:21
-- Versão do servidor: 10.1.38-MariaDB
-- versão do PHP: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `teste`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `chats`
--

CREATE TABLE `chats` (
  `id` int(20) NOT NULL,
  `id_de` varchar(200) NOT NULL,
  `id_para` varchar(200) NOT NULL,
  `lastupdate` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `chats`
--

INSERT INTO `chats` (`id`, `id_de`, `id_para`, `lastupdate`) VALUES
(5, 'thsales061', 'rafael065', '23-05-2019 13:39:35'),
(6, 'thsales061', 'isa232', '25-05-2019 13:10:55'),
(8, 'rafael065', 'isa232', '25-05-2019 13:03:59');

-- --------------------------------------------------------

--
-- Estrutura da tabela `mensagens`
--

CREATE TABLE `mensagens` (
  `id` int(11) NOT NULL,
  `id_de` varchar(200) NOT NULL,
  `id_chat` int(11) NOT NULL,
  `mensagem` text NOT NULL,
  `data` varchar(200) NOT NULL,
  `lido` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `mensagens`
--

INSERT INTO `mensagens` (`id`, `id_de`, `id_chat`, `mensagem`, `data`, `lido`) VALUES
(1, 'thsales061', 5, 'Eai, tudo bem?', '18-05-2019 14:07:10', 1),
(2, 'rafael065', 5, 'Eai... Sim, e você?', '18-05-2019 14:08:10', 1),
(5, 'thsales061', 6, 'Oi', '18-05-2019 14:09:10', 1),
(6, 'isa232', 6, 'Oiii', '18-05-2019 14:10:10', 1),
(7, 'thsales061', 5, 'dasdsad', '18-05-2019 14:46:10', 1),
(8, 'thsales061', 5, 'dasdas', '18-05-2019 14:46:10', 1),
(9, 'thsales061', 5, 'dasdas', '18-05-2019 14:46:10', 1),
(10, 'thsales061', 5, 'dsfdsf', '18-05-2019 14:46:10', 1),
(11, 'thsales061', 5, 'dsadsad', '21-05-2019 09:56:10', 1),
(12, 'thsales061', 5, 'dsadsad', '21-05-2019 09:56:10', 1),
(13, 'thsales061', 5, 'dsadasd', '21-05-2019 09:56:10', 1),
(14, 'thsales061', 5, 'dsadasd', '21-05-2019 09:56:10', 1),
(15, 'thsales061', 5, 'dsadsad', '21-05-2019 09:56:10', 1),
(16, 'thsales061', 5, 'dsadasd', '21-05-2019 09:56:10', 1),
(17, 'thsales061', 5, 'teste', '21-05-2019 11:57:27', 1),
(18, 'thsales061', 5, 'dsadsad', '21-05-2019 12:06:21', 1),
(19, 'thsales061', 5, 'dsadsad', '21-05-2019 12:14:34', 1),
(20, 'thsales061', 5, 'sobe', '21-05-2019 12:15:37', 1),
(21, 'thsales061', 6, 'Tudo bem?', '21-05-2019 12:16:03', 1),
(22, 'rafael065', 5, 'Eai', '21-05-2019 14:37:04', 1),
(23, 'thsales061', 5, 'Eai, tudo bem?', '21-05-2019 14:37:22', 1),
(24, 'rafael065', 5, 'beleza, e vocÃª?', '21-05-2019 14:37:30', 1),
(25, 'thsales061', 5, 'De boa...', '21-05-2019 14:37:33', 1),
(26, 'rafael065', 5, 'Que bom', '21-05-2019 14:37:39', 1),
(27, 'thsales061', 5, 'Sim :)', '21-05-2019 14:37:44', 1),
(28, 'rafael065', 5, 'Legal', '21-05-2019 14:38:22', 1),
(29, 'thsales061', 5, 'dasd', '21-05-2019 14:38:27', 1),
(30, 'rafael065', 5, 'haha', '21-05-2019 14:39:53', 1),
(31, 'thsales061', 5, 'dasdasd', '21-05-2019 14:40:03', 1),
(32, 'rafael065', 5, 'Haha', '21-05-2019 14:44:50', 1),
(33, 'rafael065', 5, 'Legal...', '21-05-2019 14:44:58', 1),
(34, 'thsales061', 6, '......', '22-05-2019 14:25:58', 1),
(35, 'thsales061', 6, '.....', '22-05-2019 14:26:11', 1),
(36, 'thsales061', 6, 'dsadsad', '22-05-2019 15:18:11', 1),
(37, 'rafael065', 5, 'Eai', '22-05-2019 16:25:46', 1),
(38, 'thsales061', 5, 'Eaii, beleza?', '22-05-2019 16:26:00', 1),
(39, 'thsales061', 6, 'dsadasd', '22-05-2019 16:44:46', 1),
(40, 'thsales061', 6, 'e1e1e1', '22-05-2019 16:44:51', 1),
(41, 'thsales061', 5, '???', '23-05-2019 12:14:24', 1),
(42, 'rafael065', 5, 'eai, beleza?', '23-05-2019 12:15:13', 1),
(43, 'thsales061', 5, 'Sim, e vocÃª?', '23-05-2019 12:15:20', 1),
(44, 'thsales061', 5, 'Beleza...', '23-05-2019 12:15:31', 1),
(45, 'rafael065', 5, 'de boa', '23-05-2019 12:15:44', 1),
(46, 'rafael065', 5, '???', '23-05-2019 12:16:00', 1),
(47, 'thsales061', 0, 'dsad', '23-05-2019 12:38:53', 0),
(48, 'thsales061', 0, 'dsadsad', '23-05-2019 12:39:21', 0),
(49, 'thsales061', 6, 'gfdgfdg', '23-05-2019 13:02:18', 1),
(50, 'thsales061', 5, 'fasfasf', '23-05-2019 13:02:25', 1),
(51, 'thsales061', 6, 'dasdasd', '23-05-2019 13:27:45', 1),
(52, 'thsales061', 6, '1', '23-05-2019 13:34:36', 1),
(53, 'thsales061', 6, 'dasdasd', '23-05-2019 13:35:01', 1),
(54, 'thsales061', 6, 'teste', '23-05-2019 13:36:47', 1),
(55, 'rafael065', 5, 'eai', '23-05-2019 13:37:22', 1),
(56, 'thsales061', 5, 'eai, tudo bem?', '23-05-2019 13:37:30', 1),
(57, 'rafael065', 5, 'Tudo sim, e vocÃª?', '23-05-2019 13:39:23', 1),
(58, 'thsales061', 5, 'TÃ´ bem...', '23-05-2019 13:39:28', 1),
(59, 'rafael065', 5, 'Que bom..', '23-05-2019 13:39:32', 1),
(60, 'thsales061', 5, 'Sim :)', '23-05-2019 13:39:35', 1),
(61, 'rafael065', 8, 'Oi', '25-05-2019 13:03:16', 1),
(62, 'isa232', 8, 'Oiiiiiiii', '25-05-2019 13:03:59', 1),
(63, 'isa232', 6, 'ae', '25-05-2019 13:10:55', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(20) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `usuario` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `sexo` int(11) NOT NULL DEFAULT '0',
  `senha` varchar(200) NOT NULL,
  `foto` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `usuario`, `email`, `sexo`, `senha`, `foto`, `status`) VALUES
(1, 'Thiago Sales', 'thsales061', 'thiago_salests@hotmail.com', 1, '123456', 'images/uploadsnophoto-ce9ebfea85cbfbb4fd42fc2915d12fca8518a1535318fb75d71426ccd3d81e4a.png', '27-05-2019 13:10:04'),
(2, 'Rafael Santos', 'rafael065', 'rafael065@gmail.com', 1, '123', 'https://i0.wp.com/www.winhelponline.com/blog/wp-content/uploads/2017/12/user.png?fit=256%2C256&quality=100&ssl=1', '27-05-2019 12:28:51'),
(3, 'isa Rodrigues', 'isa232', 'isa232@gmail.com', 0, '123', 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d2/Crystal_Clear_kdm_user_female.svg/1024px-Crystal_Clear_kdm_user_female.svg.png', '25-05-2019 13:23:49'),
(4, 'lucas alves', '', 'contato@vivamais.com.br', 0, 'wsbws8g5', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mensagens`
--
ALTER TABLE `mensagens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `mensagens`
--
ALTER TABLE `mensagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
