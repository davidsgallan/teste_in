-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 11-Set-2021 às 17:38
-- Versão do servidor: 10.4.21-MariaDB
-- versão do PHP: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `teste_inovall`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `chave_autenticacao` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nome` text COLLATE utf8_unicode_ci NOT NULL,
  `data_nascimento` date NOT NULL,
  `passwordHash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `passwordResetToken` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `criado_em` date NOT NULL DEFAULT current_timestamp(),
  `alterado_em` date NOT NULL DEFAULT current_timestamp(),
  `cpf` text COLLATE utf8_unicode_ci NOT NULL,
  `telefone` text COLLATE utf8_unicode_ci NOT NULL,
  `cep` text COLLATE utf8_unicode_ci NOT NULL,
  `logradouro` text COLLATE utf8_unicode_ci NOT NULL,
  `bairro` text COLLATE utf8_unicode_ci NOT NULL,
  `cidade` text COLLATE utf8_unicode_ci NOT NULL,
  `estado` text COLLATE utf8_unicode_ci NOT NULL,
  `complemento` text COLLATE utf8_unicode_ci NOT NULL,
  `cadastrador` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `username`, `chave_autenticacao`, `email`, `nome`, `data_nascimento`, `passwordHash`, `passwordResetToken`, `status`, `criado_em`, `alterado_em`, `cpf`, `telefone`, `cep`, `logradouro`, `bairro`, `cidade`, `estado`, `complemento`, `cadastrador`) VALUES
(1, 'admin', '35_lqvAtshocHhXoolp37hFNIFc2bjAj', 'admin@mail.com', 'Admin', '0000-00-00', '$2y$13$dKlAcHoKZsgzcBdR.vaGseQu0rV5Di5LxsKNsAUoiF3ULmhdrJayS', NULL, 1, '2021-09-10', '2021-09-10', '000.000.000-00', '00', '000000000', '00', '00', '00', '00', '00', '0'),
(2, 'Davidgallan', '35_lqvAtshocHhXoolp37hFNIFc2bjAj', 'david@gmail.com', 'David Gallan', '1994-11-25', '$2y$13$5QsyxGI4oIql6.1dcjNmMuESB.VOuG7NuPlo/zUkhTgSd5/SgwbNa', NULL, 1, '2021-09-11', '2021-09-11', '017.910.994-41', '84999999999', '59073-343', 'Travessa Brisa do Alto, 06', 'Planalto', 'Natal', 'RN', 'Prox. Mercado', '2');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `passwordResetToken` (`passwordResetToken`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
