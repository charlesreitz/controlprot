-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- Servidor: sql.netuno.com.br:3306
-- Tempo de Geração: Jun 18, 2009 as 09:00 AM
-- Versão do Servidor: 5.0.77
-- Versão do PHP: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Banco de Dados: `megacreddb`
-- 
CREATE DATABASE `megacreddb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `megacreddb`;


-- 
-- Estrutura da tabela `empresa`
-- 

DROP TABLE IF EXISTS `empresa`;
CREATE TABLE `empresa` (
  `codEmpresa` int(11) NOT NULL auto_increment,
  `nome` varchar(45) NOT NULL,
  `cidade` varchar(45) NOT NULL,
  `estado` varchar(45) NOT NULL,
  `status` char(1) NOT NULL,
  `logradouro` varchar(45) NOT NULL,
  `numero` int(11) NOT NULL,
  `bairro` varchar(45) NOT NULL,
  `cnpj` int(14) NOT NULL,
  `complemento` varchar(12) default NULL,
  `telefone` int(11) NOT NULL,
  `dddTelefone` int(11) NOT NULL,
  `cep` int(11) NOT NULL,
  PRIMARY KEY  (`codEmpresa`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;


-- 
-- Estrutura da tabela `itemProtocolo`
-- 

DROP TABLE IF EXISTS `itemProtocolo`;
CREATE TABLE `itemProtocolo` (
  `cpfCnpjCliente` varchar(18) NOT NULL,
  `nomeCliente` varchar(40) NOT NULL,
  `tipo` char(1) NOT NULL,
  `codProtocolo` int(11) NOT NULL,
  `obs` varchar(300) default NULL,
  `recebido` varchar(1) default NULL,
  KEY `fk_itemProtocolo_protocolo` (`codProtocolo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



-- 
-- Estrutura da tabela `protocolo`
-- 

DROP TABLE IF EXISTS `protocolo`;
CREATE TABLE `protocolo` (
  `codProtocolo` int(11) NOT NULL,
  `dataCriacao` datetime NOT NULL,
  `status` char(1) NOT NULL,
  `quantidadeContratos` int(11) NOT NULL,
  `dataEnvio` datetime default NULL,
  `codUsuario` int(11) default NULL,
  `codEmpresa` int(11) NOT NULL,
  `quantidadeContratosRecebidos` int(11) default NULL,
  `dataRecepcionado` datetime default NULL,
  `usuarioRecepcionado` int(11) default NULL,
  PRIMARY KEY  (`codProtocolo`),
  KEY `fk_protocolo_empresa` (`codEmpresa`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


-- --------------------------------------------------------
-- 
-- Estrutura da tabela `usuarios`
-- 

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `codUsuario` int(11) NOT NULL auto_increment,
  `nome` varchar(35) NOT NULL,
  `email` varchar(45) NOT NULL,
  `produto` varchar(150) NOT NULL,
  `senha` varchar(200) NOT NULL,
  `dataCriacao` datetime NOT NULL,
  `nivel` char(1) NOT NULL,
  `status` char(1) NOT NULL,
  `codEmpresa` int(11) NOT NULL,
  `cpf` varchar(12) NOT NULL,
  `login` varchar(6) NOT NULL,
  `dataUltimoLogin` datetime default NULL,
  PRIMARY KEY  (`codUsuario`),
  KEY `fk_usuarios_empresa` (`codEmpresa`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;
