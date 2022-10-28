-- MySQL Script generated by MySQL Workbench
-- jeu. 27 oct. 2022 12:42:24
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema knowledge
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema knowledge
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `knowledge` ;
USE `knowledge` ;

-- -----------------------------------------------------
-- Table `knowledge`.`theme`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `knowledge`.`theme` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `knowledge`.`subject`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `knowledge`.`subject` (
  `name` VARCHAR(45) NULL,
  `id` INT NOT NULL AUTO_INCREMENT,
  `theme_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_subject_idx` (`theme_id` ASC) VISIBLE,
  CONSTRAINT `fk_subject`
    FOREIGN KEY (`theme_id`)
    REFERENCES `knowledge`.`theme` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `knowledge`.`notion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `knowledge`.`notion` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `subject_id` INT NULL,
  `date_create` DATETIME NULL,
  `name` VARCHAR(45) NULL,
  `lesson` TEXT NULL,
  `sample` TEXT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_notion_1_idx` (`subject_id` ASC) VISIBLE,
  CONSTRAINT `fk_notion_1`
    FOREIGN KEY (`subject_id`)
    REFERENCES `knowledge`.`subject` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `knowledge`.`exercise`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `knowledge`.`exercise` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `notion_id` INT NULL,
  `name` VARCHAR(45) NULL,
  `url` VARCHAR(2100) NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_exercise_1_idx` (`notion_id` ASC) VISIBLE,
  CONSTRAINT `fk_exercise_1`
    FOREIGN KEY (`notion_id`)
    REFERENCES `knowledge`.`notion` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
